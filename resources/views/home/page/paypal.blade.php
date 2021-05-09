@extends('layouts.app_no_header')
@section('title')
    RECHARGE VIA PAYPAL
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <div class="card">
                    <div class="card-header">{{ __('RECHARGE VIA PAYPAL') }}</div>
                    <div class="card-body" style="position: relative">
                        <input class="form-control required" placeholder="Enter amount you want to charge" id="amount">
                        <br>
                        <div id="paypal-button-container"></div>
                        <h2 class="rounded bg-dark text-primary font-weight-bold mt-3" id="processing"
                            style="display: none">
                            PLEASE WAIT, DO NOT EXIT PAGE...</h2>
                        <h2 class="rounded bg-dark text-primary font-weight-bold mt-3" id="required_message"
                            style="display: none">
                            PLEASE ENTER AMOUNT TO RECHARGE</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@section('js')
    <script src="https://www.paypal.com/sdk/js?client-id=AbVrx-B0SWvZevjvUMuvTpMfUrks4jvPTBNW-bmEWVJS4ACTvoqwTrxABqcq8YWGe5PxUZhDTdhbnRT5&locale=en_US">
    </script>
    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: $("#amount").val()
                        }
                    }]
                });
            },
            onInit: function (data, actions) {
                // document.getElementsByClassName("paypal-button-text")[1].style["color"] = "white";
                actions.disable();
                document.querySelector('#amount')
                    .addEventListener('change', function (event) {
                        if ($("#amount").val() > 0) {
                            actions.enable();
                        }
                    });
            },
            onClick: function () {
                if ($("#amount").val() > 0) {
                    $("#required_message").hide();
                } else {
                    $("#required_message").show();
                }
            },
            onCancel: function () {
                // $('#processing').hide();
            },
            onError: function () {
                // $('#paypal-button-container').show();
                // $('#processing').hide();
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    $('#paypal-button-container').hide();
                    $('#processing').show();
                    window.location.href = "https://cheatsharp.com/check_order_paypal/" + data.orderID;
                });
            },
            style: {
                layout: 'horizontal'
            },
            locale: 'en_US'
        }).render('#paypal-button-container');
    </script>
@endsection
@endsection
