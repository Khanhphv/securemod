<?php
namespace App\Service;

use App\Blacklist;
use App\Option;
use App\Paypal;
use Exception;
use Illuminate\Support\Facades\Auth;
use Sample\GetOrder;
use App\Model\History;
use App\User;
use Webklex\IMAP\Client;

class PaypalService
{
    public function checkOrder($order_id_paypal) {
        $GetOrder = new GetOrder();
        try {
            $get_data_order = $GetOrder->getOrder($order_id_paypal);
            $user = Auth::user();
            $paypal_status = $get_data_order->status;
            //$payer_name = $get_data_order->payer->name->surname . ' ' . $get_data_order->payer->name->given_name;
            $payer_email_address = isset($get_data_order->payer->email_address) ? $get_data_order->payer->email_address : null;
            $so_tien_nhan_duoc = (float)$get_data_order->purchase_units[0]->amount->value;
            $transactionID = $get_data_order->purchase_units[0]->payments->captures[0]->id;
            $numberOfRecharge = History::where(['user_id'=> $user->id, 'action'=> 'ACCEPTED_PAYMENT'])->count();
            $autoAccept = Option::where('option', 'auto-accept')->first()->value;
            $bonus = 0; //mac dinh
            switch ((int)$so_tien_nhan_duoc){
                case 100:
                    $bonus = 2.5;
                    break;
                case 200:
                    $bonus = 5;
                    break;
                case 500:
                    $bonus = 7.5;
                    break;
            }
            $processedTransaction = History::where('nl_token', $transactionID)->first();
            \Log::info(''. $processedTransaction);
            $isVerify = true;
            if (!$processedTransaction && $get_data_order->id == $order_id_paypal) {
                $old_money_user = $user->credit;

                $history = new History();
                $history->action = 'CHARGE_VIA_PAYPAL';
                $history->user_id = $user->id;
                $history->amount = $so_tien_nhan_duoc;
                $history->revenue = 0;
                $history->nl_token = $transactionID;
                $history->paypal_transaction_status = $paypal_status;

                if (Blacklist::where('email', $payer_email_address)->first()) {
                    $token = 'bot702130564:AAHwDQn6Ip2Y5F1wf7pvxAu-MwdUcXkaxd0';
                    $admin = 702399653;
                    $text = "Có đứa bị blacklist vừa nạp tiền, vào chửi nó nhanh đại ka êiii. Email: " . $payer_email_address;
                    file_get_contents('https://api.telegram.org/' . $token . '/sendMessage?chat_id=' . $admin . '&text=' . (urlencode($text)));

                    $history->content = "Blocked from Admin. Contact to get refund. Paypal email: " . $payer_email_address;
                    $history->need_to_verify = false;
                    $history->save();

                } if ($autoAccept) {
                    $isVerify = false;
                    // Nạp luôn trực tiếp không cần phải verify
                    // Lưu lịch sử nạp qua Paypal
                    $history->content = "Charging via Paypal, transaction ID is " . $transactionID . ". Email: $payer_email_address.";
                    $history->save();
                    // Cộng tiền
                    $user->credit += $so_tien_nhan_duoc + ($so_tien_nhan_duoc * $bonus /100);
                    $user->total_paypal_credit += $so_tien_nhan_duoc * 1;
                    $user->save();

                    // sleep(5);
                    // Lưu lịch sử đươc auto accepted
                    $acceptedHistory = new History();
                    $acceptedHistory->need_to_verify = false;
                    $acceptedHistory->action = 'ACCEPTED_PAYMENT';
                    $acceptedHistory->user_id = $user->id;
                    $acceptedHistory->amount = 0;
                    $acceptedHistory->content = "Auto Accept, transaction ID is " . $transactionID . ". Your balance from " .
                        number_format($old_money_user, 2) . " to " . number_format($user->credit, 2);
                    $acceptedHistory->nl_token = null;
                    $acceptedHistory->save();



//                        if ($numberOfRecharge >= 3) {
//                            $acceptable_percent = (Option::where('option', 'ptram_chap_nhan_thanh_toan')->first()->value) / 100;
//                            $acceptable_money = $acceptable_percent * $user->total_paypal_credit;
//
//                            if ($so_tien_nhan_duoc <= $acceptable_money) {
//                                $history->save(); // Lưu lịch sử nạp qua Paypal
//
//                                $user->credit += $so_tien_nhan_duoc * 1;
//                                $user->total_paypal_credit += $so_tien_nhan_duoc * 1;
//                                $user->save();
//
//                                // Lưu lịch sử đươc auto accepted
//                                $acceptedHistory = new History();
//                                $acceptedHistory->need_to_verify = false;
//                                $acceptedHistory->action = 'ACCEPTED_PAYMENT';
//                                $acceptedHistory->amount = 0;
//                                $acceptedHistory->user_id = $user->id;
//                                $acceptedHistory->content = "Auto Accept, transaction ID is " . $transactionID . ". Your balance from " .
//                                    number_format($old_money_user, 2) . " to " . number_format($user->credit, 2);
//                                $acceptedHistory->nl_token = null;
//                                $acceptedHistory->save();
//
//                            } else { // Cần phải verify trước mới được nạp tiền
//                                $history->need_to_verify = true;
//                                $history->save();
//                            }
//                        }
                } else {
                    $history->content = "Charging via Paypal, transaction ID is " . $transactionID . ". Email: $payer_email_address. Your payment is on hold for moderation. <button class=\"btn btn-success\" onclick='GuideVerify()'>Verify now</button>";
                    $history->need_to_verify = true;
                    $history->save();
                }
            }

            return redirect('/balance')->with('isShowPopup', $isVerify);
        } catch (Exception $e) {
            return 'Lỗi ' . $e;
        }
    }

