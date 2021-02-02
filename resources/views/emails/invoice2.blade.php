<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
        @media only screen and (max-width: 500px) {
            table {
                width: 100% !important;
            }
        }
        @media (prefers-color-scheme: dark ) {
            .payment-table td, .payment-table th {
                padding: 10px;
                border: 1px solid white;
                border-spacing: 0px;
            }
        }
        .ii a[href] {
            text-decoration : unset!important;
            color: unset!important;
        }
        .payment-table {
            border-collapse: collapse;
        }
        .payment-table td, .payment-table th {
            padding: 10px;
            border: 1px solid;
            border-spacing: 0px;
        }
    </style>
</head>
<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
<body style="background: #f2f2f2; font-size: 1em;  {{ $fontFamily }}">
<table style="margin: 0 auto; padding: 30px 0">
    <tr style="max-width: 820px; width: 100%; background: white;display: block; margin: auto;">
        <td>
            <div style="padding: 20px 0 20px; background: black; text-align: center">
                <section>
                    <div>
                        <a href="https://securecheat.xyz/">
                            <img style="margin: 0 auto; display: block; width: 50%; min-width: 320px;" src="https://securecheat.xyz/images/logo_landing.png" alt="">
                        </a>
                    </div>
                    <div style="color: white">
                        <h2 style="font-size: 2em;">Hi, {{ $userName }}!</h2>
                        <h2 style="font-size: 1.3em;margin-top: 0">Your order on SecureCheats is</h2>
                        <h1 style="font-size: 2.5em; margin-top: 0">Complete</h1>
                    </div>
                </section>
            </div>
            <div style="margin: 0 auto; padding: 0 3% 3%; background: white">
                <h2>Order #{{ now()->format('Ymdihs') }}</h2>
                <table class="payment-table" style="width: 100%">
                    <tr>
                        <td>
                            <strong>Product</strong>
                        </td>
                        <td>
                            Quanlity
                        </td>
                        <td>
                            Price
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <img src="{{ $game->logo }}" alt="" width="80%">
                            <p>{{ $game->name }}</p>
                        </td>
                        <td width="30%">
                            1
                        </td>
                        <td width="30%">
                            ${{ $price }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Your order on SecureCheats is complete and you will find key and package information below.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Subtotal:</strong>
                        </td>
                        <td>${{ $price }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Total:</strong>
                        </td>
                        <td>${{ $price }}</td>
                    </tr>
                </table>
                <h3>Key Details</h3>
                <table class="payment-table" style="width: 100%">
                    <tr>
                        <td>
                            <strong>Pakage</strong>
                        </td>
                        <td>
                            <strong>Key</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $key->package }}
                        </td>
                        <td>
                            {{ $key->key }}
                        </td>
                    </tr>
                </table>
                <h3>Terms of Services General</h3>
                <div>
                    Securecheats, at its sole discretion, reserves any rights to deny or grant a refund
                    for a fee paid to Securecheats for a service or product offered by Securecheats,
                    A refund is typically granted when an incompatibility is identified that can not be solved.
                    However, it is the user's responsibility to read and review any requirements that our software
                    requires to run smoothly and verify that their system is compatible with our software.
                </div>
                <a href="https://securecheat.xyz/terms-of-services">More about our TOS and Policie</a>
            </div>
        </td>
    </tr>
</table>

</body>
</html>
