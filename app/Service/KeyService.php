<?php
namespace App\Service;

use App\Key;
use App\Tool;

class KeyService
{
    public function getAllKey($mode = null) {
        
        if(!empty($mode))
        {
            return Key::orderBy('updated_at', 'desc')->whereNotNull('deleted_at')->paginate(50);
        }else{
            return Key::orderBy('updated_at', 'desc')->whereNull('deleted_at')->paginate(50);
        }
    }

    public function deleteKey($id)
    {
        return Key::where('id', $id)->update(['deleted_at' => now()]);
    }

    public function forceDeleteKey($id) {
        return Key::where('id', $id)->delete(); //original delete method, which delete forever lol
    }

    public function restoreKey($id) {
        return Key::where('id', $id)->update(['deleted_at' => NULL]);
    }

    public function getTool() {
        return Tool::join('games', 'games.id', '=', 'tools.game_id')->select('tools.*', 'games.name AS game_name')->where('tools.active', 1)->orderBy('game_id', 'desc')->get();
    }

    public function saveKey($request) {
        $lines = explode(PHP_EOL, $request->keys);

        $listKeyExists = Key::select('key')->where('tool_id', $request->tool_id)->get()->toArray();
        $check = array();
        foreach ($listKeyExists as $key => $value) {
            $check[] = $value['key'];
        }

        $checkKey = array();
        foreach ($lines AS $line) {
            $line = str_replace(array("\n", "\r", " "), "", $line);
            if ($line != "" && !in_array($line, $check)) {
                $key = new Key();
                $key->tool_id = $request->tool_id;
                $key->package = $request->package;
                $key->key = str_replace(array("\n", "\r", " "), "", $line);
                $key->user_id = 0;
                $key->save();
            } else {
                $checkKey[] = $line;
            }
        }

        return $checkKey;
    }

    public function editKey($idKey) {
        $listTool = Tool::join('games', 'games.id', '=', 'tools.game_id')->select('tools.*', 'games.name AS game_name')->where('tools.active', 1)->orderBy('game_id', 'desc')->get();
        $key = Key::findOrFail($idKey);
        $history = Key::join('histories', 'keys.history_id', '=', 'histories.id')->where('keys.id', $idKey)->first();
        $hwidLogs = Key::join('hwid_logs', 'keys.id', '=', 'hwid_logs.key_id')->where('keys.id', $idKey)->get();
        $tool = Key::join('tools', 'tools.id', '=', 'keys.tool_id')->where('keys.id', $idKey)->get();
        $debugs = Key::join('debugs', 'keys.id', '=', 'debugs.key_id')->where('keys.id', $idKey)->get();

        $error_code = json_decode($tool[0]->error_code, true);
        $error_content = array();
        if (isset($error_code)) {
            foreach ($error_code AS $k => $text) {
                $ks = explode('|', $k);
                if (count($ks) > 1) {
                    $ks[0] = str_replace(" ", "", $ks[0]);
                    $ks[1] = str_replace(" ", "", $ks[1]);
                    $error_content[$ks[0]][$ks[1]] = $text;
                }
            }
        }

        foreach ($debugs AS &$debug) {
            $info = json_decode($debug->info);
            $info->log_code = str_replace(" ", "", $info->log_code);
            if ($info->log_type == 1) {
                $debug->log_type_text = "Error";
            } else {
                $debug->log_type_text = "Log";
            }
            $debug->log_note = $info->log_note;


            $log_code_parts = explode("_", $info->log_code);
            if (count($log_code_parts) != 3) {
                $debug->log_code_text = "Sai định dạng x_y_z";
                continue;
            }

            $log_code = $log_code_parts[0] . "_" . $log_code_parts[1] . "_" . $log_code_parts[2];
            if (isset($error_content['log_code'][$log_code])) {
                $debug->log_code_text = $error_content['log_code'][$log_code];
            } else {
                $debug->log_code_text = $log_code;
            }

            $function_code = $log_code_parts[0] . "_" . $log_code_parts[1];
            if (isset($error_content['function_code'][$function_code])) {
                $debug->function_code_text = $error_content['function_code'][$function_code];
            } else {
                $debug->function_code_text = $function_code;
            }

            $file_code = $log_code_parts[0];
            if (isset($error_content['file_code'][$file_code])) {
                $debug->file_code_text = $error_content['file_code'][$file_code];
            } else {
                $debug->file_code_text = $file_code;
            }

            $debug->log_line = $info->function_line;

        }

        return [$key, $listTool, $history, $hwidLogs, $debugs];
    }

    public function updateKey($id, $data) {
        Key::where('id', $id)->update($data);
    }

    public function searchVc($request) {
        $key = $request->key;
        $toolID = $request->toolID;
        $userID = $request->userID;
        if ($key != null && $userID != null && $toolID != null) {
            $listKeys = Key::where('key', 'LIKE', '%' . $key . '%')->where('user_id', $userID)->where('tool_id', $toolID)->paginate(50);
        }
        if ($key != null && $userID == null && $toolID == 0) {
            $listKeys = Key::where('key', 'LIKE', '%' . $key . '%')->paginate(50);
        }
        if ($key == null && $userID != null && $toolID == 0) {
            $listKeys = Key::where('user_id', '=', $userID)->paginate(50);
        }
        if ($key == null && $userID == null && $toolID != 0) {
            $listKeys = Key::where('tool_id', '=', $toolID)->paginate(50);
        }
        if ($key != null && $userID == null && $toolID != 0) {
            $listKeys = Key::where('tool_id', '=', $toolID)->where('key', $key)->paginate(50);
        }
        if ($key != null && $userID != null && $toolID == 0) {
            $listKeys = Key::where('user_id', '=', $userID)->where('key', $key)->paginate(50);
        }
        if ($key == null && $userID != null && $toolID != 0) {
            $listKeys = Key::where('user_id', '=', $userID)->where('tool_id', $toolID)->paginate(50);
        }

        return $listKeys;
    }
}
