<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', 'Keys')
    <meta charset="UTF-8">
    <meta name="description" content="keys history">
    <meta name="keywords" content="history, balance, invoice">
    <meta name="author" content="support@divinesofts.net">
    @include('new.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
    @extends('new.master-layout')
    @section('content')
        <div class="tab-content mobile" style="display: block">
            <div class="row">
                <div class="col s12 m12">
                    <div >
                    <h2>Payment</h2>
                    {{dd($paypal)}}
                    @auth
                        @if(isset($paypal) && $paypal->value != 0)
                        <div class="space-height-20px"></div>
                        <div style="display: flex; align-items: center;">
                            <a onclick="createPayment()" class="waves-effect waves-light btn-large"
                                style="background: white; width: 150px;">
                                <img   style="width: 120%;height: 100%; left: -8px"
                                        src="https://www.paypalobjects.com/checkoutweb/release/hermione/media/logo.7e5b43e3.svg"
                                        alt="paypal-payment">
                            </a>
                        </div>
                        @endif
                        @if(isset($coin) && $coin->value != 0)
                        <div class="space-height-20px"></div>
                        <div style="display: flex; align-items: center;">
                            <a class="waves-effect waves-light btn-large modal-trigger" href="#coin-popup"
                                style="background: white; width: 150px;">
                                <img style="width: 135%; left: -14px; top: 3px" src="{{ asset('img/coinpayment.png') }}" alt="coin-payment">
                            </a>
                        </div>
                        @endif
                        @if(isset($seller) && $seller->value != 0)
                        <div class="space-height-20px"></div>
                        <div style="display: flex; align-items: center;">
                            <a target="blank" class="waves-effect waves-light btn-large modal-trigger" href="#seller-payment"
                                style="background: white; width: 150px;">
                                <img style="height: -webkit-fill-available; width: 100%" src="{{ asset('img/SellerPaypal.svg')}}" alt="seller-payment">
                            </a>
                        </div>
                        @endif
                        @if(\App\Option::where('option', 'stripe_payment')->get()->first()->value != 0)
                        <div class="space-height-20px"></div>
                        <div style="display: flex; align-items: center;">
                            <a target="blank" class="waves-effect waves-light btn-large modal-trigger" href="#stripe-popup"
                                style="background: white; width: 150px;">
                                <img style="height: -webkit-fill-available" src="{{ asset('img/stripe.png')}}" alt="stripe-popup">
                            </a>
                        </div>

                        @endif
                        @if(isset($stripe) && $stripe->value != 0)
                        <div class="space-height-20px"></div>
                        <div style="display: flex; align-items: center;">
                            <a target="blank" class="waves-effect waves-light btn-large modal-trigger" href="#lexholding-popup"
                                style="background: white; width: 150px;">
                                <strong style="font-weight: 700; color: #039be5">Visa/Master</strong>
                            </a>
                        </div>
                        @endif


                    @endauth

                </div>
                </div>
            </div>
        </div>
    @endsection
</body>
</html>


