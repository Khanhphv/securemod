<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Client;
use App\Model\History;
use App\User;
use App\Transaction;
use App\Option;

class CronController extends Controller
{
    public function momo()
    {
        return response()->json("Done");

    }

    public function get_web_page($url)
    {
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST => "GET",        //set request type post or get
            CURLOPT_POST => false,        //set to GET
            CURLOPT_USERAGENT => $user_agent, //set user agent
            CURLOPT_COOKIEFILE => "cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR => "cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING => "",       // handle all encodings
            CURLOPT_AUTOREFERER => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT => 120,      // timeout on response
            CURLOPT_MAXREDIRS => 10,       // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $content;
    }

    public function checkCard()
    {
       
       return true;
    }

    public function doiDauSo($phone)
    {
        $phone = preg_replace('/^84/', "0", $phone);
        $phone = preg_replace('/^016/', "03", $phone);
        $phone = preg_replace('/^0120/', "070", $phone);
        $phone = preg_replace('/^0121/', "079", $phone);
        $phone = preg_replace('/^0122/', "077", $phone);
        $phone = preg_replace('/^0126/', "076", $phone);
        $phone = preg_replace('/^0128/', "078", $phone);
        $phone = preg_replace('/^0123/', "083", $phone);
        $phone = preg_replace('/^0124/', "084", $phone);
        $phone = preg_replace('/^0125/', "085", $phone);
        $phone = preg_replace('/^0127/', "081", $phone);
        $phone = preg_replace('/^0129/', "082", $phone);
        $phone = preg_replace('/^0188/', "058", $phone);
        $phone = preg_replace('/^0186/', "056", $phone);
        $phone = preg_replace('/^0199/', "059", $phone);
        return $phone;
    }
}
