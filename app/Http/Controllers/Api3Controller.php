<?php

namespace App\Http\Controllers;

use App\Hwid;
use App\HwidLogs;
use App\Key;
use App\Model\History;
use App\Library\Nix\License;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Debug;

class Api3Controller extends Controller
{
	
	public function PaypalTransaction(Request $request) {
		$transactions = $request->input('transactions');
		$access_token = $request->input('access_token');
		if($access_token != 'GHVTHV1') {
			exit('BAD');
		}
		//print_r($transactions);
		foreach($transactions AS $transaction => $status) {
			History::where('nl_token', $transaction)->update(['paypal_transaction_status' => $status]);
		}
		exit('OK');
	}

    private function RandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }

    public function loaderVer($toolId = 2)
    {
        $this->exportFile($toolId.'/RootLoader/', "haha", 'version.txt', "");
    }
	
	public function DebugReceive($code = null, $log_type = null, $info = null, $function_line = null, $log_note = null) {
        if ($code == null) {
            exit('empty');
        }
        // Tìm key
        $key = Key::where('key', '=', $code)->first();
        $log_code = $info;
        if ($key == null) {
            die("notfound");
        } else {
            $logs = explode("_", $info);
            if(count($logs) > 3) {
                exit('wrong_format');
            }
            $info = array(
                'log_type' => $log_type,
                'log_code' => $log_code,
                'log_note' => $log_note,
//              'file_code' => $file_code,
//              'function_code' => $function_code,
                'function_line' => $function_line,
            );
            $debug = new Debug();
            $debug->key_id = $key->id;
            $debug->info = json_encode($info);
            $debug->save();
            exit('done');
        }
    }


