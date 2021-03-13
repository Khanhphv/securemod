<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//---------------------CLIENT-----------------------
use App\Key;
use App\Model\Game;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\History;
use App\User;


Route::group(['middleware' => ['locale', 'web']], function () {
    Auth::routes();
    Route::get('/', 'HomeController@landing');
    Route::get('/blog', 'BlogController@index');
    Route::get('/blog_game/{game_id}', 'BlogController@blogOfGame')->name('blog_game');
    Route::get('/terms-of-services', 'BlogController@show')->name('blog');
//    Route::get('/membership-plan', 'BlogController@blog');
    Route::post('customer_login', function (Request $data) {
        $check_exist = DB::table('users')->where('email', $data['email'])->first();
        if ($check_exist) {
            return app()->call('App\Http\Controllers\Auth\LoginController@login');
        } else {
            return app()->call('App\Http\Controllers\Auth\RegisterController@register');
        }
    })->name('custom_auth');
    Route::get('logout', function () {
        Auth::logout();
        return redirect()->back();
    });
    Route::get('home', 'HomeController@homePage')->name('home');
    Route::get('balance', function () {
        if (Auth::user()) {
            $user = Auth::user();
            $histories = History::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        }
        return view('new.balance', compact('histories'));
    })->name('balance');

    Route::get('keys', function () {
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
    })->name('keys');
    Route::put('account/subscribe','HomeController@updateSubscribe')->name('subscribe');
    Route::get('account/unsubscribe', 'HomeController@unsubscribe');

    Route::get('create-transaction-coinpayments', 'CoinPaymentsController@CreateTransaction');
    Route::get('get-transactions-coinpayments', 'CoinPaymentsController@GetListTransactions');
    Route::get('check-transactions-coinpayments', 'CoinPaymentsController@CheckListTransactions');
    Route::get('cron2', 'CoinPaymentsController@CheckListTransactions');

    //Stripe
    Route::get('stripe-payment', 'CheckoutController@index');
    Route::get('stripe-payment-confirm', 'CheckoutController@checkoutWithStripe');

    Route::get('game/{slug}', 'Admin\GameController@show');
    Route::get('buy-tool/{toolId}/{package}', 'HomeController@buyTool')->name('tool.buy-tool');


    Route::get('login_via_facebook', 'Auth\LoginController@redirectToProviderFB')->name('login_via_fb');
    Route::get('login_via_facebook/callback', 'Auth\LoginController@handleProviderCallbackFB')->name('callback_from_fb');
    Route::get('login_via_google', 'Auth\LoginController@redirectToProviderGG')->name('login_via_gg');
    Route::get('login_via_google/callback', 'Auth\LoginController@handleProviderCallbackGG')->name('callback_from_gg');
    Route::get('login_via_discord', 'Auth\LoginController@redirectToProviderDiscord')->name('login_via_discord');
    Route::get('login_via_discord/callback', 'Auth\LoginController@handleProviderCallbackDiscord')->name('callback_from_discord');
});

Route::get('check_order_paypal/{order_id_paypal}', 'PayPalController@CheckOrder');
Route::get('/payment', 'HomeController@payment');
Route::get('test', 'PayPalController@checkTransaction');
//-------------------Support-------------------------
Route::group(['middleware' => 'can_access'], function () {
    Route::get('support', 'Admin\AdminController@support');
    Route::group(['prefix' => 'user'], function (){
        Route::get('', 'Admin\UserController@index')->name('user');
        Route::get('/edit/{userId}', 'Admin\UserController@edit')->name('user.edit');
        Route::post('/update/{userId}', 'Admin\UserController@update')->name('user.update');
        Route::post('/search', 'Admin\UserController@search')->name('user.search');
        Route::get('/search/{phone}', 'Admin\UserController@resultSearch')->name('user.resultSearch');
    });
});

//-----------------------ADMIN-----------------------
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'is_admin'], function () {
    Route::get('paypal/{transaction_id?}', function ($transaction_id) {
        $check = History::where('nl_token', $transaction_id)->first();
        if ($check) {
            echo 'User: ' . $check->user_id . ' - Số tiền: ' . $check->amount . ' - Nội dung: ' . $check->content . ' - Thời gian ' . $check->updated_at.'<br>';
            echo '<a href="https://securecheat.xyz/admin/user/edit/'.$check->user_id.'">Xem toàn bộ giao dịch</a>';
        }
    });
    Route::get('/summary', 'SummaryController@getMoneySummary')->name('summary');
    Route::get('/', 'AdminController@statics')->name('admin.index');
    Route::resource('tool', 'ToolController');
    Route::get('tool/delete/{id}', 'ToolController@destroy')->name('tool.delete');
    Route::resource('key', 'KeyController');
    Route::resource('blog', 'BlogController');
    Route::get('blog/delete/{id}', 'BlogController@destroy')->name('blog.delete');

    Route::get('filter', 'KeyController@searchVc')->name('key.search');
    Route::post('/check-key', 'KeyController@postCheckKey')->name('key.postCheckKey');
    Route::get('/setting', 'OptionController@index')->name('setting.index');
    Route::post('/setting/update', 'OptionController@update')->name('setting.update');

    Route::resource('game', 'GameController');

    /**
     * API for summary admin
     *
     */
    Route::group(['prefix' => '/internalapi'], function (){
        Route::get('/topkey','SummaryController@getKeySummary');
        Route::get('/summarykey', 'SummaryController@summaryWithEachKey');
        Route::get('/solvedKey', 'SummaryController@getSoldKey');
    });

});

Route::get('add-blacklist', function (Request $request) {
    if (isset($request->email) && Auth::check() && Auth::user()->type == 'admin') {
        $blackuser = new \App\Blacklist();
        $blackuser->email = $request->email;
        $blackuser->save();
        return redirect()->back();
    }
})->name('add-blacklist');

Route::get('accept-payment/{history_id?}', function ($history_id) {
    if (Auth::user()->type == 'support' || Auth::user()->type == 'admin') {
        $history = History::where('id', $history_id)->where('need_to_verify', true)->first();
        if ($history && $history->need_to_verify == true /*&& $history->paypal_transaction_status == "Completed"*/) {
            $user_id = $history->user_id;
            $amount = $history->amount;
            $history->need_to_verify = false;
            $bonus = 0; //mac dinh
            switch ((int)$amount){
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
            $user = User::where('id', $user_id)->first();
            $old_money_user = $user->credit;
            $user->credit = $user->credit + $amount + ($amount * $bonus /100);
            $user->total_paypal_credit += $amount;

            $support = Auth::user()->id;

            $accept_history = new History();
            $accept_history->action = 'ACCEPTED_PAYMENT';
            $accept_history->user_id = $user->id;
            $accept_history->amount = 0;
            $accept_history->content = "Staff " . $support . " accepted your transaction. Your balance from " . number_format($old_money_user) . " to " . number_format($user->credit);
            $accept_history->revenue = 0;
            $accept_history->nl_token = null;

            $history->save();
            $accept_history->save();
            $user->save();

            return redirect()->back();
        }
    } else {
      exit("Invalid request");
  }
})->name('accept-payment');

//--------------------------Test route cho blog mới---------------------------
 Route::group(['middleware' => ['locale', 'web']], function () {
    Route::get('/{url}', 'BlogController@showBlog')->name('blog-game-title');
 });

