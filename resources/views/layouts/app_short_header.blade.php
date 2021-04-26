<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"                content="{{url()->current()}}" />
    @if(View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:description" content="Show enemy 's position, AIMBOT and more... Top 1 is easy, try now!"/>
        <meta name="description" content="Show enemy 's position, AIMBOT and more... Top 1 is easy, try now!">
        <meta property="og:image" content="{{url('/images/s6_bg.png')}}"/>
    @endif
    <title>@yield('title') - CHEATSHARP.COM - HACK GAME ONLINE</title>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @include('layouts.elements.css')
    @yield('css')
</head>
<body>
    <div id="app">
        <div class="short-header">
            @include('layouts.elements.header2')
            <div class="header-short-banner">
                @yield('content-banner')
            </div>
        </div>

        <div class="package-list">
            @yield('listTool')
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
    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    @if(Session::has('message'))
    <script>
        Swal({
            title: 'Notice!',
            text: '{{Session::get('message')}}',
            type: '{{Session::get('level')}}'
        })
    </script>
    @endif
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
