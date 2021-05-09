@extends('layouts.app_short_header')

@section('title')
    Nạp thẻ GATE
@stop
@section('content-banner')
    <h2 class="section-title">
        NẠP THẺ GATE NHẬN 70% GIÁ TRỊ THẺ
    </h2>
@stop
@section('css')
    <style>
        .charge-form .row
        {
            margin: 20px -15px;

        }
    </style>
    @stop
@section('header-banner')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-intro">
                    <div class="header-intro-text-block">
                        <h1 class="header-title">{{isset($siteSettings['header_title'])? $siteSettings['header_title']: "WEBSITE CHO THUÊ KEY GAME BỞI TRẦN DUY HƯNG"}}</h1>
                        <p class="header-sub-title">{{isset($siteSettings['header_sub_title'])? $siteSettings['header_sub_title']: "https://www.facebook.com/chaybo5000m"}}</p>
                    </div>
                    <br>
                    <!--<a href="#" class="big-button">GROUP FACEBOOK</a>-->
                    <div class="header-notice">
                        {!!(isset($siteSettings['header_notice'])? $siteSettings['header_notice']: "Nội dung thông báo ở header")!!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img src="{{url('images/s3_coverper.png')}}" alt="Header image" class="header-top-layer hidden-xs"/>

@stop
@section('content')

    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                @if(Auth::check())
                    @php
				exit('GAMEBANK ĐANG TẮT');
                        // $checkServer = @file_get_contents('http://thuthe247.com/home/status_card_active');
                       // if(json_decode($checkServer)->VIETTEL == 1) {
                    @endphp
                    <!--<div style="color: red; font-weight: bold">
							XIN LỖI, CHỨC NĂNG NẠP THẺ TẠM BẢO TRÌ ĐẾN 12H ĐÊM NGÀY 30/4/2019. BẠN VUI LÒNG NẠP ATM HOẶC MOMO.
							</div>
							-->
                        <div data-action="{{route('gate_gamebank')}}" id="charge-form" class="charge-form text-light"
                             role="form" style="margin: 0 -15px;">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <select class="form-control {{ $errors->has('card_type_id') ? ' is-invalid' : '' }}"
                                            id="charge-form-provider" name="card_type_id" required>
                                        <option value="4" selected>Thẻ GATE</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control {{ $errors->has('price_guest') ? ' is-invalid' : '' }}"
                                            id="charge-form-amount" name="price_guest" required>
                                        <option value="">-CHỌN ĐÚNG MỆNH GIÁ THẺ-</option>
                                        <option value="10000">10.000 đ</option>
                                        <option value="20000">20.000 đ</option>
                                        <option value="30000">30.000 đ</option>
                                        <option value="50000">50.000 đ</option>
                                        <option value="100000">100.000 đ</option>
                                        <option value="200000">200.000 đ</option>
                                        <option value="300000">300.000 đ</option>
                                        <option value="500000">500.000 đ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text"
                                           class="form-control {{ $errors->has('seri') ? ' is-invalid' : '' }}"
                                           id="charge-form-seri" placeholder="SERI THẺ" required
                                           name="seri">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text"
                                           class="form-control {{ $errors->has('pin') ? ' is-invalid' : '' }}"
                                           id="charge-form-pin" placeholder="MÃ THẺ" required
                                           name="pin">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text"
                                           class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}"
                                           id="charge-form-captcha" placeholder="Nhập mã bảo mật trong hình bên phải"
                                           required
                                           name="captcha">
                                </div>
                                <div class="col-sm-6">
                                    <div style="background: #FFF;text-align: center;"
                                         id="charge-form-captcha-image">
                                        @php echo Captcha::img();@endphp
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="charge-form-notice"></div>
                                    <a class="btn btn-primary col-xs-12" id="charge-form-submit"
                                       style="font-weight: normal; color: #FFF;">NẠP NGAY
                                    </a>
                                </div>
                            </div>
                        </div>

                        <p class="charge-notice" style="margin-left: -15px">
                            <strong>Lưu ý:</strong><br>
                            - Thẻ ĐT chỉ đc 70% số tiền. Bạn nạp qua <a href="{{url('charge-nl')}}">Internet
                                Banking</a> hoặc <a href="{{url('momo')}}">Ví Momo</a> để nhận 100%<br>
                            - Tiền được cộng vào tài khoản sau 3p. Nếu chậm hơn, bạn vui lòng liên hệ Admin.<br>
                            - Bạn cần chọn đúng mệnh giá thẻ nếu không sẽ bị mất thẻ. Admin không thể can thiệp việc này
                            do thẻ được gửi sang bên khác xử lý.
                            <br> <br><br>
                        </p>
                        @php
                            //  } else{
                        @endphp

                        @php //} @endphp
                    @else
                        <div class="text-light text-center login-notice">VUI LÒNG
                            <a
                                    href="{{route('login')}}"> ĐĂNG NHẬP </a>ĐỂ NẠP THẺ
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('#charge-form-submit').click(function (e) {
                e.preventDefault();
                var self = $(this);
                self.hide();
                $('#charge-form-submit').prop('disabled', true)
                var url = $('#charge-form').data('action');
                var data = {};
                data.card_type_id = $('#charge-form-provider').val();
                data.price_guest = $('#charge-form-amount').val();
                data.pin = $('#charge-form-pin').val();
                data.seri = $('#charge-form-seri').val();
                data.captcha = $('#charge-form-captcha').val();

                if (data.card_type_id === "" || data.price_guest === "" || data.pin === "" || data.seri === "" || data.captcha === "") {
                    $('#charge-form-notice').html('Vui lòng nhập đủ các thông tin yêu cầu');
                    self.show();
                    return false;
                } else {
                    $.ajax({
                        url: url,
                        data: data,
                        method: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            self.show();
                            if (response.errors.length === 0) {
                                $('#charge-form-submit').prop('disabled', false)
                                $('#charge-form-notice').html(response.message);
                                window.setTimeout(function () {
                                    window.location.href = "{{route('history')}}";
                                }, 3000);
                            } else {
                                @php $imageLink = url('captcha/default').'?'; @endphp
                                $('#charge-form-captcha-image').html('<img src="@php echo $imageLink; @endphp' + Math.floor((Math.random() * 1000) + 1) + '" />');
                                $('#charge-form-notice').html(response.errors);
                            }
                        },
                        error: function () {
                            self.show();
                            $('#charge-form-notice').html('Vui lòng nhập đủ các thông tin và thử lại.');
                            @php $imageLink = url('captcha/default').'?'; @endphp
                            $('#charge-form-captcha-image').html('<img src="@php echo $imageLink; @endphp' + Math.floor((Math.random() * 1000) + 1) + '" />');
                        }
                    })
                }


            })
        });

    </script>
@stop