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
    <style>
        .card-credit {
            display: flex;
            height: 100px;
            align-items: center;
            padding: 20px;
            margin-top: 20px
        }
        .card-credit:hover {
          box-shadow: 0 10px 100px #00000021;
          border: 1px solid
        }
        .card-credit img {
            height: 70px;
        }
    </style>
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
    @extends('new.master-layout')
    @section('content')
        <div class="tab-content mobile" style="display: block">
            <div class="row">
                <h2>Payment</h2>
                <div class="col s12 m12">
                    <div>
                    @auth
                    @php
                        $paypal = \App\Option::where('option', 'paypal_payment')->get()->first();
                        $coin = \App\Option::where('option', 'coin_payment')->get()->first();
                        $seller = \App\Option::where('option', 'seller_payment')->get()->first();
                        $stripe = \App\Option::where('option', 'stripe_payment')->get()->first();
                        $btcpay = \App\Option::where('option', 'btcpay_payment')->get()->first();
                    @endphp
                        @if(isset($paypal) && $paypal->value != 0)
                        <div class="card-credit">
                            <a onclick="createPayment()">
                                <img src="https://www.paypalobjects.com/checkoutweb/release/hermione/media/logo.7e5b43e3.svg"
                                        alt="paypal-payment">
                            </a>
                        </div>
                        @endif
                        @if(isset($coin) && $coin->value != 0)
                        <div class="card-credit">
                            <a data-bs-toggle="offcanvas" role="button" aria-controls="coin-popup" href="#coin-popup">
                                <img src="{{ asset('img/coinpayment.png') }}" alt="coin-payment">
                            </a>
                        </div>
                        @endif
                        @if(isset($seller) && $seller->value != 0)
                        <div class="card-credit">
                            <a data-bs-toggle="offcanvas" href="#seller-payment" role="button" aria-controls="seller-payment" >
                                <img src="{{ asset('img/SellerPaypal.svg')}}" alt="seller-payment">
                            </a>
                        </div>
                        @endif
                        {{-- @if(\App\Option::where('option', 'stripe_payment')->get()->first()->value != 0)
                        <div class="card-credit">
                            <a target="blank">
                                <img  src="{{ asset('img/stripe.png')}}" alt="stripe-popup">
                            </a>
                        </div>

                        @endif --}}

                        @if(\App\Option::where('option', 'btcpay_payment')->get()->first()->value != 0)
                        <div class="card-credit">
                            <a data-bs-toggle="offcanvas" role="button" aria-controls="btcpay-popup" href="#btcpay-popup">
                                <h1 style="font-weight: 700; color: #039be5">BTCPay</h1>
                            </a>
                        </div>
                        @endif

                        @if(isset($stripe) && $stripe->value != 0)
                        <div class="card-credit">
                            <a target="blank" href="#lexholding-popup">
                                <h1 style="font-weight: 700; color: #039be5">Visa/Master</h1>
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


