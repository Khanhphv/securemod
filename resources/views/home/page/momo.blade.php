@extends('layouts.app_no_header')
@section('title')
    NẠP TIỀN QUA VÍ MOMO
@endsection
@section('content')
<meta http-equiv="refresh" content="10" >
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <div class="card">
                <div class="card-header">{{ __('NẠP TIỀN BẰNG VÍ MOMO') }}</div>
                <div class="card-body">
					Bạn chuyển tiền tới số điện thoại <span style="font-size: 25px"><strong style="color: yellow">0584</strong><strong style="color: orange">707</strong><strong style="color: yellow">698</strong></span><br>
					Khi chuyển tiền, điền vào ô <strong style="color: yellow">Tin nhắn</strong> nội dung: <strong style="color: yellow; font-size: 25px">{{ Auth::user()->id }}</strong> (đây chính là ID của bạn).<br>
					<span style="color: yellow; font-size: 16px">(Nếu bạn không điền, hệ thống sẽ không biết bạn đang nạp tiền cho ai, vì vậy cần lưu ý nhé)</span><br>
					<br>Ngay sau khi nhận được tiền, hệ thống tự động cộng tiền vào tài khoản của bạn.<br>
					Thời gian tối đa 3 phút bất kể ngày đêm. Nếu có vấn đề, bạn vui lòng liên hệ Admin.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection