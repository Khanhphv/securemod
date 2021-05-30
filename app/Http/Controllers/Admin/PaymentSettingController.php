<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    // get site settings info
    public function index()
    {
        return view('admin.payment');
    }
}
