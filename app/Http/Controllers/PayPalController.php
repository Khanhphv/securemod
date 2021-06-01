<?php

namespace App\Http\Controllers;

use App\Service\PaypalService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    protected PaypalService $paypalService;

    /**
     * PayPalController constructor.
     * @param PaypalService $paypalService
     */
    public function __construct(PaypalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    function CheckOrder($order_id_paypal)
	{
		if (Auth::user()) {
			$this->paypalService->checkOrder($order_id_paypal);
		} else {
			return 'You must login before use this function';
		}

		return 'Nothing happen';
	}

	function GetAllTransactionsToday()
	{
		$start_date = Carbon::today()->subDays(1)->format('Y-m-d') . 'T00:00:00-0700';
		$end_date = Carbon::today()->format('Y-m-d') . 'T23:59:59-0700';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.paypal.com/v1/reporting/transactions?start_date=$start_date&end_date=$end_date&fields=all&page_size=100&page=1&transaction_type%20=T0000",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Content-Type:  application/json",
				"Authorization:  Bearer " . $this->paypalService->getToken()
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
//        echo '<pre>';
		$response = json_decode($response);
//        print_r($response);
		foreach ($response->transaction_details as $data) {
			$transaction_id = $data->transaction_info->transaction_id;
			$transaction_amount = $data->transaction_info->transaction_amount->value;
			$currency_code = $data->transaction_info->transaction_amount->currency_code;
			$transaction_status = $data->transaction_info->transaction_status;
			$payer_email = isset($data->payer_info->email_address) ? $data->payer_info->email_address : 'null';
			$transaction_note = isset($data->transaction_info->transaction_note) ? $data->transaction_info->transaction_note : 'null';
			$protection_eligibility = $data->transaction_info->protection_eligibility == 01 ? 'yes' : 'no';

			preg_match("/student number (.*?) in your seminar/", $transaction_note, $detect_user);
			$detect_user = isset($detect_user[1]) ? $detect_user[1] : 'null';

			echo "ID: $transaction_id <br> Gửi: $transaction_amount $currency_code <br> Trạng thái: $transaction_status <br> Email: $payer_email <br> Nội dung: $transaction_note<br> Được bảo vệ: $protection_eligibility <br> Người nạp: $detect_user<br><br>======================<br><br>";
		}
	}

	function ReadPaypalEmail()
	{
		$this->paypalService->readEmail();
	}

	function ReadPaypalHoldEmail()
	{
		$this->paypalService->readHoldEmail();
	}

	function insertTransaction(Request $data)
	{
	    $this->paypalService->insertTransaction();
	}
}
