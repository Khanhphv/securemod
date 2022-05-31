<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', 'Payment Method')
    <meta charset="UTF-8">
    <meta name="description" content="Browse the Zcheats, click “Buy Now” and make the payment using your favorite payment method.">
    <meta name="keywords" content="payment, payment method">
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

                    @php
                        $paypal = \App\Option::where('option', 'paypal_payment')->get()->first();
                        $coin = \App\Option::where('option', 'coin_payment')->get()->first();
                        $seller = \App\Option::where('option', 'seller_payment')->get()->first();
                        $stripe = \App\Option::where('option', 'stripe_payment')->get()->first();
                    @endphp
                    @guest()
                        @if(isset($paypal) && $paypal->value != 0)
                        <div class="card-credit">
                            <a onclick='window.location.href = "/login";'>
                                <img src="https://www.paypalobjects.com/checkoutweb/release/hermione/media/logo.7e5b43e3.svg"
                                        alt="paypal-payment">
                            </a>
                        </div>
                        @endif
                        @if(isset($coin) && $coin->value != 0)
                        <div class="card-credit">
                            <a data-bs-toggle="offcanvas" role="button" aria-controls="coin-popup" onclick='window.location.href = "/login";'>
                                <img src="{{ asset('img/coinpayment.png') }}" alt="coin-payment">
                            </a>
                        </div>
                        @endif
                        @if(isset($seller) && $seller->value != 0)
                        <div class="card-credit">
                            <a data-bs-toggle="offcanvas" onclick='window.location.href = "/login";' role="button" aria-controls="seller-payment" >
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
                        @if(isset($stripe) && $stripe->value != 0)
                        <div class="card-credit">
                            <a target="blank" onclick='window.location.href = "/login";'>
                                <h1 style="font-weight: 700; color: #039be5">Visa/Master</h1>
                            </a>
                        </div>
                        @endif
                    @endguest
                    @auth()
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
                        @if(isset($stripe) && $stripe->value != 0)
                        <div class="card-credit">
                            <a target="blank" href="#lexholding-popup">
                                <h1 style="font-weight: 700; color: #039be5">Visa/Master</h1>
                            </a>
                        </div>
                        @endif

                    @endauth


                </div>
                    <div class="card-credit">
                        @include('new.payment.extra-payment')
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>
</html>


