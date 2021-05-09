@extends('layouts.app_no_header')
@section('title')
ĐỔI KEY DÀNH CHO ĐẠI LÝ
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-7 col-sm-offset-2 text-center">
            <div class="card">
                <div class="card-header">{{ __('CHANGE KEY FOR RESELLER') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="key"
                        class="col-sm-3 col-form-label text-center">{{ __('Enter key to change') }}</label>
                        <div class="col-sm-8">
                            <input id="key" type="text"
                            class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                            name="key" value="{{ old('key') }}"  required>
                        </div>

                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-12">
                            <div id="charge-form-notice"></div>
                        </div>

                        <div class="col-sm-8 col-sm-offset-3">
                            <a href="javascript:void(0)" class="buy-now btn btn-primary col-sm-12">CHANGE</a>

                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        // change-now

        $('.buy-now').click(function (e) {
            e.preventDefault();
            var url = `{{route('reseller.key-update')}}`;
            var key = $('#key').val();
            if (key === "" ) {
                $('#charge-form-notice').html('Vui lòng nhập đủ các thông tin yêu cầu');
                return false;
            } else {
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {key: key},
                    success: function (response) {
                        if (response.status == "success") {
                         Swal({
                            title: 'Đổi thành công',
                            text: "Xem lịch sử giao dịch" ,
                            type: 'success'
                        }).then(function () {
                            window.location = response.redirect;
                        });
                    } else {
                        Swal({
                            title: 'Không thể đổi key',
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