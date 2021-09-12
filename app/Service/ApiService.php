<?php

namespace App\Service;

use App\Hwid;
use App\Service\CommonService;

class ApiService
{
    public CommonService $commonService;

    /**
     * ApiService constructor.
     * @param CommonService $commonService
     */
    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function exportFile($subFolder, $code, $realFileName = "", $fixedFileName = "", $folder = 'files') {
        $rootFolderPath = '/home/cheatsharp.com/public_html/'.$folder.'/';
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
                header("Content-Disposition: attachment; filename=" . ($this->commonService->randomString(10)));
            }
            readfile($filePath);
            if ($folder == 'files') {
                file_put_contents('log.txt', date("d/m/Y H:i:s", time()) . ' Xuat file ' . $filePath . "\n", FILE_APPEND);
            } else {
                file_put_contents('log.txt', date("d/m/Y H:i:s", time()) .' '. $code . ' Xuat file ' . $filePath . "\n", FILE_APPEND);
            }

            die();
        } else {
            file_put_contents('log.txt', date("d/m/Y H:i:s", time()) . ' Error: File not found. ' . $filePath . "\n", FILE_APPEND);
            die("Error: File not found.");
        }
    }

    /** check hack By Hwid
     * @param $hwid
     * @return bool
     */
    public function checkHackByHwid($hwid)
    {
        $hwid = substr($hwid, 0, -3);
        $hackCount = Hwid::where('hwid', 'LIKE', '%' . $hwid . '%')->orderBy('updated_at', 'desc')->get();
        if (count($hackCount) > 1) {
            return true;
        } else
            return false;
    }

    /** check hack By Hwid old version
     * @param $hwid
     * @return bool
     */
    public function checkHackByHwidOld($hwid) {
        // Thang nay do pass cua minh
        if (strpos($hwid, 'kDMQph3TtKMTYV5dOtAnE') !== false) {
            return true;
        }

        $hwid = substr($hwid, 0, -3);
        $hackCount = Hwid::where('hwid', 'LIKE', '%' . $hwid . '%')->orderBy('updated_at', 'desc')->get();
        if (count($hackCount) > 1) {
            return true;
        } else
            return false;
    }
}
