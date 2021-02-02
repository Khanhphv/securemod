<?php


namespace App\Service;

use App\Model\History;
use Carbon\Carbon;
use SellySample\Selly;
class CommonService
{
    public static function  sellyClient()
    {
        $sellyService = new Selly();
        $sellyService->client();
    }
    public static function roleMember()
    {
        $startDate = Carbon::create(2020, 12,1)->startOfMonth();
        $endDate = Carbon::create(2020, 12,1)->addMonths(2)->endOfMonth();;
        $range = [$startDate, $endDate];
        $user = \Auth::user();
        $totalRechargeMoney = History::from('histories as hi')
            ->select(\DB::raw('sum(amount) as sum'))
            ->where('user_id', \Auth::user()->id)
            ->where('action', 'BUY_KEY')
            ->whereBetween('created_at', $range)
            ->get();
        $totalMoney = ($totalRechargeMoney->first()->sum);
        $role = config('const.role_member.member_status.silver');
        if ($totalMoney >= 500) {
            $role = config('const.role_member.member_status.diamond');
        } elseif ($totalMoney >= 200 && $totalMoney < 500) {
            $role = config('const.role_member.member_status.platinum');
        } elseif ($totalMoney >= 100 && $totalMoney < 200) {
            $role = config('const.role_member.member_status.gold');
        }
        $user->role_member = $role;

        $role_status = array_search($role, config('const.role_member.member_status'), true );
        $discount = config('const.role_member.discount')[$role_status];
        $user->save();
        return [
            'role' => $role,
            'totalMoney' => $totalMoney,
            'discount' => $discount
        ];
    }
}
