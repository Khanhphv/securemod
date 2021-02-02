<?php

namespace App\Listeners;

use App\Events\UpdatedUserEvent;
use App\Model\History;
use App\Option;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdatedUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdatedUserEvent $event
     * @return void
     */
    public function handle(UpdatedUserEvent $event)
    {

        $user = $event->user;
        if (!$user) {
            return;
        }
        // Tìm trong bản History xem lý do người này đc cộng tiền là gì.
        $lastHistory = History::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
        // Nếu trừ tiền vì lý do mua key thì người giới thiệu đc hoa hồng
        if($lastHistory && $lastHistory->action != "BUY_KEY") {
            return;
        }
        $originalUser = $user->getOriginal();
        if (!$originalUser) {
            return;
        }


        $decreasedCredit = $originalUser['credit'] - $user->credit ;
        if ($decreasedCredit > 0 && $user->ref_user_id !== null) {
            $refUser = User::where('id', $user->ref_user_id)->first();
            if ($refUser != null) {
                $commission = $refUser->user_ref_commission;
                $refUser->credit = $refUser->credit + $decreasedCredit * $commission / 100;
                $refUser->save();

                $history = new History();
                $history->action = 'COMMISSION';
                $history->user_id = $refUser->id;
                $history->amount = $decreasedCredit * $commission / 100;
                $history->nl_token = "";
                $history->content = "User ".$user->name." (ID ".$user->id.") just buy a key, this is commission for you.";
                $history->content_eng ="User ". $user-> name." (ID ". $user-> id.") just buy a key, this is commission for you.";
                $history->revenue = 0;
                $history->save();
            }
        }
    }
}
