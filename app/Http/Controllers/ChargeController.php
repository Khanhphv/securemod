<?php

namespace App\Http\Controllers;

use App\Model\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use NL_CheckOutV3;

class ChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->nlpayment) {

            $nlcheckout = new NL_CheckOutV3(Config::get('app.MERCHANT_ID'), Config::get('app.MERCHANT_PASS'), Config::get('app.RECEIVER'), Config::get('app.URL_API'));
            $total_amount = $request->total_amount;;

            $array_items[0] = array('item_name1' => 'Product name',
                'item_quantity1' => 1,
                'item_amount1' => $total_amount,
                'item_url1' => 'http://nganluong.vn/');

            $array_items = array();
            $payment_method = $request->option_payment;

            $bank_code = $request->bankcode;;
            $order_code = "macode_" . time();

            $payment_type = 1;
            $discount_amount = 0;
            $order_description = '';
            $tax_amount = 0;
            $fee_shipping = 0;
            $return_url = route('payment.success', $user->id);
            $cancel_url = route('payment.destroy');

            $buyer_fullname = $user->name;
            $buyer_email = 'id_' . $user->id . '@cheatsharp.com';
            $buyer_mobile = '0584707698';
            $buyer_address = 'Nạp tiền cho ID ' . $user->id;

            if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
                if ($payment_method == "VISA") {

                    $nl_result = $nlcheckout->VisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items, $bank_code);

                } elseif ($payment_method == "NL") {
                    $nl_result = $nlcheckout->NLCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items);

                } elseif ($payment_method == "ATM_ONLINE" && $bank_code != '') {
                    $nl_result = $nlcheckout->BankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items);
                } elseif ($payment_method == "NH_OFFLINE") {
                    $nl_result = $nlcheckout->officeBankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                } elseif ($payment_method == "ATM_OFFLINE") {
                    $nl_result = $nlcheckout->BankOfflineCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);

                } elseif ($payment_method == "IB_ONLINE") {
                    $nl_result = $nlcheckout->IBCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                } elseif ($payment_method == "CREDIT_CARD_PREPAID") {

                    $nl_result = $nlcheckout->PrepaidVisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items, $bank_code);
                }


                if (!isset($nl_result)) {

                    echo 'Vui lòng nhập số tiền và chọn ngân hàng hợp lệ';
                    return redirect()->back();

                }
//                else


            }
            return redirect($nl_result->checkout_url);
        }
    }

    public function success(Request $request, $idUser)
    {
        $nlcheckout = new NL_CheckOutV3(Config::get('app.MERCHANT_ID'), Config::get('app.MERCHANT_PASS'), Config::get('app.RECEIVER'), Config::get('app.URL_API'));
        $nl_result = $nlcheckout->GetTransactionDetail($request->token);

        if ($nl_result) {
            $nl_errorcode = (string)$nl_result->error_code;
            $nl_transaction_status = (string)$nl_result->transaction_status;
            if ($nl_errorcode == '00') {
                if (History::where('nl_token', $request->token)->first()) {
                    return redirect()->route('history')->with(['message' => "Giao dịch này đã được hoàn tất"]);
                }
                if ($nl_transaction_status == '00') {
                    //trạng thái thanh toán thành công
                    $user = Auth::user();
                    $tien = $user->credit;
                    $history = new History();
                    $lastCredit = $user->credit + $nl_result->total_amount;
                    if ($nl_result->bank_code == 'MASTERCARD' || $nl_result->bank_code == 'VISA' || $nl_result->bank_code == 'JCB') {
                        $lastCredit -= 5000;
                        $history->action = 'NGAN_LUONG_CREDIT';
                    }
                    $user->credit = $lastCredit;

                    // ghi lại lịch sử
                    $history->action = 'NGAN_LUONG_ATM';
                    $history->user_id = $user->id;
                    $history->amount = $nl_result->total_amount;
                    $history->nl_token = $request->token;
                    $history->content = "Cộng tiền nạp qua Ngân Lượng. Số dư từ " . number_format($tien) . " lên " . number_format($user->credit);
                    $history->content_eng = "Add money deposited via Ngan Luong. Balance from " . number_format($tien) . " to " . number_format($user->credit);
                    $history->revenue = 0;
                    $history->save();

                    $done = $user->save();
                    //update credit
                    if ($done) {
                        return redirect()->route('history')->with(['message' => "Nạp tiền thành công!"]);
                    }
                }
            } elseif ($nl_errorcode == '29') {
                return redirect()->route('history')->with(['message' => "Nạp tiền thành công!"]);
            } else {
                return redirect()->route('history')->with(['message' => $nlcheckout->GetErrorMessage($nl_errorcode)]);
            }
        }
    }

    public function destroy()
    {
        return redirect()->route('home')->with(['message' => 'Bạn đã hủy nạp tiền']);
    }

    // Pay by Selly.io
    public function selly_payment(Request $request){
        $status = $request->get('status');
        $amount = $request->get('value');
        $user = Auth::user();
    }
}
