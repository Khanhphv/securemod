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
use Illuminate\Support\Facades\Auth;

// Guest router
Route::group(['middleware' => ['locale', 'web']], function () {
    Auth::routes();
    Route::get('/', 'HomeController@landing');
    Route::get('/blog', 'BlogController@index');
    Route::get('/post', 'PostController@index')->name('post');
    Route::get('/post/{slug}', 'PostController@show')->name('post-content');
//    Route::put('/user/{user_id}/post/{id}', 'PostController@like_post')->name('like');
    Route::post('like','PostController@like_post');
    Route::get('/blog_game/{game_id}', 'BlogController@blogOfGame')->name('blog_game');
    Route::get('/recharge', 'HomeController@recharge');
    Route::get('/terms-of-services', 'PostController@terms_of_services')->name('terms_of_services');
//    Route::get('/membership-plan', 'BlogController@blog');
    Route::post('customer_register', 'Auth\RegisterController@checkexist')->name('custom_reg');
    Route::post('customer_login', 'Auth\LoginController@customerLogin')->name('custom_auth');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('home', 'HomeController@homePage')->name('home');

    Route::put('account/subscribe','HomeController@updateSubscribe')->name('subscribe');
    Route::get('account/unsubscribe', 'HomeController@unsubscribe');

    Route::get('create-transaction-coinpayments', 'CoinPaymentsController@CreateTransaction');
    Route::get('get-transactions-coinpayments', 'CoinPaymentsController@GetListTransactions');
    Route::get('check-transactions-coinpayments', 'CoinPaymentsController@CheckListTransactions');
    Route::get('cron2', 'CoinPaymentsController@CheckListTransactions')->name('cronJob');

    Route::post('charge-via-lexholding', "ChargeController@chargeViaLexHolding");
    //Stripe
    Route::get('stripe-payment', 'CheckoutController@index');
    Route::get('stripe-payment-confirm', 'CheckoutController@checkoutWithStripe');

    Route::get('game/{slug}', 'Admin\GameController@show');
    Route::get('buy-tool/{toolId}/{package}', 'HomeController@buyTool')->name('tool.buy-tool');
    Route::post('buy-tool-from-cart/', 'HomeController@buyToolFromCart')->name('tool.buy-tool-cart');

    //-------------------API-------------------------
    Route::get('/getCountry', 'CountryStateController@getCountry');
    Route::get('/getState', 'CountryStateController@getState');

    Route::get('login_via_facebook', 'Auth\LoginController@redirectToProviderFB')->name('login_via_fb');
    Route::get('login_via_facebook/callback', 'Auth\LoginController@handleProviderCallbackFB')->name('callback_from_fb');
    Route::get('login_via_google', 'Auth\LoginController@redirectToProviderGG')->name('login_via_gg');
    Route::get('login_via_google/callback', 'Auth\LoginController@handleProviderCallbackGG')->name('callback_from_gg');
    Route::get('login_via_discord', 'Auth\LoginController@redirectToProviderDiscord')->name('login_via_discord');
    Route::get('login_via_discord/callback', 'Auth\LoginController@handleProviderCallbackDiscord')->name('callback_from_discord');
});

// Auth router
Route::group(['middleware' => ['locale', 'auth']], function () {
    Route::get('balance', 'HomeController@getBalance')->name('balance');
    Route::get('keys', 'HomeController@getKeys')->name('keys');
    Route::get('tools', 'ToolController@index')->name('tools');
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
    Route::get('paypal/{transaction_id?}', 'AdminController@getPaypalTransaction');
    Route::get('/setting_system', 'SystemSettingController@index')->name('setting_system');
    Route::put('/setting_system/edit', 'SystemSettingController@ChangeLogoSystem')->name('setting_system_edit');
    Route::put('/setting_system/edit_head', 'SystemSettingController@edit_head')->name('edit_head');
    Route::get('/payment', 'PaymentSettingController@index')->name('payment_settings');
    Route::put('/payment/edit', 'PaymentSettingController@change_key')->name('change_payment');
    Route::put('/paypal_seller/edit', 'PaypalSellerController@update')->name('paypal_seller.update');
    Route::get('paypal_seller/delete/{id}', 'PaypalSellerController@destroy')->name('paypal_seller.destroy');
    Route::post('/paypal_seller', 'PaypalSellerController@store')->name('paypal_seller.create');
    Route::get('/summary', 'SummaryController@getMoneySummary')->name('summary');
    Route::get('/', 'AdminController@statics')->name('admin.index');
    Route::resource('tool', 'ToolController');
    Route::get('tool/delete/{id}', 'ToolController@destroy')->name('tool.delete');
    Route::get('key/delete/{id}', 'KeyController@destroy')->name('key.delete');
    Route::resource('key', 'KeyController');
//    Route::resource('blog', 'BlogController');
    Route::resource('post', 'PostController');
//    Route::get('blog/delete/{id}', 'BlogController@destroy')->name('blog.delete');
    Route::get('post/delete/{id}', 'PostController@destroy')->name('post.delete');

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

    Route::get('add-blacklist', 'AdminController@addBlackList')->name('add-blacklist');
});

Route::get('accept-payment/{history_id?}', 'CheckoutController@acceptPayment')->name('accept-payment');

//--------------------------Test route cho blog mới---------------------------
 Route::group(['middleware' => ['locale', 'web']], function () {
    Route::get('/{url}', 'BlogController@showBlog')->name('blog-game-title');
 });

