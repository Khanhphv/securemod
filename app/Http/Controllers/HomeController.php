<?php

namespace App\Http\Controllers;

use App\Key;
use App\Model\Game;
use App\Model\History;
use App\Service\CommonService;
use App\Service\MailService;
use App\Tool;
use App\Transaction;
use App\User;
use App\Hwid;
use App\HwidLogs;
use App\HeadTag;
use Carbon\Carbon;
use Card_charging_api;
use Card_charging_Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Option;
use DB;
use Exception;
use Illuminate\View\View;


class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function landing(): View
    {
      $games = Game::get();

      # get head tags
      $head_tags = HeadTag::where('type', 'welcome')->first();
      return view('new.landing', compact('games', 'head_tags'));
    }

    /**
     * Home page screen
     * @return View
     */
    public function homePage(): View
    {
        $games = Game::from('games as gm')
            ->select([
                DB::raw('COUNT(\'ke.id\') as count'),
                'gm.name as name',
                'gm.thumb_image',
                'gm.views',
                'gm.id as id',
                'gm.slug',
                'gm.created_at'
            ])
            ->leftJoin('tools as tl', 'tl.game_id','=', 'gm.id')
            ->leftJoin('keys as ke', 'ke.tool_id', '=', 'tl.id')
            ->groupBy('id')
            ->orderBy('gm.order', 'asc')
            ->get();
        Session::remove('selectedGame');
        $listTools = Tool::where('active', true)->orderBy('order')->get();

        # get head tags
        $head_tags = HeadTag::where('type', 'home')->first();
        return view('new.home', compact('games', 'head_tags'));
    }


    public function buyTool($toolId, $package)
    {
        $ip_address = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        /*
        if(session()->has('time') && session()->get('time') > Carbon::now() &&  session()->get('idTool') == $toolId)
        {
            session()->flash('message', 'Bạn đã mua key và vẫn còn hạn sử dụng, vui lòng kiểm tra lại lịch sử!');
            return  redirect()->route('home');
        }*/

        if (!Auth::check()) {
            return json_encode(array(
                'code' => 190,
                'status' => 'fail',
                'message' => "Please login before buy!",
                'key' => "",
                'time' => ""
            ));
        }

        $user = Auth::user();
        $toolDetail = Tool::find($toolId);
        $packages = json_decode($toolDetail->package, true);
        if($toolDetail->discount && $toolDetail->discount > 0) {
            $discount = $toolDetail->discount /100;
        } else {
            // xác định role của member để discount
            $role_member = CommonService::roleMember()['role'];
            $role = array_search($role_member, config('const.role_member.member_status'), true );
            $discount = config('const.role_member.discount')[$role];
        }

        if (isset($packages[$package])) {
            $price = (float)$packages[$package] - (float)$packages[$package]* $discount;
            $price = round($price,2);
        } else {
            return json_encode(array(
                'code' => 404,
                'status' => 'fail',
                'message' => "Something wrong, please ask for Admin about this case. Thank you!",
                'key' => "",
                'time' => ""
            ));
        }

        if ($user->credit < $price) {
            return json_encode(array(
                'code' => 2,
                'status' => 'fail',
                'message' => "Not enough money, please recharge...",
                'key' => "",
                'time' => ""
            ));
        } else {

            // Tool của mình sản xuất được
            if ($toolDetail->author == "me") {
                DB::beginTransaction();
                try {
                    $costs = json_decode($toolDetail->cost, true);
                    if (isset($costs[$package])) {
                        $cost = $costs[$package];
                    } else {
                        $cost = 0;
                    }

                    $history = new History();
                    $history->action = 'BUY_KEY';
                    $history->user_id = $user->id;
                    $history->amount = $price;
                    $lastCredit = $user->credit - $price;
                    $history->content = "Buy tool " . $toolDetail->name . " package " . $package . ". Your balance from " . number_format($user->credit) . " to " . number_format($lastCredit);
                    $history->revenue = $price - (int)$cost;
                    $history->ip = $ip_address;
                    $history->save();

                    $newKey = generateRandomString(20);

                    $data = [$newKey];
                    $rules = array(
                        'required|unique:keys,key'
                    );
                    $messages = [];
                    $attributes = ['key']; // use your actual fields here
                    $validator = Validator::make($data, $rules, $messages, $attributes);
                    if ($validator->fails()) {
                        return json_encode(array(
                            'status' => 'fail',
                            'message' => "Something wrong, please try again later.",
                            'time' => ""
                        ));
                    }
                    $key = new Key();
                    $key->tool_id = $toolId;
                    $key->key = generateRandomString(20);;
                    $key->package = $package;
                    $key->user_id = $user->id;
                    $key->sold = 1;
                    $key->history_id = $history->id;
                    $key->save();

                    // Cập nhật số tiền của khách sau khi thuê
                    $user->credit = $lastCredit;
                    $user->save();
                    MailService::invoiceMail($user->email, $key, $price, $toolDetail);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    return json_encode(array(
                        'status' => 'fail',
                        'message' => "Something wrong, please try again later.",
                        'time' => ""
                    ));
                }

                return json_encode(array(
                    'status' => 'success',
                    'message' => "Buy successfully",
                    'time' => date("d/m/Y H:i", time())
                ));
            } else {
                //$package = json_decode($toolDetail->package);
                $key = Key::where([['tool_id', $toolId], ['user_id', 0], ['package', '=', $package]])->first();

                // Nếu trong kho hết key mà có API để lấy thì gọi lên lấy thêm
                if($key == null && $toolDetail->api_get_key != null) {

                //$package = "", $number = 0, $prefix = "", $additionalInfo
                    $content = @file_get_contents($toolDetail->api_get_key.$package.'/1/GD/user_'.$user->id);
                    if($content) {
                        $data = json_decode($content);
                        if($data->status == "success") {
                            $key = new Key();
                            $key->tool_id = $toolId;
                            $key->package = $package;
                            $key->key = $data->keys[0];
                            $key->user_id = $user->id;
                            $key->save();
                        }
                    }
                }
                // Hết đoạn gọi lên API lấy key


                if ($key != null) {
                    $costs = json_decode($toolDetail->cost, true);
                    if (isset($costs[$package])) {
                        $cost = $costs[$package];
                    } else {
                        $cost = 0;
                    }
                    $lastCredit = $user->credit - $price;

                    DB::beginTransaction();
                    // ghi lại lịch sử
                    try {
                        $history = new History();
                        $history->action = 'BUY_KEY';
                        $history->user_id = $user->id;
                        $history->amount = $price;
                        $history->content = "Buy " . $toolDetail->name . " package " . $package . ". Your balance from " . number_format($user->credit) . " to " . number_format($lastCredit);
                        $history->ip = $ip_address;
                        $history->revenue = $price - (int)$cost;
                        $history->save();

                        $key->user_id = $user->id;
                        $key->history_id = $history->id;
                        $key->sold = 1;
                        $key->save();

                        $user->credit = $user->credit - $price;
                        $user->save();
                        MailService::invoiceMail($user->email, $key, $price, $toolDetail);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                        return json_encode(array(
                            'status' => 'fail',
                            'message' => "Something wrong, please try again later.",
                            'time' => ""
                        ));

                    }

                    return json_encode(array(
                        'status' => 'success',
                        'message' => "Successfully!",
                        'time' => Carbon::parse($key->updated_at)
                        ->addHour($key->package)
                    ));
                } else {
                    return json_encode(array(
                        'status' => 'fail',
                        'message' => "Sorry, this product is out of stock",
                        'time' => ""
                    ));
                }
            }
        }

    }

    public function toolOfGame($slug = 'pubg-mobile')
    {
        $game = Game::where('slug', $slug)->first();
        if (!$game) {
            redirect('/');
        } else {
            $listTools = Tool::where('game_id', $game->id)->where('active', true)->orderBy('order')->get();
            foreach ($listTools AS &$tool) {
                $tool->package = json_decode($tool->package);
            }
            return view('home.page.game', compact('game', 'listTools'));
        }
    }

    public function profile()
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->firstOrFail();
            $keys = Key::where('keys.user_id', Auth::user()->id)
            ->join('histories', 'keys.history_id', '=', 'histories.id')
            ->join('tools', 'keys.tool_id', '=', 'tools.id')
            ->join('games', 'tools.game_id', '=', 'games.id')
            ->select("keys.*", "histories.created_at AS history_created_at", "tools.name AS tool_name", "games.name AS game_name")
            ->orderBy('key.updated_at', 'desc')
            ->paginate(20);
            return view('home.page.profile', compact('keys', 'user'));
        } else {
            return redirect()->route('login');
        }
    }


    //===============ĐẠI LÝ=================//


    public function changePassword()
    {
        $user = Auth::user();
        return view('home.page.change-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ], [
            'oldPassword.required' => 'Please enter your old password',
            'password.required' => 'Please enter your new password',
            'password.same' => 'Retype password is incorrect',
            'password_confirmation.required' => 'Please enter password confirmation',
        ]);

        $user = Auth::user();
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('password.edit')->with(['level' => 'success', 'message' => 'Change password successfully!']);
        } else {
            return redirect()->route('password.edit')->with(['level' => 'warning', 'message' => 'Old password is incorrect!']);
        }
    }

    public function getBalance() {
        if (Auth::user()) {
            $user = Auth::user();
            $histories = History::where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->get();
        }
        return view('new.balance', compact('histories'));
    }

    public function getKeys() {
        if (Auth::user()) {
            $user = Auth::user();
            $keys = Key::where('keys.user_id', $user->id)
                ->join('histories', 'keys.history_id', '=', 'histories.id')
                ->join('tools', 'keys.tool_id', '=', 'tools.id')
                ->join('games', 'tools.game_id', '=', 'games.id')
                ->select("keys.*", "histories.created_at AS history_created_at", "tools.name AS tool_name", "games.name AS game_name")
                ->orderBy('history_created_at', 'desc')->get();
        }
        return view('new.keys', compact('keys'));
    }
}

