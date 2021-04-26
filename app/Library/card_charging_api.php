<?php
/**
 * Card_charging API Class
 *
 * @version	1.1
 * @copyright	Copyright (c) 2017.
 */
class Card_charging_api {

    // Api url
    const URL_API = 'http://tichhop247.com/api';

    // Account id
    protected $_partner_id;

    // Api id
    protected $_partner_key;

    // --------------------------------------------------------------------

    /**
     * Constructor
     * @param array $config		Parameters that initiate API
     * The available parameters are:
     * 	partner_id		Được bên API cấp
     * 	partner_key		Được bên API cấp
     */
    public function __construct(array $config)
    {
        foreach (array('partner_id', 'partner_key') as $p)
        {
            if ( ! isset($config[$p]))
            {
                throw new Card_charging_Exception("This param is required - {$p}");
            }
            else
            {
                $this->{'_'.$p} = $config[$p];
            }
        }
    }

    /**
     * Lấy các loại thẻ từ nhà mạng cung cấp
     */
    public function get_card_keys()
    {
        $params = new stdClass();
        // Set api config
        $params->partner_id    = $this->_partner_id;
        $params->partner_key   = $this->_partner_key;

        // Request to api
        $url = self::URL_API . '/get_telcos';
        $result = $this->_curl($url, $params);
        $result = @json_decode($result);

        return $result;
    }

    // --------------------------------------------------------------------

    /**
     * Kiểm tra ma the
     * @param string 	$key	loại thẻ từ nhà mạng cung cấp
     * @param string 	$code	Mã số dưới lớp tráng bạc trên thẻ
     * @param string 	$serial		Số Serial thẻ cần check (VD: PM0000000001)
     * @param float 	$request_id	Mã tự sinh trong mỗi giao dịch và không giống nhau (Chung toi sẽ luu lai mã này để đối chiếu khi có khiếu lại)
     */
    public function check_card($telco, $code, $serial, $card_amount, $request_id)
    {
        $params = new stdClass();
        $params->telco 	    = trim($telco);
        $params->code 	    = trim($code);
        $params->serial     = trim($serial);
        $params->card_amount     = trim($card_amount);

        return $this->_exec($params);
    }

    // --------------------------------------------------------------------

    /**
     * Send data to the API end received response
     * @param array		$params		Params that will be send
     */
    protected function _exec($params)
    {
        // Set api config
        $params->partner_id    = $this->_partner_id;
        $params->partner_key   = $this->_partner_key;

        // Request to api
        $url = self::URL_API . '/card_charging';
        $result = $this->_curl($url, $params);

        $result = @json_decode($result);

        return $result;
    }

    // --------------------------------------------------------------------

    /**
     * Send data to the server end received response
     * @param string 	$url	URL send request
     * @param array 	$data	Data that will be send
     */
    protected function _curl($url, $data)
    {
        // Check curl library
        if ( ! function_exists('curl_init'))
        {
            exit('Curl library not installed.');
        }

        // Set options
        $opts = array();
        $opts[CURLOPT_URL] = $url;
        $opts[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
        $opts[CURLOPT_HEADER] = false;
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_TIMEOUT] = 300;

        $data = (array)$data;
        if (count($data))
        {
            $opts[CURLOPT_POST] = true;
            $opts[CURLOPT_POSTFIELDS] = http_build_query($data);
        }

        if (preg_match('#^https:#i', $url))
        {
            $opts[CURLOPT_SSL_VERIFYPEER] = FALSE;
            $opts[CURLOPT_SSL_VERIFYHOST] = 0;
            $opts[CURLOPT_SSLVERSION] = 3;
        }

        // Init curl
        $curl = curl_init();
        curl_setopt_array($curl, $opts);
        $res = curl_exec($curl);
        if (
            curl_errno($curl) ||
            curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200
        )
        {
            return false;
        }

        return $res;
    }
}

/**
 * Card_charging Exception class
 */
if ( ! class_exists('Card_charging_Exception'))
{
    class Card_charging_Exception extends Exception {}
}

