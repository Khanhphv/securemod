<?php

namespace App\Http\Controllers\Admin;

use App\Key;
use App\Model\History;
use App\Hwid;
use App\HwidLogs;
use App\Tool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listKeys = Key::orderBy('updated_at', 'desc')->paginate(50);
        return view('admin.keys.list', compact('listKeys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $listTool = Tool::join('games', 'games.id', '=', 'tools.game_id')->select('tools.*', 'games.name AS game_name')->where('tools.active', 1)->orderBy('game_id', 'desc')->get();
	   return view('admin.keys.add', compact('listTool'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'keys' => 'required',
            'tool_id' => 'required',
            'package' => 'required'
        ], []);

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
        if (count($checkKey) == 0) {
            return back()->with(['level' => 'success', 'message' => 'Thêm thành công, có 0 key bị trùng!']);
        } else
            return back()->with(['level' => 'warning', 'message' => 'Thêm thành công ' . (count($lines) - count($checkKey)) . ' key, có ' . count($checkKey) . ' key bị trùng!'])->with('listKeyExists', $checkKey);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Key $key
     * @return \Illuminate\Http\Response
     */
//    public function edit(Key $key)
    public function edit($idKey)
    {
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

//echo '<pre>';
//print_r($error_content);
//echo '</pre>';


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
        if ($key->hwid != null) {
            $hwid = substr($key->hwid, 0, strlen($key->hwid) - 3);
            $historyHwids = Hwid::where('hwid', 'LIKE', '%' . $hwid . '%')->get();
            if ($historyHwids != null) {
                return view('admin.keys.edit', compact('key', 'listTool', 'history', 'hwidLogs', 'historyHwids', 'debugs'));
            }
        }
        return view('admin.keys.edit', compact('key', 'listTool', 'history', 'hwidLogs', 'debugs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method']);
        Key::where('id', $id)->update($data);
        return back()->with(['level' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    public function ajax(Request $request)
    {

    }

    public function searchVc(Request $request)
    {
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
        return view('admin.keys.result', ['listKeys' => $listKeys->appends(Input::except('page'))]);
    }
}
