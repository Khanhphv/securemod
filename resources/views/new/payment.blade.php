<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato');

        body, html{
            height: 100%;
            background: #222222;
            font-family: 'Lato', sans-serif;
        }

        .container{
            display: block;
            position: relative;
            margin: 40px auto;
            height: auto;
            width: 500px;
            padding: 20px;
        }

        h2 {
            color: #AAAAAA;
        }

        .container ul{
            list-style: none;
            margin: 0;
            padding: 0;
            overflow: auto;
        }

        ul li{
            color: #AAAAAA;
            display: block;
            position: relative;
            float: left;
            width: 100%;
            height: 100px;
            border-bottom: 1px solid #333;
        }

        ul li input[type=radio]{
            position: absolute;
            visibility: hidden;
        }

        ul li label{
            display: block;
            position: relative;
            font-weight: 300;
            font-size: 1.35em;
            padding: 25px 25px 25px 80px;
            margin: 10px auto;
            height: 30px;
            z-index: 9;
            cursor: pointer;
            -webkit-transition: all 0.25s linear;
        }

        ul li:hover label{
            color: #FFFFFF;
        }

        ul li .check{
            display: block;
            position: absolute;
            border: 5px solid #AAAAAA;
            border-radius: 100%;
            height: 25px;
            width: 25px;
            top: 30px;
            left: 20px;
            z-index: 5;
            transition: border .25s linear;
            -webkit-transition: border .25s linear;
        }

        ul li:hover .check {
            border: 5px solid #FFFFFF;
        }

        ul li .check::before {
            display: block;
            position: absolute;
            content: '';
            border-radius: 100%;
            height: 15px;
            width: 15px;
            top: 5px;
            left: 5px;
            margin: auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
        }

        input[type=radio]:checked ~ .check {
            border: 5px solid #0DFF92;
        }

        input[type=radio]:checked ~ .check::before{
            background: #0DFF92;
        }

        input[type=radio]:checked ~ label{
            color: #0DFF92;
        }

        .signature {
            margin: 10px auto;
            padding: 10px 0;
            width: 100%;
        }

        .signature p{
            text-align: center;
            font-family: Helvetica, Arial, Sans-Serif;
            font-size: 0.85em;
            color: #AAAAAA;
        }

        .signature .much-heart{
            display: inline-block;
            position: relative;
            margin: 0 4px;
            height: 10px;
            width: 10px;
            background: #AC1D3F;
            border-radius: 4px;
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .signature .much-heart::before,
        .signature .much-heart::after {
            display: block;
            content: '';
            position: absolute;
            margin: auto;
            height: 10px;
            width: 10px;
            border-radius: 5px;
            background: #AC1D3F;
            top: -4px;
        }

        .signature .much-heart::after {
            bottom: 0;
            top: auto;
            left: -4px;
        }

        .signature a {
            color: #AAAAAA;
            text-decoration: none;
            font-weight: bold;
        }


        /* Styles for alert...
        by the way it is so weird when you look at your code a couple of years after you wrote it XD */

        .alert {
            box-sizing: border-box;
            background-color: #BDFFE1;
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            z-index: 300;
            padding: 20px 40px;
            color: #333;
        }

        .alert h2 {
            font-size: 22px;
            color: #232323;
            margin-top: 0;
        }

        .alert p {
            line-height: 1.6em;
            font-size:18px;
        }

        .alert a {
            color: #232323;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">

    <h2>Please choose package:</h2>

    <ul>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="5" type="radio" id="5">
            <label for="5">$5</label>
            <div class="check"></div>
        </li>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="10" type="radio" id="10">
            <label for="10">$10</label>

            <div class="check"><div class="inside"></div></div>
        </li>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="20" type="radio" id="20">
            <label for="20">$20</label>
            <div class="check"><div class="inside"></div></div>
        </li>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="50" type="radio" id="50">
            <label for="50">$50</label>
            <div class="check"><div class="inside"></div></div>
        </li>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="100" type="radio" id="100">
            <label for="100">$100</label>
            <div class="check"><div class="inside"></div></div>
        </li>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="200" type="radio" id="200">
            <label for="200">$200</label>
            <div class="check"><div class="inside"></div></div>
        </li>
        <li>
            <input name="paypal_amount" class="paypal_amount" type="radio" value="500" type="radio" id="500">
            <label for="500">$500</label>
            <div class="check"><div class="inside"></div></div>
        </li>
    </ul>
</div>
<button type="button" id="buttonSave">OK</button>

<div id="paypal-button-container"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo App\Option::where('option', 'paypal_id')->join('paypal', 'paypal.id', 'options.value')->get()->first()->client_id ?>&locale=en_US">
</script>
<script !src="">
    let priceArray = [5,10,20,50,100,200,500];
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: $("input[name='paypal_amount']:checked").val()
                    }
                }]
            });
        },
        onInit: function (data, actions) {
            // document.getElementsByClassName("paypal-button-text")[1].style["color"] = "white";
            document.querySelector('.paypal_amount')
                .addEventListener('change', function (event) {
                    if ($("input[name='paypal_amount']:checked").val() > 0) {
                        actions.enable();
                    }
                });
        },
        onClick: function () {
            let price = Number($("input[name='paypal_amount']:checked").val());
            if (price > 0 && priceArray.includes(price)) {
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
                window.opener.location.href = "/check_order_paypal/" + data.orderID;
                window.close()
            });
        },
        style: {
            layout: 'horizontal'
        },
        locale: 'en_US'
    }).render('#paypal-button-container');
    $('#buttonSave').click(()=>{
        window.location.href = "/check_order_paypal/" + '3123123';
        window.close()
    })
</script>
</body>
</html>
