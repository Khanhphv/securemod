<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta property="og:url" content="{{url()->current()}}"/>
	@if(View::hasSection('meta'))
		@yield('meta')
	@else
		<meta property="og:description" content="Hiển thị vị trí địch, AIMBOT, ghìm tâm... Thử ngay!"/>
		<meta name="description" content="HACK PUBG MOBILE TENCENT, Hiển Thị Vị Trí Địch, AIMBOT, Ghìm Tâm, Nhìn Xuyên Tường, Hủy Diệt Trên Mọi Địa Hình... Thử Ngay!">
		<meta property="og:image" content="{{url('/images/s6_bg.png')}}"/>
	@endif



    {{ Html::favicon( $master_site_settings['favicon'] ) }}
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<title>@yield('title') - CHEATSHARP.COM - HACK GAME ONLIINE</title>
	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	@include('layouts.elements.css')
	@yield('css')
</head>
<body>
	<div id="app">
		<div class="header">
			@include('layouts.elements.header2')
			<div class="header-banner">
				@yield('header-banner')
			</div>
		</div>
		<main class="main">
			@yield('content')
		</main>
		@include('layouts.elements.footer')
	</div>


	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('js/custom2.js') }}"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
	@yield('js')

	@if(isset($siteSettings['header_code']) && $siteSettings['header_code'] != "")
       {!!$siteSettings['header_code']!!}
	@endif

</body>
</html>
