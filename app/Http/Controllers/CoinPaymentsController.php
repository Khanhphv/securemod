<?php

namespace App\Http\Controllers;

use App\Model\History;
use App\Option;
use App\Service\CoinPaymentService;
use App\Transaction;
use App\User;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Log;

class CoinPaymentsController extends Controller
{
    protected CoinPaymentService $coinPaymentService;

    /**
     * CoinPaymentsController constructor.
     * @param CoinPaymentService $coinPaymentService
     */
    public function __construct(CoinPaymentService $coinPaymentService)
    {
        $this->coinPaymentService = $coinPaymentService;
    }

    public function CreateTransaction(Request $request)
    {
        $amount = $request->get('amount');
        $currency = $request->get('currency');
        if (!isset($amount) || !isset($currency)) {
            abort(500);
        }
        $req = [
            'amount' => $amount,
            'currency1' => 'USD',
            'currency2' => $currency,
            'buyer_email' => Auth::user()->email,
            'buyer_name' => Auth::user()->email,
            'item_name' => Auth::user()->email,
            'custom' => Auth::user()->email
        ];
        $create_transaction = $this->coinPaymentService->apiCall('create_transaction', $req);
        if($create_transaction['error'] !== 'ok') {
            dd($create_transaction['error']);
        }
        $checkout_url = $create_transaction['result']['checkout_url'];
        return redirect($checkout_url);
    }

    public function GetListTransactions()
    {
        $yesterday = Carbon::yesterday()->timestamp;
        $transactions_list = $this->coinPaymentService->apiCall('get_tx_ids', ['newer' => $yesterday, 'limit' => 100])['result'];
        $i = 0;
        $y = 0;
        $response[$y] = "";
        foreach ($transactions_list as $transaction) {
            $i++;
            if ($i % 25 == 0) {
                $y++;
                $i = 0;
                $response[$y] = "";
            }
            $response[$y] = $transaction . '|' . $response[$y];
        }
        return $response;
    }

    public function CheckListTransactions()
    {
        $bonus = 1 + ((Option::where('option', 'coinpayment_bonus')->first()->value + 0) / 100);
        $GetListTransactions = $this->GetListTransactions();
        $this->coinPaymentService->checkListTransaction($bonus, $GetListTransactions);
    }
}
