<?php

namespace App\Http\Controllers;

use App\Hwid;
use App\HwidLogs;
use App\Key;
use App\Library\Nix\License;
use Carbon\Carbon;
use App\Service\ApiService;

class ApiController extends Controller
{
	public ApiService $apiService;

	public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function checkKeyBear()
    {

        $ACT_BAD = "BAD";
        $ACT_BANNED = "BANNED";
        $ACT_USED = "USED";
        $ACT_EXPIRED = "EXPIRED";
        $DEACT_OK = "OK";
        $DEACT_ERROR = "ERROR";
        $DEACT_UNKNOWN = "UNKNOWN";

        if (empty($_GET["code"]) || empty($_GET["hwid"]) || empty($_GET["hash"]) || empty($_GET["ip"]))
            die($ACT_BAD);
        if (urldecode($_GET["hash"]) != 'h0VtLhEdJmbC8gG9SpYpA1JnW6U=') {
            die($ACT_BAD);
        }


        $ipAddress = $_GET["ip"];
        $code = $_GET["code"];
        $hwid = substr($_GET["hwid"], 0, 32);
        // Tìm key
        $key = Key::where('key', '=', $code)->where('tool_id', 5)->first();

        if ($key == null) {
			//FREEEE
			/*
			$timeExpire = date('Y-m-d', time() + 15 * 60 * 60);
			$endTime = date("H:i d/m", time() + 15 * 60 * 60);
            $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire);

            $l = new License();
			$l->email = 'HSD: '.$endTime.' (GMT+7)';
            $l->CreateSerialNumber($sn_data);
            die("OK\n" . $l->sn);
			*/
			//FREEEE
            die($ACT_BAD);
        }

        // Check hwid bị khóa thì thoi
        if ($this->apiService->checkHackByHwidOld($hwid)) {
            $log = new HwidLogs();
            $log->hwid = $hwid;
            $log->ip_address = $ipAddress;
            $log->key_id = $key->id;
            $log->save();

            $key->hwid_count = 999999;
            $key->hwid = $hwid;
            $key->save();
            die($ACT_BANNED);
        }

		// Check xem có hết giờ ko thì cho nghỉ luôn
        if ($key->active_time != null) {
            if (Carbon::createFromTimestamp($key->active_time)->addHour($key->package) < Carbon::now()->addSeconds($key->hwid_count * 60 * 10)) {
                die($ACT_EXPIRED);
            }
        }
		// Nếu đổi máy quá 3 lần thì cấm luôn
		//if ($key->hwid_count > 3) {
		//	die($ACT_BANNED);
		//}
        // Nếu lần đầu sử dụng
        if ($key->hwid == null) {
            $key->active_time = time();
            $key->hwid = $hwid;
            $key->save();

            $timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 10)->addHour($key->package)->format('Y-m-d');
			$endTime = date("H:i d/m", ($key->package) * 60 * 60 + $key->active_time - 10 * 60 * ($key->hwid_count));
            $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => ''.time().'');

