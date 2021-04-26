@extends('layouts.app_no_header')
@section('title')
    {{trans('page.require_transfer')}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <div class="card">
                    <div class="card-header col-sm-offset-2">  {{trans('page.require_transfer')}}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="userID"
                                   class="col-sm-3 col-form-label text-sm-right">  {{trans('page.recipient_id')}}</label>
                            <div class="col-sm-8">
                                <input id="userID" type="number"
                                       class="form-control{{ $errors->has('userID') ? ' is-invalid' : '' }}"
                                       name="userID" value="{{ old('userID') }}" required>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="amount"
                                   class="col-sm-3 col-form-label text-sm-right">  {{trans('page.amount')}}</label>
                            <div class="col-sm-8">
                                <input id="amount" type="number"
                                       class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                       name="amount" value="{{ old('amount') }}" min="1000" required>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-8 col-sm-offset-3">
                                <div id="charge-form-notice" style="text-align: left"></div>
                            </div>

                            <div class="col-sm-8 col-sm-offset-3">
                                <a href="javascript:void(0)"
                                   class="btn btn-primary col-md-12 send-now">  {{trans('page.transfer_money_now')}}</a>

                            </div>
                        </div>

<!--
                        <div class="form-group row">
                            <label for="amount"
                                   class="col-sm-3 col-form-label text-sm-right"><h4><b
                                            style="color:orangered;">{{trans('page.warning')}}:</b></h4></label>
                            <div class="col-sm-8">
                                <p style="text-align: left">
                                    {{trans('page.tm_row1')}} <br>
                                    <strong>{{trans('page.tm_row2')}} </strong> <br>
                                    - {{trans('page.tm_row3')}} <br>
                                    - {{trans('page.tm_row4')}} <br>
                                    - {{trans('page.tm_row5')}}
                                </p>
                            </div>

                        </div>
-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.send-now').click(function (e) {
            e.preventDefault();
            var url = `{{route('transfer.money')}}`;
            var userID = $('#userID').val();
            var amount = $('#amount').val();
            if (userID === "" || amount === "") {
                $('#charge-form-notice').html('Please input all required informations');
                return false;
            } else {
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {userID: userID, amount: amount},
                    success: function (response) {

                        if (response.status == "success") {
                            Swal({
                                title: 'Transfer successfully',
                                text: "View history",
                                type: 'success'
                            }).then(function () {
                                window.location = response.redirect;
                            });
                        } else if (response.errors !== null || response.errors != undefined || response.errors != '') {
                            $('#charge-form-notice').html(response.errors);
                            $('#charge-form-notice').html(response.message);
                        } else {
                            Swal({
                                title: 'Cannot send money',
                                text: response.message,
                                type: 'error'
                            })
                        }
                    }
                })
            }
        })
    </script>
@stop