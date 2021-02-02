<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/check-key/{key}/{hwid?}/{toolId?}/{ipAddress?}','ApiController@checkKey');
Route::get('/who/{hwid}/{nameTool?}/{key?}','ApiController@who');
Route::get('/activation', 'ApiController@checkKeyNix');
Route::get('/activation_pak', 'ApiController@checkKeyNix');
Route::get('/activation_bear', 'ApiController@checkKeyBear');

Route::get('/check/{code}', 'Api2Controller@check');
Route::get('/loader/', 'Api2Controller@loader');
Route::get('/active-key/{toolId}', 'Api2Controller@activeKey');
Route::get('/download/{toolId}/{fileType}/{code}', 'Api2Controller@download');
Route::get('/download/{toolId}/{fileType}/{code}/{subfolder}', 'Api2Controller@download');
Route::get('/loader-version/{toolId}', 'Api2Controller@loaderVer');
Route::get('/loader-version/', 'Api2Controller@loaderVer');

Route::get('/activev3-key/{toolId}', 'Api3Controller@activeKey');
Route::get('/downloadv3/{toolId}/{fileType}/{code}', 'Api3Controller@download');
Route::get('/downloadv3/{toolId}/{fileType}/{code}/{subfolder}', 'Api3Controller@download');
Route::get('/loaderv3-version/{toolId}', 'Api3Controller@loaderVer');
Route::get('/debugv3-receive/{code}/{log_type}/{file_code}/{function_line}/{log_note}', 'Api3Controller@DebugReceive');
Route::post('/pp_transaction_log', 'Api3Controller@PaypalTransaction');


Route::post('/payment/paypal','PaypalConttoller@insertTransaction');