            $l = new License();
			$l->name = '';
			$l->email = ''.$endTime.' (GMT+0)';
			/*
			if ($key->hwid_count > 1) {
				$l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
			}
			*/
            $l->CreateSerialNumber($sn_data);
            // Ghi lịch sử HWID
            $log = new HwidLogs();
            $log->hwid = $hwid;
            $log->ip_address = $ipAddress;
            $log->key_id = $key->id;
            $log->sn = $l->sn;
            $log->save();
            die("OK\n" . $log->sn);
        } // Lần sử dụng tiếp theo
        else {
			// Fixed HWID;
			if ($key->user_id == 4 && !isset($_GET['debug']) && isset($key->hwid_fixed) && $key->hwid_fixed != "" && $key->hwid_fixed != $hwid) {
				die($ACT_BANNED);
				exit();
			}

			if ($key->package > 720 && $key->hwid_count > 200) {
				if($key->hwid_fixed == "") {
					die($ACT_BANNED);
					exit();
				} else if($key->hwid_fixed != $hwid) {
					die($ACT_BANNED);
					exit();
				}
			}

			$lastLogin = HwidLogs::where('key_id', '=', $key->id)->latest()->first();
            // Nếu hwid không giống trước thì tăng số lần đếm
            if ($lastLogin == null || $lastLogin->hwid != $hwid) {
				// HWID gửi lên so với lần đăng nhập cuối ko giống nhau => Đổi máy
                $key->hwid_count = $key->hwid_count + 1;
                $key->hwid = $hwid;
				if ($key->user_id == 4 && $key->hwid_count > 1 && $key->hwid_fixed == "") {
					$key->hwid_fixed = $hwid;
				}
				if ($key->user_id == 22 && $key->hwid_count > 3 && $key->hwid_fixed == "") {
					$key->hwid_fixed = $hwid;
				}
                $key->save();

                $timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 60)->addHour($key->package)->format('Y-m-d');
				$endTime = date("H:i d/m", ($key->package) * 60 * 60 + $key->active_time - 60 * 60 * ($key->hwid_count));
                $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => ''.time().'');
                $l = new License();
				$l->email = ''.$endTime.' (GMT+0)';
				$l->name = '';
				/*
				if ($key->hwid_count > 1) {
					$l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
				}
				*/
                $l->CreateSerialNumber($sn_data);

                $log = new HwidLogs();
                $log->hwid = $hwid;
                $log->ip_address = $ipAddress;
                $log->key_id = $key->id;
                $log->sn = $l->sn;
                $log->save();
                die("OK\n" . $log->sn);
            } else {
				$lastLogin->touch();
				$timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 60)->addHour($key->package)->format('Y-m-d');
				$endTime = date("H:i d/m", ($key->package) * 60 * 60 + $key->active_time - 60 * 60 * ($key->hwid_count));
                $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => ''.time().'');
                $l = new License();
				$l->email = ''.$endTime.' (GMT+0)';
				$l->name = '';
				/*
				if ($key->hwid_count > 1) {
					$l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
				}*/
				if (isset($_GET['debug'])) {
					$l->email = $hwid;
				}
                $l->CreateSerialNumber($sn_data);
				die("OK\n".$l->sn);
            }
        }

		die($DEACT_UNKNOWN);

        // Call to API to get $res
        //$serverResponse = file_get_contents("https://hackgame.mobi/api/check-key/".$code."/".$hwid."/3/".$ipAddress);
        //echo $serverResponse;
    }

    public function checkKeyNix()
    {

        $ACT_BAD = "BAD";
        $ACT_BANNED = "BANNED";
        $ACT_USED = "USED";
        $ACT_EXPIRED = "EXPIRED";
        $DEACT_OK = "OK";
        $DEACT_ERROR = "ERROR";
        $DEACT_UNKNOWN = "UNKNOWN";

        if (empty($_GET["code"]) || empty($_GET["hwid"]) || empty($_GET["hash"]) || empty($_GET["ip"]))
            die($ACT_BAD);
        if (urldecode($_GET["hash"]) != 'h0VtLhEdJmbC8gG9SpYpA1JnW6U=') {
            die($ACT_BAD);
        }


        $ipAddress = $_GET["ip"];
        $code = $_GET["code"];
        $hwid = substr($_GET["hwid"], 0, 32);
        // Tìm key
        $key = Key::where('key', '=', $code)->first();

        if ($key == null) {
			//FREEEE
			/*
			$timeExpire = date('Y-m-d', time() + 15 * 60 * 60);
			$endTime = date("H:i d/m", time() + 15 * 60 * 60);
            $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire);

            $l = new License();
			$l->email = 'HSD: '.$endTime.' (GMT+7)';
            $l->CreateSerialNumber($sn_data);
            die("OK\n" . $l->sn);
			*/
			//FREEEE
            die($ACT_BAD);
        }

        // Check hwid bị khóa thì thoi
        if ($this->apiService->checkHackByHwidOld($hwid)) {
            $log = new HwidLogs();
            $log->hwid = $hwid;
            $log->ip_address = $ipAddress;
            $log->key_id = $key->id;
            $log->save();

            $key->hwid_count = 999999;
            $key->hwid = $hwid;
            $key->save();
            die($ACT_BANNED);
        }
		// Check xem có hết giờ ko thì cho nghỉ luôn
        if ($key->active_time != null) {
            if (Carbon::createFromTimestamp($key->active_time)->addHour($key->package) < Carbon::now()->addSeconds($key->hwid_count * 60 * 10)) {
                die($ACT_EXPIRED);
            }
        }
		// Nếu đổi máy quá 3 lần thì cấm luôn
		//if ($key->hwid_count > 3) {
		//	die($ACT_BANNED);
		//}
        // Nếu lần đầu sử dụng
        if ($key->hwid == null) {
            $key->active_time = time();
            $key->hwid = $hwid;
            $key->save();

            $timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 10)->addHour($key->package)->format('Y-m-d');
			$endTime = date("H:i d/m", ($key->package) * 60 * 60 + $key->active_time - 10 * 60 * ($key->hwid_count));
            $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => ''.time().'');

            $l = new License();
           // $l->name = $ipAddress;
			$l->email = ''.$endTime.' (GMT+0)';
			$l->name = '';
			/*
			if ($key->hwid_count > 1) {
				$l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
			}
			*/
            $l->CreateSerialNumber($sn_data);
            // Ghi lịch sử HWID
            $log = new HwidLogs();
            $log->hwid = $hwid;
            $log->ip_address = $ipAddress;
            $log->key_id = $key->id;
            $log->sn = $l->sn;
            $log->save();
            die("OK\n" . $log->sn);
        } // Lần sử dụng tiếp theo
        else {
			// Fixed HWID;
			if ($key->user_id == 4 && !isset($_GET['debug']) && isset($key->hwid_fixed) && $key->hwid_fixed != "" && $key->hwid_fixed != $hwid) {
				die($ACT_BANNED);
				exit();
			}
			if ($key->package > 720 && $key->hwid_count > 200) {
				if($key->hwid_fixed == "") {
					die($ACT_BANNED);
					exit();
				} else if($key->hwid_fixed != $hwid) {
					die($ACT_BANNED);
					exit();
				}
			}
			$lastLogin = HwidLogs::where('key_id', '=', $key->id)->latest()->first();
            // Nếu hwid không giống trước thì tăng số lần đếm
            if ($lastLogin == null || $lastLogin->hwid != $hwid) {
				// HWID gửi lên so với lần đăng nhập cuối ko giống nhau => Đổi máy
                $key->hwid_count = $key->hwid_count + 1;
                $key->hwid = $hwid;
				if ($key->user_id == 4 && $key->hwid_count > 1 && $key->hwid_fixed == "") {
					$key->hwid_fixed = $hwid;
				}
				if ($key->user_id == 22 && $key->hwid_count > 3 && $key->hwid_fixed == "") {
					$key->hwid_fixed = $hwid;
				}
                $key->save();

                $timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 10)->addHour($key->package)->format('Y-m-d');
				$endTime = date("H:i d/m", ($key->package) * 60 * 60 + $key->active_time - 10 * 60 * ($key->hwid_count));
                $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => ''.time().'');
                $l = new License();
				$l->email = ''.$endTime.' (GMT+0)';
				$l->name = '';
				/*
				if ($key->hwid_count > 1) {
					$l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
				}
				*/
                $l->CreateSerialNumber($sn_data);

                $log = new HwidLogs();
                $log->hwid = $hwid;
                $log->ip_address = $ipAddress;
                $log->key_id = $key->id;
                $log->sn = $l->sn;
                $log->save();
                die("OK\n" . $log->sn);
            } else {
				$lastLogin->touch();
				$timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 10)->addHour($key->package)->format('Y-m-d');
				$endTime = date("H:i d/m", ($key->package) * 60 * 60 + $key->active_time - 10 * 60 * ($key->hwid_count));
                $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => ''.time().'');
                $l = new License();
				$l->email = ''.$endTime.' (GMT+0)';
				$l->name = '';
				/*
				if ($key->hwid_count > 1) {
					$l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
				}*/
				if (isset($_GET['debug'])) {
					$l->email = $hwid;
				}
                $l->CreateSerialNumber($sn_data);
				die("OK\n".$l->sn);
            }
        }

		die($DEACT_UNKNOWN);

        // Call to API to get $res
        //$serverResponse = file_get_contents("https://hackgame.mobi/api/check-key/".$code."/".$hwid."/3/".$ipAddress);
        //echo $serverResponse;
    }

    public function checkKey($code, $hwid = null, $toolId = 1, $ipAddress = "NOT_FOUND")
    {
        if ($toolId == 3) {
            return $this->checkKeyNix();
        }
       // $key = Key::where('key', '=', $code)->where('tool_id', $toolId)->first();
		$key = Key::where('key', '=', $code)->first();
        if ($key == null) {
            // Không tìm thấy key
            return response()->json(['failCode' => 0]);
        } else {
			// Them 2h
            // HWID bị khóa
            if ($this->apiService->checkHackByHwidOld($hwid) && $code != 'NEWKEYNEWKEYNEWKEY') {
                $log = new HwidLogs();
                $log->hwid = $hwid;
                $log->ip_address = $ipAddress;
                $log->key_id = $key->id;
                $log->save();

                $key->hwid_count = 99999;
                $key->hwid = $hwid;
                $key->save();
                return response()->json(['failCode' => 999]);
            }

            // ======= Lịch sử dùng key =======/
            // Lần đầu sử dụng
            if ($key->hwid == null) {
                $key->active_time = time();
                $key->hwid = $hwid;
                $key->save();

                // Khi lịch sử HWID
                $log = new HwidLogs();
                $log->hwid = $hwid;
                $log->ip_address = $ipAddress;
                $log->key_id = $key->id;
                $log->save();
            } // Từ lần sử dụng tiếp theo
            elseif ($key->hwid != null) {
                if (substr($key->hwid, 0, -3) != substr($hwid, 0, -3)) {
                    $key->hwid_count = $key->hwid_count + 1;
                    $key->hwid = $hwid;
                    $key->save();
                    // Đổi máy

                    // Write log
                    $log = new HwidLogs();
                    $log->hwid = $hwid;
                    $log->ip_address = $ipAddress;
                    $log->key_id = $key->id;
                    $log->save();
                    return response()->json(['failCode' => 1]);
                } else {
                    $lastLog = HwidLogs::where('hwid', '=', $hwid)->where('ip_address', '=', $ipAddress)->first();
                    if ($lastLog != null) {
                        $lastLog->touch();
                    }

                    $key->hwid = $hwid;
                    $key->save();
                }
            }
            // ======= Hết lịch sử dùng key =======/

            // Trả dữ liệu về
            $data = $key;
            $data['time'] = ($key->package) * 60 * 60 + $key->active_time - 30 * 60 * ($key->hwid_count) - time();
            return response()->json($data);
        }
    }

    public function who($hwid, $nameTool = null, $code = null)
    {
        $hacker = new Hwid();
        $hacker->cheat_name = $nameTool;
        $hacker->hwid = $hwid;
        $hacker->key = $code;
        $hacker->time = time();
        $hacker->save();
        return response()->json($hacker);
    }

}
