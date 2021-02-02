<?php

namespace App\Http\Controllers\Admin;

use App\Key;
use App\Tool;
use App\Model\History;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Sample\GetOrder;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin\index');
    }

    public function statics(Request $request)
    {
        $key = new Key();
        $start = $request->start;
        if (isset($start)) {
            $startOfDay = Carbon::parse($start)->startOfDay();
            $startOfNextDay = Carbon::parse($start)->addDay(1)->startOfDay();
            $range = [$startOfDay, $startOfNextDay];
        } else {
            $startOfDay = Carbon::now()->startOfDay();
            $startOfNextDay = Carbon::now()->addDay(1)->startOfDay();
            $range = [$startOfDay, $startOfNextDay];
        }

        // $keySoled = Key::selectRaw('*, count(*) as soLuong')->where('user_id', '>', 0)->whereBetween('keys.created_at', $range)->groupBy('tool_id', 'package')->orderByRaw("tool_id ASC, soLuong DESC")->with('getToolName')->get();
        $keySoled = $key->getSoldKey($startOfDay, $startOfNextDay);
        $numberSoldKey = Key::where('user_id', '>', 0)->whereBetween('keys.updated_at', $range)->count();


        $newUser = User::whereBetween('created_at', $range)->count();

        $totalMoneyMonth = History::whereBetween('updated_at', [Carbon::parse($start)->startOfMonth(), Carbon::parse($start)->lastOfMonth()])->sum('revenue');


        $cardMoney = History::whereBetween('updated_at', $range)->where('action', 'NAP_THE_THANH_CONG')->sum('amount');
        $momoMoney = History::whereBetween('updated_at', $range)->where('action', 'NAP_TIEN_MOMO')->sum('amount');
        $commissionMoney = History::whereBetween('updated_at', $range)->where('action', 'HOA_HONG')->sum('amount');
        $adminPlus = History::whereBetween('updated_at', $range)->where('action', 'ADMIN_CONG')->sum('amount');
        $adminMinus = History::whereBetween('updated_at', $range)->where('action', 'ADMIN_TRU')->sum('amount');
        $adminMoney = $adminPlus + $adminMinus;

        $napVaoTrongNgay = History::whereBetween('created_at', $range)->whereIn('action', ['CHARGE_VIA_PAYPAL', 'CHARGE_VIA_COINPAYMENTS', 'ADMIN_CONG'])->sum('amount');
        dd($range);

        $napQuaPaypal = History::whereBetween('created_at', [Carbon::parse($start)->startOfMonth(), Carbon::parse($start)->lastOfMonth()])->whereIn('action', ['CHARGE_VIA_PAYPAL'])->sum('amount');
        $napQuaCoinPayment = History::whereBetween('created_at', [Carbon::parse($start)->startOfMonth(), Carbon::parse($start)->lastOfMonth()])->whereIn('action', ['CHARGE_VIA_COINPAYMENTS'])->sum('amount');
        $napquaAdmin = History::whereBetween('created_at', [Carbon::parse($start)->startOfMonth(), Carbon::parse($start)->lastOfMonth()])->whereIn('action', ['ADMIN_CONG'])->sum('amount');
        $napVaoTrongThang = $napQuaPaypal + $napQuaCoinPayment + $napquaAdmin;

        $atmMoney = History::whereBetween('updated_at', $range)
            ->where(function ($query) {
                return $query->where('action', 'NGAN_LUONG_ATM')->orWhere('action', 'NGAN_LUONG_CREDIT');
            })
            ->sum('amount');

        $moneySpent = History::whereBetween('updated_at', $range)
            ->where(function ($query) {
                return $query->where('action', 'BUY_KEY')->orWhere('action', 'MUA_KEY_DAI_LY')->orWhere('action', 'CHUYEN_TIEN_DI');
            })
            ->sum('amount');
        $moneyReturn = History::where('action', 'NHAN_TIEN')->whereBetween('updated_at', $range)->sum('amount');
        $totalMoneySpent = $moneySpent - $moneyReturn;

        // Cach tinh 1
       // $moneyInterest = History::select('revenue', 'updated_at')->whereBetween('updated_at', $range)->sum('revenue');

        // Cach tinh 2
        $moneyInterest = History::select('revenue', 'updated_at')
            ->whereBetween('updated_at', $range)
            ->where(function ($query) {
                return $query->where('action', 'BUY_KEY')->orWhere('action', 'MUA_KEY_DAI_LY')->orWhere('action', 'CHUYEN_TIEN_DI');
            })
            ->sum('revenue');

        $histories = History::select('histories.*', 'users.email as email')->orderBy('histories.created_at', 'desc')->join('users', 'histories.user_id', '=', 'users.id')->paginate(50);

        $dsTool = Tool::from('tools')
            ->select([
                'tools.id',
                'tools.name',
                'tools.active',
                'tools.package',
                'games.name as game'
            ])
            ->leftJoin('games', 'games.id', '=', 'tools.game_id')
            ->where('tools.active', 1)
            ->get();
        $mangToTool = [];
        $listGame = [];
        if (count($dsTool) > 0) {
            foreach ($dsTool as $itemTool) {
                if (!isset($listGame[$itemTool->game])) {
                    $listGame[$itemTool->game] = [];
                }
            }
            foreach ($dsTool as $itemTool) {
                $cac_gois = json_decode($itemTool->package, true);
                $keyChuaActive = Key::select('package', DB::raw('count(*) as total'))
                    ->where('tool_id', $itemTool->id)
                    ->where('user_id', 0)
                    ->groupBy('package', 'tool_id')->get()->toArray();


                foreach ($keyChuaActive AS $k) {
                    unset($cac_gois[$k['package']]);
                }

                foreach ($cac_gois AS $gio => $gia) {
                    $keyChuaActive[] = array('package' => $gio, 'total' => 0);
                }
                $mangToTool[$itemTool->name] = $keyChuaActive;
                array_push($listGame[$itemTool->game], array(
                    'tool' => $itemTool->name, 'data' => $keyChuaActive
                ));
            }
        }

        return view('admin.statics.statics',
            compact(
                'start',
                'end',
                'keySoled',
                'numberSoldKey',
                'newUser',
                'totalMoneyMonth',
                'histories',
                'detailRestKeys',
                'napQuaPaypal',
                'napQuaCoinPayment',
                'napquaAdmin',
                'napVaoTrongNgay',
                'napVaoTrongThang',
                'moneySellingKeyQTV',
                'moneyChangeInDay',
                'cardMoney',
                'momoMoney',
                'commissionMoney',
                'adminMoney',
                'atmMoney',
                'totalMoneySpent',
                'moneyInterest',
                'listGame',
                'mangToTool'
            ));
    }

    /**
     * Support view
     *
     * @return view
     */
    public function support(){
        $histories = History::where('need_to_verify', true)->orderBy('created_at', 'DESC')->get();
        $blacklist = \App\Blacklist::get();
        return view('support.statistic', compact('histories', 'blacklist'));
    }
}
