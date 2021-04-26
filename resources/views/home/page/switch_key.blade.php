@extends('layouts.app_no_header')
@section('title')
    ĐỔI LOẠI TOOL
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <div class="card">
                <div class="card-header">{{ __('ĐỔI LOẠI TOOL') }}</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="key2"
                        class="col-sm-3 col-form-label text-sm-right">{{ __('Nhập key') }}</label>
                        <div class="col-sm-8">
                        <input id="key2" type="text"
                               class="form-control{{ $errors->has('key2') ? ' is-invalid' : '' }}"
                               name="key2" value="{{ old('key2') }}"  required>
                        </div>

                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-12">
                            <div id="charge-form-notice2"></div>
                        </div>

                        <div class="col-sm-8 col-sm-offset-3">
                            <a href="javascript:void(0)" class="switch-key btn btn-primary col-sm-12">ĐỔI LOẠI TOOL</a>

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
        // switch now
           $('.switch-key').click(function (e) {
            e.preventDefault();
            var url = `{{route('postSwitchKey')}}`;
            var key = $('#key2').val();
            if (key === "" ) {
                $('#charge-form-notice2').html('Vui lòng nhập đủ các thông tin yêu cầu');
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
                                text:  response.message,
                                type: 'success'
                            }).then(function () {
                                window.location = response.redirect;
                            });
                        } else {
                            Swal({
                                title: 'Không thể đổi loại tool',
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