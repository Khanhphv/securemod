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
        .ii a[href] {
            text-decoration : unset!important;
            color: unset!important;
        }
    </style>
</head>
<?php
$style = [
    /* Layout ------------------------------ */
    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',
    /* Masthead ----------------------- */
    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',
    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',
    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',
    /* Body ------------------------------ */
    'body_action' => 'width: 100%; margin: 15px auto; padding: 0 5%;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',
    /* Type ------------------------------ */
    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',
    /* Buttons ------------------------------ */
    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',
    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',

    'margin-tr' => 'margin: 15px 0 5px 0',
];
?>
<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
<body style="{{ $style['body'] }}">
<table width="50%" cellpadding="0" cellspacing="0" style="margin: 0 auto; padding: 20px 0">
    <tbody style="border: 1px solid #e8eaed;">
    <tr>
        <td style="{{ $style['email-wrapper'] }}" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <!-- Email Body -->
                <tr>
                    <td style="{{ $style['email-body'] }}" width="100%"><table style="{{ $style['body_action'] }}" align="center" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="display: block; width: 100%; border-bottom: 1px dotted black;">
                                    <strong style="font-size: 24px; width: 100%" align="center">Payment</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 16px">
                                    <h3>Hi, {{ $userName }}  </h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        Thanks for using your production!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <table style="background:#f3f3f3;border-collapse:collapse;border-spacing:0;margin-bottom:12px;padding:0;vertical-align:top;width:100%">
                                    <tbody>
                                    <tr style="padding:0;vertical-align:top">
                                        <th style="margin:0;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:inherit;line-height:inherit;margin:0;padding:16px 32px 0 32px">
                                            <h3 style="margin:0;margin-bottom:8px;color:#3c4043;font-family:Google Sans,Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:26px!important;margin:0;margin-bottom:12px;margin-top:none!important;padding:0;text-align:center;word-wrap:normal">
                                                Your payment
                                            </h3>
                                        </th>
                                    </tr>
                                    <tr style="padding:0;vertical-align:top">
                                        <td style="margin:0;border-collapse:collapse!important;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:inherit;margin:0;padding:0 32px 0 32px;vertical-align:top;word-wrap:keep-all">
                                            <p style="margin:0;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:20px;margin:0;margin-bottom:0;padding:0"><strong>
                                                    Pakage:&nbsp;
                                                </strong></p>

                                            <p style="margin:0;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:20px;margin:0;margin-bottom:16px;padding:0"><a style="margin:0;color:#1f1f1f;font-family:inherit;font-weight:inherit;margin:0;padding:0;text-decoration:none">
                                                    {{ $package }}
                                                </a></p>
                                        </td>
                                    </tr>
                                    <tr style="padding:0;vertical-align:top">
                                        <td style="margin:0;border-collapse:collapse!important;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:inherit;margin:0;padding:0 32px 0 32px;vertical-align:top;word-wrap:keep-all">
                                            <p style="margin:0;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:20px;margin:0;margin-bottom:0;padding:0"><strong>
                                                    Key:&nbsp;
                                                </strong></p>

                                            <p style="margin:0;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:20px;margin:0;margin-bottom:16px;padding:0"><a style="margin:0;color:#1f1f1f;font-family:inherit;font-weight:inherit;margin:0;padding:0;text-decoration:none">
                                                    {{ $key }}
                                                </a></p>
                                        </td>
                                    </tr>
                                    <tr style="padding:0;vertical-align:top">
                                        <td style="margin:0;border-collapse:collapse!important;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:inherit;margin:0;padding:0 32px 0 32px;vertical-align:top;word-wrap:keep-all">
                                            <table style="margin:9px 0 24px 0;border:none;border-collapse:collapse;border-radius:3px;border-spacing:0;display:inline-block;line-height:0;margin:9px 0 24px 0;max-width:100%;padding:0;vertical-align:top;width:auto">
                                                <tbody>
                                                <tr style="padding:0;vertical-align:top">
                                                    <td style="margin:0;border-collapse:collapse!important;color:#3c4043;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:inherit;margin:0;padding:0;vertical-align:top;word-wrap:keep-all">
                                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;vertical-align:top;width:100%">
                                                            <tbody>
                                                            <tr style="padding:0;vertical-align:top">
                                                                <td style="margin:0;background:#2979ff;border:none;border-collapse:collapse!important;border-radius:3px;color:#fff;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:inherit;margin:0;padding:0;vertical-align:top;word-wrap:keep-all">
                                                                    <a href="https://securecheat.xyz/" style="margin:0;border:0 solid #2979ff;border-radius:3px;color:#fff;display:inline-block;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:500;line-height:24px;margin:0;padding:8px 16px 8px 16px;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://support.google.com/a/answer/1047213?utm_source%3D9052702%26utm_medium%3Demail&amp;source=gmail&amp;ust=1600103055664000&amp;usg=AFQjCNHeuPGHMJlFM21ekuezc6297ah3uA">
                                                                        Contact us
                                                                    </a></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </tr>
                        </table></td>
                </tr>
                <!-- Footer -->
                {{--                <tr>--}}
                {{--                    <td><table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0" cellspacing="0">--}}
                {{--                            <tr>--}}
                {{--                                <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}"><p style="{{ $style['paragraph-sub'] }}"> &copy; {{ date('Y') }} <a style="{{ $style['anchor'] }}" href="{{ url('/') }}" target="_blank">Khanh</a>.--}}
                {{--                                        All rights reserved. </p></td>--}}
                {{--                            </tr>--}}
                {{--                        </table></td>--}}
                {{--                </tr>--}}
            </table></td>
    </tr>


    </tbody>

</table>
</body>
</html>
