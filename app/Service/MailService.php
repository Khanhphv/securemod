<?php


namespace App\Service;
use App\Key;
use App\Tool;
use Mail;
use Exception;

class MailService
{
    public static function invoiceMail(string $emailName, Key $key, float $price,Tool $tool):void
    {
        try {
            Mail::send('emails.invoice2',
                array(
                    'userName'=> $emailName,
                    'key' => $key,
                    'price' => $price,
                    'game' => $tool
                ),
                function($message) use ($emailName){
                    $message->to($emailName, config('const.email.name'))
                        ->subject(config('const.email.subject.invoice'))
                        ->from(config('const.email.email'), config('const.email.name'));
                });
        } catch (Exception $e) {
            throw $e;
        }

    }
}