public function activeKey($toolId)
    {

        $ACT_BAD = "BAD";
        $ACT_BANNED = "BANNED";
        $ACT_USED = "USED";
        $ACT_EXPIRED = "EXPIRED";
        $DEACT_OK = "OK";
        $DEACT_ERROR = "ERROR";
        $DEACT_UNKNOWN = "UNKNOWN";

        if (empty($_GET["code"]) || empty($_GET["hwid"]) || empty($_GET["hash"]) || empty($_GET["ip"])) {
            die($ACT_BAD);
        }

        $ipAddress = $_GET["ip"];
        $code = $_GET["code"];
        $hwid = substr($_GET["hwid"], 0, 32);

        // Tìm key
       
        $key = Key::where('key', '=', $code)->where('tool_id', $toolId)->first();
		
        if ($key == null) {
            //FREEEE
            /*
            $timeExpire = date('Y-m-d', time() + 15 * 60 * 60);
            $endTime = date("H:i d/m", time() + 15 * 60 * 60);
            $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => $keyMode);

            $l = $this->initLicense($toolId);
            $l->email = 'HSD: '.$endTime.' (GMT+7)';
            $l->CreateSerialNumber($sn_data);
            die("OK\n" . $l->sn);
            */
            //FREEEE
            die($ACT_BAD);
        }

        // Tìm mode của key
        $keyMode = base64_encode($key->mode);

        // Check hwid bị khóa thì thoi
        if ($this->checkHackByHwid($hwid)) {
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
            if (Carbon::createFromTimestamp($key->active_time)->addHour($key->package) < Carbon::now()->addSeconds($key->hwid_count * 60 * 60)) {
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

            $timeExpire = Carbon::createFromTimestamp($key->active_time + $key->hwid_count * 60 * 60)->addHour($key->package)->format('Y-m-d');
            $endTime = date("H:i d/m", $key->package * 60 * 60 + $key->active_time - 60 * 60 * ($key->hwid_count));
            $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => $keyMode);

            $l = $this->initLicense($toolId);
            // $l->name = $ipAddress;
            $l->email = '' . $endTime . ' (GMT+0)';
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
                $endTime = date("H:i d/m", $key->package * 60 * 60 + $key->active_time - 60 * 60 * ($key->hwid_count));
                $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => $keyMode);
                $l = $this->initLicense($toolId);
                $l->email = '' . $endTime . ' (GMT+0)';
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
                $endTime = date("H:i d/m", $key->package * 60 * 60 + $key->active_time - 60 * 60 * ($key->hwid_count));
                $sn_data = array("hardwareid" => $hwid, 'expiredate' => $timeExpire, 'data' => $keyMode);
                $l = $this->initLicense($toolId);
                $l->email = '' . $endTime . ' (GMT+0)';
                /*
                if ($key->hwid_count > 1) {
                    $l->email .= ' (-'.number_format($key->hwid_count * 60).' minutes because change computer)';
                }*/
                if (isset($_GET['debug'])) {
                    $l->email = $hwid;
                }
                $l->CreateSerialNumber($sn_data);
                die("OK\n" . $l->sn);
            }
        }

        die($DEACT_UNKNOWN);
    }
	
    private function exportFile($subFolder, $code, $realFileName = "", $fixedFileName = "")
    {
        $rootFolderPath = '/home/cheatsharp.com/public_html/files_v3/';
        $fileLocation = $rootFolderPath . $subFolder . '/';
        // If realFileName is empty, choose a random file in folder
        $tempInt = 0;
        if ($realFileName == "") {
            $codeToChars = str_split($code);
            foreach ($codeToChars AS $c) {
                $tempInt += ord($c);
            }
            $randomFiles = array();
            $files = scandir($fileLocation);
            foreach ($files AS $f) {
                if ($f != '.' && $f != '..') {
                    $randomFiles[] = $f;
                }
            }
            if (count($randomFiles) == 0) {
                $filePath = $rootFolderPath . 'NOT_FOUND_ANY_FILE.exe';
                $fixedFileName = 'NOT_FOUND_ANY_FILE.exe';
            } else {
                $filePath = $fileLocation . $randomFiles[$tempInt % count($randomFiles)];
            }
        } else {
            $filePath = $fileLocation . $realFileName;
        }

        if (file_exists($filePath)) {

            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public"); // needed for internet explorer
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:" . filesize($filePath));
            if ($fixedFileName != '') {
                header("Content-Disposition: attachment; filename=" . $fixedFileName);
            } else {
                header("Content-Disposition: attachment; filename=" . ($this->RandomString(10)));
            }
            readfile($filePath);
            file_put_contents('log.txt', date("d/m/Y H:i:s", time()) .' '. $code . ' Xuat file ' . $filePath . "\n", FILE_APPEND);
            die();
        } else {
            file_put_contents('log.txt', date("d/m/Y H:i:s", time()) . ' Error: File not found. ' . $filePath . "\n", FILE_APPEND);
            die("Error: File not found.");
        }
    }

    public function download($toolId = 999, $fileType, $code, $sub_folder = "")
    {
        // Xóa hết kí tự đặc biệt trong key
        $code = preg_replace('/[^A-Za-z0-9]/', '', $code);
 
        // Tìm key trong database
        $key = Key::where('key', '=', $code)->first();


        if (!$key) {
            // Nếu không thấy thì trả về file KEY_NOT_FOUND.exe
            $this->exportFile('', 'BLAHBLADCODE', 'KEY_NOT_FOUND.exe', 'KEY_NOT_FOUND.exe');
        }
        if ($toolId == 999) {
            $toolId = $key->tool_id;
        }

        // Check xem có hết giờ thì trả về file EXPIRED.exe
        if ($key->active_time != null && Carbon::createFromTimestamp($key->active_time)->addHour($key->package) < Carbon::now()->addSeconds($key->hwid_count * 60 * 10)) {
            $this->exportFile('', 'BLAHBLADCODE', 'EXPIRED.exe', 'EXPIRED.exe');
        }

        switch ($fileType) {
			case 'rl':
				$fileName = $this->RandomString(5).'.exe';
                $this->exportFile($toolId.'/RootLoader/Random', $code, "", $fileName);
                break;
            case 'st':
                $this->exportFile($toolId.'/Starter', $code, "", "");
                break;
            case 'dn':
                $this->exportFile($toolId.'/Driver', $code, "driver_name.txt", "");
                break;
            case 'loader':
                $this->exportFile($toolId.'/Driver/Loader', $code, "", "");
                break;
            case 'sd':
                $this->exportFile($toolId.'/Driver/sDriver', $code, "", "");
                break;
            case 'ud':
                $this->exportFile($toolId.'/Driver/usDriver', $code, "", "");
                break;
				
            case 'cl':
                $this->exportFile($toolId.'/Tool/Caller', $code, "", "");
                break;
			case 'ed':
                $this->exportFile($toolId.'/Tool/Main', $code, "", "");
                break;
            case 'dd':
                $this->exportFile($toolId.'/Tool/Data/'.$sub_folder, $code, "", "");
                break;
            default:
                $this->exportFile('', 'BLAHBLADCODE', 'METHOD_NOT_FOUND.exe', 'METHOD_NOT_FOUND.exe');
                break;
        }
    }

    public function check($code)
    {
        // Tìm key
        $key = Key::where('key', '=', $code)->first();
        if ($key == null) {
            die("FAIL");
        }

        if ($key->active_time == NULL) {
            die("OK");
        }
        if ($key->active_time + $key->package * 60 * 60 <= time()) {
            die("FAIL");
        }
        die("OK");

    }

    public function initLicense($toolId)
    {
        $l = new License();
        // PC, Apex
        if ($toolId == 6 || $toolId == 7) {
            $bits = 2048;
            $product_code = 'j3cIHUSxRns=';
            $public_exp = 'AQAB';
            $private_exp = 'AKQKpnOhIu/eLn0LvyMIOUcDDtmJgV2t5y9n06Fo/UriaGFKy5zNEoZel8ieU5UX7Xf0/jWmF8GQgOhb0jnjYOFyxX+5UCs3jdSrkZKPeOyvCa0y40mhY6xFb2zrqjVx/WaES/lgmvcb5uzvWWw2Db9jFpGc82hZa1v7s528vMuxVcQa0MvTc17v2nHqQTQTjz5ApvE5+tS5UrM9X2VC3BeSVm6nH/CsLi+gvU4fGjN8NtEcIkZZc8LtARp/5N5d7+Hvoio2gVo9duYPV4W2xELPm6UmZRo1n/u9As/4N8XdJTd/Jtg7Rz3TNZZfPy68bZZ+IFMI2aajWlAxv5x211E=';
            $moduls = 'AMXJ29SJRhwakwHjxTwsf9uCnZn1qV1Pt5HcpNRINEcnZztymQ51IQbshpoMRk4J6XowHapK+hQEjUdQbn/b9HlvbuAOsaotV1zcIHNzdTGzva/7yEa+ep9Hzv3hit9/rm3Uonn1LbUBbV6k8CiwpQ5m167R62yk9DL+OPeCix6WjmYLYC6unOM2wIBLRmscyypm7IQT5Iwh+abROHvxM6vsaHaFANxYSes5G3yCvvHI7Kr3rHsx3NZknFtlLmGK8v51Hkc2IjNRLW6MQcutI4z2IunbANXtW3wcA5/RUTpUHAJZMzevGc6Xu5ipgKheshqJAzxTtCinlMfjZp+vZ/E=';

            $l->init($bits, $product_code, $public_exp, $private_exp, $moduls);
        }
        // Lite
        if ($toolId == 2 || $toolId == 8 || $toolId == 10 || $toolId == 20) {
            $bits = 4096;
            $product_code = 'uhAMb3VdgXQ=';
            $public_exp = 'AQAB';
            $private_exp = 'PYkiFjMEkgE0w6fVVT8YqDHi+xKP7VxyGMMA0iytwp7kCoH+HV5e/jZa3U8IeNXicbTi1q6jju9mM4lHWHDQ+k3qfRTvve3z3OIioYqfqXl6Dnnd4TNCEMt1Z6KzcnfDGuD4wlBkq8XUrBDix09V1jjuMyNkzh2y1828PVKC4tKg2lCo3UHVBva63u1ZDr4k7bUr84pQDjLR+07kF+OLEvY03agzP+A8hzyRL7Qt4AnWVCG2JBmwM1XeHnktQm+q/LJ0DpM0Z6ITp0575yMRWkJZ+7cQtpHOhJnRnrNJG8W9lqHaQR+m6s0o5TPtchY78PspXC387q7fi2ZCBtSchVEviHJj3ofzWUV1nvXjtaECShorSzvfPy6iYUB3H92ME2IjfadCQpuqcIknTx70GLtCjO5236YVuGtkyIltfoPRFAifkVYkTgiyUmu8zbXVGVv4RkY8FlcS3LDNbnpiu4Uldw1+YhJ1I61lDQHywB980EYrBC1r4f5JpjI8qSbsD+rNxM88Dc/g+T9IvJVcCsKeSHDVXhx4qrhAKupE/Yg7nZTsKM6L6RYoPizY6nYETZVpDvE8lFEXl0nRM0H1VuipHrV9ikU4J4tBLXP3ySXTW8knctj9h0NZp3P4O0eOK1qdwWzH21Y1PuIr/ReaIYIlKNs+ayOyQ7OSjUWtlvE=';
            $moduls = 'ALQs4B3jAQG5dr1uO2rc93LBk9Zi1Ewhb7LVgX6duA06mcFqbkVK3GcKzDJkMBSo5afD8BMMaYPk1oz4OKgs2anpHJfVmZ+mK2Euq3yIHfd7GAGZr7kCs8V1bbUKnV34ibwWI2yn12wq9qG3ueot1KuuklQ4IiVh+JU9aDeGZspXoOYLFbINOYbsJ4vMzoMVq3od3sWAYOb5T69PCTdFpwYiMgZk6Oi4JPWMJT4negDvP6Xf+pObcnbbUIK+G2BYuT3tIxzZBYild0t/tfNuHK1LOb9YhI22p2Z4Xj+3QcPN1DMYYgdF5L0glM2DkfNwMDXhzz80y66n8nv6QH7kZP8mbF8aBufF+f+ZWpjI1feCKDVUJyorwtJtL0fhOpJY7eeIloYKTHb47JBwZvwOgn9sC4YzQYKGGBZq1jLR+i5DCqiPJVkgpK4Uqqku3egqk+JbT7qcWKffwiktKFnBNlnymOWBeA8/SKOjz0dvxXSXqUlB0WFZHYTqMRTxbSOZCCaQ6q+blcfHdNd6Vpfx/mbpROyti8jcc7OVUSjIN/zh3wLDpBZfL3N57K1QldFLt6vyWdz7EoGZjfj+VUbnyfIv41YLMCWcQlbmOjyK88QrWsYmShV39sgHxsaYFQRmEEp4JuThZaSBSm2G6FP5Wh6RJV8k1qutUiiXoGe7m2Ej';

            $l->init($bits, $product_code, $public_exp, $private_exp, $moduls);
        }
        return $l;
    }

    public function checkHackByHwid($hwid)
    {
        $hwid = substr($hwid, 0, -3);
        $hackCount = Hwid::where('hwid', 'LIKE', '%' . $hwid . '%')->orderBy('updated_at', 'desc')->get();
        if (count($hackCount) > 1) {
            return true;
        } else
            return false;
    }

    public function DownloadRootLoader(Request $request)
    {
        $code = preg_replace('/[^A-Za-z0-9]/', '', $_GET['key']);
        $key = Key::where('key', '=', $code)->first();
        if ($key == null) {
            exit('Key is not found');
        }
        if ($key->active_time != null) {
            if (Carbon::createFromTimestamp($key->active_time)->addHour($key->package) < Carbon::now()->addSeconds($key->hwid_count * 60 * 10)) {
                exit('Key is expired');
            }
        }
        return $this->download($key->tool_id, 'rl', $code, '');
    }
}
