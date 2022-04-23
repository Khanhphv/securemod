<?php

namespace App\Http\Controllers;

use App\Model\History;
use App\Option;
use App\Service\BTCPayService;
use App\Transaction;
use App\User;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Log;

class BTCPayController extends Controller
{
    protected BTCPayService $btcpayService;

    /**
     * CoinPaymentsController constructor.
     * @param BTCPayService $coinPaymentService
     */
    public function __construct(BTCPayService $btcpayService)
    {
        $this->btcpayService = $btcpayService;
    }

    public function CreateTransaction(Request $request)
    {
        $amount = $request->get('amount');
        if (!isset($amount)) {
            abort(500);
        }
        $body = '{
            "amount": '.$amount.',
            "currency": "USD",
            "metadata":{
                "buyerEmail": "'.Auth::user()->email.'",
                "buyerName": "'.Auth::user()->name.'",
                "itemDesc": "'.Auth::user()->email.'",
            },
            "checkout":{
                "redirectURL": "'.url('/balance/checking').'/{InvoiceId}",
                "redirectAutomatically": true
            }
        }';

        //yuko QnA time !!11!: 
        //Using string instead array in here because
        //btcpay does not accept it, if you trying it'll return error 415
        //or some random error so string is the best in this case.

        $create_transaction = $this->btcpayService->apiCallInvoicesPost($body);
        if(isset( $create_transaction['path'])) { //wonder if this work lmao
            dd($create_transaction['message']);
        }
        $checkout_url = $create_transaction['checkoutLink'];
        return redirect($checkout_url);
    }

    public function GetListTransactions()
    {
        $yesterday = Carbon::yesterday('Asia/Ho_Chi_Minh')->timestamp;
        $today = Carbon::now('Asia/Ho_Chi_Minh')->timestamp;
        $body = '{"a":"b"}'; //this get request does not required body so this is just for the function
        $CheckListTransaction = $this->btcpayService->apiCallInvoicesGet($body);
        $inrange = array();
        foreach ($CheckListTransaction as $transaction) {
            if($transaction['createdTime'] >= $yesterday && $transaction['createdTime'] <= $today){
                $inrange[] = $transaction['id'];
            }
        }
        return $inrange;
    }

    public function CheckListTransactions()
    {
        $bonus = 1 + ((Option::where('option', 'coinpayment_bonus')->first()->value + 0) / 100);
        $GetListTransactions = $this->GetListTransactions();
        $this->btcpayService->checkListTransaction($bonus, $GetListTransactions);
    }
}
