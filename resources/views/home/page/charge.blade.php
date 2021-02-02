@extends('layouts.app_no_header')
@section('title')
    NẠP TIỀN - TOOL PUBG MOBILE - CHEATSHARP.COM
@stop
@section('css')
    <style>
        ul {
            padding-left: 0;
        }
        .cardList li {
            float: left;
            margin-right: 3px;
        }

        .cardList li {
            margin-bottom: 10px;
            text-align: center;
            list-style: none;
        }

        i.VISA, i.MASTE, i.AMREX, i.JCB, i.VCB, i.TCB, i.MB, i.VIB, i.ICB, i.EXB, i.ACB, i.HDB, i.MSB, i.NVB, i.DAB, i.SHB, i.OJB, i.SEA, i.TPB, i.PGB, i.BIDV, i.AGB, i.SCB, i.VPB, i.VAB, i.GPB, i.SGB, i.NAB, i.BAB {
            width: 80px;
            height: 30px;
            display: block;
            background: url(https://www.nganluong.vn/webskins/skins/nganluong/checkout/version3/images/bank_logo.png) no-repeat;
        }

        i.MASTE {
            background-position: 0px -31px
        }

        i.AMREX {
            background-position: 0px -62px
        }

        i.JCB {
            background-position: 0px -93px;
        }

        i.VCB {
            background-position: 0px -124px;
        }

        i.TCB {
            background-position: 0px -155px;
        }

        i.MB {
            background-position: 0px -186px;
        }

        i.VIB {
            background-position: 0px -217px;
        }

        i.ICB {
            background-position: 0px -248px;
        }

        i.EXB {
            background-position: 0px -279px;
        }

        i.ACB {
            background-position: 0px -310px;
        }

        i.HDB {
            background-position: 0px -341px;
        }

        i.MSB {
            background-position: 0px -372px;
        }

        i.NVB {
            background-position: 0px -403px;
        }

        i.DAB {
            background-position: 0px -434px;
        }

        i.SHB {
            background-position: 0px -465px;
        }

        i.OJB {
            background-position: 0px -496px;
        }

        i.SEA {
            background-position: 0px -527px;
        }

        i.TPB {
            background-position: 0px -558px;
        }

        i.PGB {
            background-position: 0px -589px;
        }

        i.BIDV {
            background-position: 0px -620px;
        }

        i.AGB {
            background-position: 0px -651px;
        }

        i.SCB {
            background-position: 0px -682px;
        }

        i.VPB {
            background-position: 0px -713px;
        }

        i.VAB {
            background-position: 0px -744px;
        }

        i.GPB {
            background-position: 0px -775px;
        }

        i.SGB {
            background-position: 0px -806px;
        }

        i.NAB {
            background-position: 0px -837px;
        }

        i.BAB {
            background-position: 0px -868px;
        }

        .active .boxContent {
            display: block !important;
        }

        .list-content li .boxContent {
            display: none;
        }

        .list-content {
            overflow: hidden;
            margin: 20px 0;
            list-style: none;
            padding-left: 0;
        }

        .boxContent {
            margin-left: 25px;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="card">
                <form name="NLpayBank" action="{{route('charge.nl')}}" method="post" class="main_form">
                {!! csrf_field() !!}
                <!-- <h1 style="text-align: center; margin: 0;">ATM</h1> -->
                    <label><strong>Nhập số tiền bạn muốn nạp</strong></label>
                    <input type="number" min="20000" step="10000" id="total_amount"
                           name="total_amount"
                           class="field-check my_select form-control" value="50000" placeholder="NHẬP SỐ TIỀN" required>
                    <ul class="list-content">
                        <li>
                            <label><input type="radio" value="ATM_ONLINE" required name="option_payment"> Online bằng
                                thẻ
                                ngân
                                hàng nội địa (MIỄN PHÍ)</label>
                            <div class="boxContent">
                                <p><i>
                                        <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>:
                                        Bạn cần
                                        đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước
                                        khi
                                        thực
                                        hiện.</i>
                                </p>
                                <ul class="cardList clearfix">
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                            <input type="radio" value="BIDV" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                            <input type="radio" value="VCB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                            <input type="radio" value="DAB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                            <input type="radio" value="TCB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="MB" title="Ngân hàng Quân Đội"></i>
                                            <input type="radio" value="MB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                            <input type="radio" value="VIB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                            <input type="radio" value="ICB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                            <input type="radio" value="EXB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="ACB" title="Ngân hàng Á Châu"></i>
                                            <input type="radio" value="ACB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                            <input type="radio" value="HDB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                            <input type="radio" value="MSB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                            <input type="radio" value="NVB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="VAB" title="Ngân hàng Việt Á"></i>
                                            <input type="radio" value="VAB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                            <input type="radio" value="VPB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                            <input type="radio" value="SCB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                            <input type="radio" value="PGB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                            <input type="radio" value="GPB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                            <input type="radio" value="AGB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                            <input type="radio" value="SGB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                            <input type="radio" value="BAB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="TPB" title="Tền phong bank"></i>
                                            <input type="radio" value="TPB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="NAB" title="Ngân hàng Nam Á"></i>
                                            <input type="radio" value="NAB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                            <input type="radio" value="SHB" name="bankcode">
                                        </label>
                                    </li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                            <input type="radio" value="OJB" name="bankcode">
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <label><input type="radio" value="IB_ONLINE" name="option_payment"> Thanh toán bằng Internet
                                Banking</label>
                            <div class="boxContent">
                                <p><i>
                                        <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>:
                                        Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân
                                        hàng
                                        trước khi thực hiện.</i></p>

                                <ul class="cardList clearfix">
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                            <input type="radio" value="BIDV" name="bankcode">

                                        </label></li>
                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                            <input type="radio" value="VCB" name="bankcode">

                                        </label></li>

                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                            <input type="radio" value="DAB" name="bankcode">

                                        </label></li>

                                    <li class="bank-online-methods ">
                                        <label>
                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                            <input type="radio" value="TCB" name="bankcode">

                                        </label></li>


                                </ul>

                            </div>
                        </li>

                        <li>
                            <label><input type="radio" value="VISA" name="option_payment" required selected="true"> Thẻ
                                Visa hoặc MasterCard (5k/1 GIAO DỊCH)</label>
                        </li>
                        <!--
                           <li>
                               <label><input type="radio" value="CREDIT_CARD_PREPAID" name="option_payment" selected="true">Thanh toán bằng thẻ Visa hoặc MasterCard trả trước</label>

                           </li>
                           -->
                    </ul>
                    <p class="text-left" style="font-size: 16px; font-weight: bold; color: red">
                        <u>Lưu ý quan trọng:</u><br>
                        Khi thanh toán ở website của ngân hàng xong, bạn KHÔNG ĐƯỢC ĐÓNG TAB. Vui lòng chờ cho đến khi
                        được chuyển ngược về trang gamede.net, khi đó chúng tôi mới nhận được thông tin giao dịch
                        thành công để cộng tiền.
                    </p>
                    <input type="submit" name="nlpayment" value="NẠP NGAY" class="btn btn-primary"
                           style="width: 100%;background: #FAC93B;padding: 10px;font-size: 15px;border:0"/>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('js')
    <script language="javascript">
        $('input[name="option_payment"]').bind('click', function () {
            $('.list-content li').removeClass('active');
            $(this).parent().parent('li').addClass('active');
        });
    </script>
@stop
