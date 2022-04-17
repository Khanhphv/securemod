<?php
namespace App\Service;

use App\Model\History;
use App\Payment;
use App\Transaction;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Log;

class BTCPayService
{
    //yuko QnA time !!11!:
    //Why it's not like coinpayment you may ask?
    //because dumb btcpay just have small brain
    //on making api bruh

    public function apiCallInvoicesPost($body) {
        $btcpay_key = Payment::where('payment_type', 'btcpay')->get()->first();
        $token = $btcpay_key->client_id;
        $storeid = $btcpay_key->client_secret;
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://pay.gura.bar/api/v1/stores/".$storeid."/invoices");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: token ".$token));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        //echo $data;//@!debug
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

    public function apiCallInvoicesGet($body) {
        $btcpay_key = Payment::where('payment_type', 'btcpay')->get()->first();
        $token = $btcpay_key->client_id;
        $storeid = $btcpay_key->client_secret;
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://pay.gura.bar/api/v1/stores/".$storeid."/invoices");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: token ".$token));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        //echo $data;//@!debug
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
        $btcpay_key = Payment::where('payment_type', 'btcpay')->get()->first();
        $token = $btcpay_key->client_id;
        $storeid = $btcpay_key->client_secret;
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        foreach ($GetListTransactions as $ListTransaction) {
            //$out->writeln($ListTransaction);//@!debug
            $body = '{"a":"b"}';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://pay.gura.bar/api/v1/stores/".$storeid."/invoices/".$ListTransaction);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET' );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: token ".$token));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            $data = curl_exec($ch);
            //echo $data;//@!debug
            $data = json_decode($data, TRUE);
            if($data['status']=='Settled')
            {
                if(isset($data['metadata']['buyerEmail']) && preg_match("/@/", $data['metadata']['buyerEmail']))
                {
                    $received = $data['amount'];
                    $received = $received * $bonus;
                    $email_recharge = $data['metadata']['buyerEmail'];
                    $user_recharge = User::where('email', $email_recharge)->get()->first();
                    if ($user_recharge) {
                        $user_id = $user_recharge->id;
                        try
                        {
                            $transaction = new Transaction();
                            $transaction->action = 'CHARGE_VIA_BTCPAY';
                            $transaction->user_id = $user_recharge->id;
                            $transaction->transaction_id = $ListTransaction;
                            $transaction->amount = $data['amount'];
                            $transaction->save();
                            $history = new History();
                            $history->action = 'CHARGE_VIA_BTCPAY';
                            $history->user_id = $user_recharge->id;
                            $history->amount = $received;
                            $tien = $user_recharge->credit += $received;
                            $history->content = "Charging via BTCpay, transaction code is " . $ListTransaction . ". Balance from " . number_format($tien, 2) . " to " . number_format($user_recharge->credit + $received, 2);
                            $history->revenue = 0;
                            $history->nl_token = $ListTransaction;
                            $history->save();
                            $user_recharge->save();
                        }
                        catch (Exception $e)
                        {
                            Log::error('[BTCPAY]' . $e->getMessage());
                            echo ('Loi . TransactionID ' . $ListTransaction . ' đã tồn tại <br>');
                        }

                        echo 'User: ' . $user_id . ' charged ' . $received . ' via BTCpay. TransactionID : ' .$ListTransaction. ' <br>';
                    }
                }   
            }
        }
    }
}
