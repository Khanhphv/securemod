<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaypalSeller;
use App\Payment;

class PaymentSettingController extends Controller
{
    // get site settings info
    public function index()
    {
        $arr_payment_type = Payment::all()->pluck('payment_type', 'id');
        $sellers = PaypalSeller::all();
        return view('admin.payment', compact('arr_payment_type', 'sellers'));
    }

    public function change_key(Request $request){
        $payment = Payment::find($request->payment);
        $payment->client_id = $request->public_key ? $request->public_key : "LEX_HOLDING_KEY";
        $payment->client_secret = $request->secret_key;
        $payment->save();
        return redirect()->route('payment_settings')->with(['msg' => 'Update payment key successful']);
    }
}
