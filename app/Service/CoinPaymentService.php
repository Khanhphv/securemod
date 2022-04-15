<?php
namespace App\Service;

use App\Model\History;
use App\Payment;
use App\Transaction;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Log;

class CoinPaymentService
{
    public function apiCall($cmd, $req = []) {
        $coin_payment_key = Payment::where('payment_type', 'Coin Payments')->get()->first();
        $public_key = $coin_payment_key->client_id;
        $private_key = $coin_payment_key->client_secret;
//        $public_key = '033cc8325b2bba4282214f2629081e37e53b20a66b77c001673152768a09a710';
//        $private_key = '00a5Eaf1fC670E820BD3f20bef96a255bb016f21bf244F7903f51297b6Bb13C1';

        // Set the API command and required fields
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml

        // Generate the query string
        $post_data = http_build_query($req, '', '&');

        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $private_key);

        // Create cURL handle and initialize (if needed)
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        // Parse and return data if successful.
        if ($data !== FALSE) {
            if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
                // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
                $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
            } else {
                $dec = json_decode($data, TRUE);
            }
            if ($dec !== NULL && count($dec)) {
                return $dec;
            } else {
                // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                return array('error' => 'Unable to parse JSON result (' . json_last_error() . ')');
            }
        } else {
            return array('error' => 'cURL error: ' . curl_error($ch));
        }
    }

    public function checkListTransaction($bonus, $GetListTransactions) {
        foreach ($GetListTransactions as $ListTransaction) {
            $ListTransaction = mb_substr($ListTransaction, 0, -1);
            $CheckListTransaction = $this->apiCall('get_tx_info_multi', ['txid' => $ListTransaction])['result'];
            foreach ($CheckListTransaction as $TransactionID => $TransactionInfo) {
                $status = isset($TransactionInfo['status']) ? $TransactionInfo['status'] : 0;
                if ($status == 100) {
                    Log::info('[Coinpayment]TransactionID: ' . $TransactionID);
                    $is_exist_transaction = Transaction::where("transaction_id", $TransactionID);
                    if($is_exist_transaction->count() > 0) continue;
                    $checkTransaction = $this->apiCall('get_tx_info', ['txid' => $TransactionID, 'full' => 1])['result'];
                    if (isset($checkTransaction['checkout']['custom']) && preg_match("/@/", $checkTransaction['checkout']['custom'])) {
                        $received = $checkTransaction['checkout']['amountf'];
                        $received = $received * $bonus;
                        $email_recharge = $checkTransaction['checkout']['custom'];
                        $user_recharge = User::where('email', $email_recharge)->first();
                        if ($user_recharge) {
                            $user_id = $user_recharge->id;
                            try {
                                $transaction = new Transaction();
                                $transaction->action = config('const.action.recharge_via_coinpayment');
                                $transaction->user_id = $user_recharge->id;
                                $transaction->transaction_id = $TransactionID;
                                $transaction->amount = $checkTransaction['checkout']['amountf'];
                                $transaction->save();
                                $history = new History();
                                $history->action = config('const.action.recharge_via_coinpayment');
                                $history->user_id = $user_recharge->id;
                                $history->amount = $received;
                                $tien = $user_recharge->credit;
                                $history->content = "Charging via CoinPayments, transaction code is " . $TransactionID . ". Balance from " . number_format($tien, 2) . " to " . number_format($user_recharge->credit + $received, 2);
                                $history->revenue = 0;
                                $history->nl_token = $TransactionID;
                                $history->save();

                                $user_recharge->credit = $user_recharge->credit + $received;
                                $user_recharge->save();

                            } catch (Exception $e) {
                                Log::error('[CoinPayment]' . $e->getMessage());
                                echo ('Loi . TransactionID ' . $TransactionID . ' đã tồn tại <br>');
                            }

                            echo 'User: ' . $user_id . ' charged ' . $received . ' via CoinPayments. TransactionID : ' .
                                $TransactionID. ' <br>';
                        }
                    }
                }
            }
        }
    }
}
