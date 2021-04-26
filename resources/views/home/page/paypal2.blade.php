@extends('layouts.app_no_header')
@section('title')
    RECHARGING VIA PAYPAL
@endsection
@section('content')
    {{--    <meta http-equiv="refresh" content="10">--}}
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-left">
                <div class="card">
                    <div class="card-header text-center">{{ __('RECHARGING VIA PAYPAL') }}</div>
                    <div class="card-body">
                        Please send payment to Paypal <span style="font-size: 18px"><strong style="color: yellow">subhanahmad6890@gmail.com
</strong></span><br>
                        Payment type must be <strong style="color: yellow; font-size: 18px;">Sending to a
                            friend</strong> <br>
                        And and in the note, you have to write
                        <strong style="color: yellow; font-size: 18px;" id="message" onclick="copyMessage('Thank you for supporting me in fixing software bugs yesterday, my email is {{ Auth::user()->email }}, this is my thanks to you.')">Thank you
                            for supporting me in fixing software bugs yesterday, my email
                            is {{ Auth::user()->email }},
                            this is my thanks to you.</strong>
                        {{--                        <button class="btn btn-primary">Click to copy</button>--}}
                        <br><br>
                        <span style="color: yellow; font-size: 16px">(Please write exactly the note as above, if it is even 1 character wrong, your money will be refunded)</span><br>
                        <br>Immediately after receiving the money, the system automatically adds money to your
                        account.<br>
                        Maximum time 3 minutes regardless of day and night. If you have any problem, please contact
                        Admin.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyMessage(message) {
            var textArea = document.createElement("textarea");
            textArea.value = message;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
            swal({
                'title': "Copied",
                'text': message
            });
        }
    </script>
@endsection