    public function getToken() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paypal.com/v1/oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic QWJWcngtQjBTV3ZaZXZqdlVNdXZUcE1mVXJrczRqdlBUQk5XLWJtRVdWSlM0QUNUdm9xd1RyeEFCcWNxOFlXR2U1UHhVWmhEVGRoYm5SVDU6RUpYR0VxemNheC1sWGRzcUszSEVDYTdmenVKRnM0S3ZacEZZTVAtdU8tQXZucnRRcGV0LXBWMDhvYnFZSDJnRVh6djE1bjVrbnY4MzBTUVo="
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response)->access_token;
    }

    public function readEmail() {
        $token = 'bot702130564:AAHwDQn6Ip2Y5F1wf7pvxAu-MwdUcXkaxd0';
        $admin = 702399653;

        $oClient = new Client([
            'host' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => false,
            'username' => 'securecheatsxyz@gmail.com',
            'password' => 'Haidang95..',
            'protocol' => 'imap'
        ]);
        $oClient->connect();
        $oFolder = $oClient->getFolder('NAP_TIEN_PAYPAL');


        $aMessage = $oFolder->search()->text('You\'ve received $')->since(date('d.m.Y', time() - 24 * 60 * 60))->get();
        foreach ($aMessage as $key => $oMessage) {
            if (trim($oMessage->getFrom()[0]->mail) != 'service@intl.paypal.com') {
                // LỖI TIN FAKE
                continue;
            }
            $body = preg_replace('/\s+/', ' ', strip_tags($oMessage->getHTMLBody(true)));
            $body = str_replace("&nbsp;", " ", htmlentities($body, null, 'utf-8'));
//            echo $body . '<br><br><br><br>';
            preg_match("/received (.*?) from (.*?) /", $body, $capture);
            preg_match("/Note from (.*?): (.*?) Transaction/", $body, $capture2);
            preg_match("/Transaction ID: (.*?) /", $body, $capture3);
            $sender_name = isset($capture[2]) ? $capture[2] : null;
            $amount = isset($capture[1]) ? (float)str_replace(array('$', 'USD'), '', $capture[1]) : null;
            $note = isset($capture2[2]) ? $capture2[2] : null;
            $transaction_id = isset($capture3[1]) ? $capture3[1] : null;

            // Kiểm tra mã giao dịch xem nếu đã xử lý rồi thì bỏ qua
            $processedTransaction = History::where('nl_token', $transaction_id)->first();
            if ($processedTransaction) {
                $oMessage->moveToFolder('NAP_TIEN_PAYPAL_DONE');
                echo 'Giao dịch ' . $transaction_id . ' đã xử lý trc đó, bỏ qua.<br>';
                continue;
            }

            preg_match("/my email is (.*?), this/", $note, $capture4);
            $email_recharge = isset($capture4[1]) ? str_replace(' ', '', $capture4[1]) : null;

//            echo "$sender_name : $amount : $note : $transaction_id <br>";

            if ($sender_name == null || $amount == null || $note == null || $transaction_id == null || $email_recharge == null) {
//                Lỗi thiếu thông tin
                $oMessage->moveToFolder('NAP_TIEN_PAYPAL_LOI');
                continue;
            }

            $user_recharge = User::where('email', $email_recharge)->first();
            if ($user_recharge) {
                $user_id = $user_recharge->id;
                $tien = $user_recharge->credit;
                $user_recharge->credit = $user_recharge->credit + $amount * 1;
                $history = new History();
                $history->action = 'CHARGE_VIA_PAYPAL';
                $history->user_id = $user_recharge->id;
                $history->amount = $amount * 1;
                $history->content = "Charging via Paypal, transaction code is " . $transaction_id . ". Balance from " . number_format($tien, 2) . " to " . number_format($user_recharge->credit, 2) . ". Name: $sender_name";
                $history->revenue = 0;
                $history->nl_token = $transaction_id;

                $oMessage->moveToFolder('NAP_TIEN_PAYPAL_DONE');

                $history->save();
                $user_recharge->save();
                echo 'Thành viên ' . $user_id . ' vừa nạp ' . $amount . ' qua Paypal <br>';
            } else {
//                Lỗi không tìm được thành viên theo email
                $oMessage->moveToFolder('NAP_TIEN_PAYPAL_LOI');
                $text = "Cấp báo Đại Vương: Có đứa nạp tiền mà ko tìm thấy ID của nó để cộng tiền. Email người gửi " . $email_recharge . " số tiền " . $amount . " tin nhắn: " . $note;
                file_get_contents('https://api.telegram.org/' . $token . '/sendMessage?chat_id=' . $admin . '&text=' . (urlencode($text)));
            }
        }
    }

    public function readHoldEmail() {
        $token = 'bot702130564:AAHwDQn6Ip2Y5F1wf7pvxAu-MwdUcXkaxd0';
        $admin = 702399653;

        $oClient = new Client([
            'host' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => false,
            'username' => '',
            'password' => '',
            'protocol' => 'imap'
        ]);
        $oClient->connect();
        $oFolder = $oClient->getFolder('NAP_TIEN_PAYPAL_HOLD');

        //Get all Messages of the current Mailbox $oFolder

        $aMessage = $oFolder->search()->text('under PayPal Payment Review')->since(date('d.m.Y', time() - 24 * 60 * 60))->get();
        foreach ($aMessage as $key => $oMessage) {
            if (trim($oMessage->getFrom()[0]->mail) != 'service@intl.paypal.com') {
                // LỖI TIN FAKE
                continue;
            }
            $body = preg_replace('/\s+/', ' ', strip_tags($oMessage->getHTMLBody(true)));
            $body = str_replace("&nbsp;", " ", htmlentities($body, null, 'utf-8'));
            echo $body . '<br><br><br><br>';
            preg_match("/received (.*?) from (.*?) /", $body, $capture);
            preg_match("/Note from (.*?): (.*?) Transaction/", $body, $capture2);
            preg_match("/Transaction (.*?) under PayPal Payment Review/", $body, $capture3);
            $sender_name = isset($capture[2]) ? $capture[2] : null;
            $amount = isset($capture[1]) ? (float)str_replace(array('$', 'USD'), '', $capture[1]) : null;
            $note = isset($capture2[2]) ? $capture2[2] : null;
            $transaction_id = isset($capture3[1]) ? $capture3[1] : null;
        }
    }

    public function insertTransaction() {
        //	    \Log::info(json_encode($data));
        $transactionID = $data->get('nl_token');
        $so_tien_nhan_duoc = $data->get('price');
        $user_id = $data->get('user_id');
        $payer_email = $data->get('payer_email');
        $user = User::where('id', $user_id)->first();
        $processedTransaction = History::where('nl_token', $transactionID)->get()->first();
        if($processedTransaction) {
            return response()->json([
                'status' => 0, //error
                'message' => 'Transaction was exist'
            ]);
        }
        $autoAccept = Option::where('option', 'auto-accept')->first()->value;
        $bonus = 0; //mac dinh
        switch ((int)$so_tien_nhan_duoc){
            case 100:
                $bonus = 2.5;
                break;
            case 200:
                $bonus = 5;
                break;
            case 500:
                $bonus = 7.5;
                break;
        }
        $processedTransaction = History::where('nl_token', $transactionID)->first();
        \Log::info(''. $processedTransaction);
        if (!$processedTransaction) {
            $old_money_user = $user->credit;
            $history = new History();
            $history->action = 'CHARGE_VIA_PAYPAL';
            $history->user_id = $user->id;
            $history->amount = $so_tien_nhan_duoc;
            $history->revenue = 0;
            $history->nl_token = $transactionID;
            $history->paypal_transaction_status = 'COMPLETED';

            if (Blacklist::where('email', $user->email)->first()) {
                $token = 'bot702130564:AAHwDQn6Ip2Y5F1wf7pvxAu-MwdUcXkaxd0';
                $admin = 702399653;
                $text = "Có đứa bị blacklist vừa nạp tiền, vào chửi nó nhanh đại ka êiii. Email: " . $user->email;
                file_get_contents('https://api.telegram.org/' . $token . '/sendMessage?chat_id=' . $admin . '&text=' . (urlencode($text)));

                $history->content = "Blocked from Admin. Contact to get refund. Paypal email: " . $user->email;
                $history->need_to_verify = false;
                $history->save();

            } if ($autoAccept) {
                $isVerify = false;
                // Nạp luôn trực tiếp không cần phải verify
                // Lưu lịch sử nạp qua Paypal
                $history->content = "Charging via Paypal, transaction ID is " . $transactionID . ". Email: $user->email.";
                $history->save();
                // Cộng tiền
                $user->credit += $so_tien_nhan_duoc + ($so_tien_nhan_duoc * $bonus /100);
                $user->total_paypal_credit += $so_tien_nhan_duoc * 1;
                $user->save();

                // sleep(5);
                // Lưu lịch sử đươc auto accepted
                $acceptedHistory = new History();
                $acceptedHistory->need_to_verify = false;
                $acceptedHistory->action = 'ACCEPTED_PAYMENT';
                $acceptedHistory->user_id = $user->id;
                $acceptedHistory->amount = 0;
                $acceptedHistory->content = "Auto Accept, transaction ID is " . $transactionID . ". Your balance from " .
                    number_format($old_money_user, 2) . " to " . number_format($user->credit, 2);
                $acceptedHistory->nl_token = null;
                $acceptedHistory->save();
            } else {
                $history->content = "Charging via Paypal, transaction ID is " . $transactionID . ". Email: $user->email. Your payment is on hold for moderation. <button class=\"btn btn-success\" onclick='GuideVerify()'>Verify now</button>";
                $history->need_to_verify = true;
                $history->save();
            }
        }

        return response()->json([
            'status' => 1, //Success
            'message' => 'Success'
        ]);
    }

    public function getListPayment() {
        return Paypal::from('paypal as p')
                ->select('p.id','p.name', 'p.client_id', 'p.client_secret')->get();
    }
}
