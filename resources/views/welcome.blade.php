@extends('layouts.app')

@section('title')
    Home
@stop
@section('css')
    <style>
        .dropdown>.dropdown-menu {
            top: 200%;
            transition: 0.3s all ease-in-out;
        }
        .dropdown:hover>.dropdown-menu {
            display: block;
            top: 100%;
        }

        .dropdown>.dropdown-toggle:active {
            /*Without this, clicking will make it sticky*/
            pointer-events: none;
        }
    </style>
@endsection
@section('header-banner')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-intro">
                    <div class="header-intro-text-block">
                        <h1 class="header-title">{{isset($siteSettings['header_title'])? $siteSettings['header_title']: trans('page.who_owner') }}</h1>
                        <p class="header-sub-title">{{isset($siteSettings['header_sub_title'])? $siteSettings['header_sub_title']: "Support by heart ♥"}}</p>
                    </div>
                    <br>
                    <!--<a href="#" class="big-button">GROUP FACEBOOK</a>-->
                    <div class="header-notice">
                        {!!(isset($siteSettings['header_notice'])? $siteSettings['header_notice']: "Message content in header")!!}
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
                <div class="col-lg-12">
                    <h2 class="page-header text-center">{{trans('page.list_game')}}</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(isset($games) && count($games) > 0)
                <div class="row item-container">
                    @foreach($games as $game)
                        @if($game->name != "RING OF ELYSIUM(ROE)")
                            <div class="col-md-4">
                                <div class="item-bounder">
                                    <div class="item-image">
                                        @if(substr($game->slug, 0, 4) == 'http')
                                            <a href="{{$game->slug}}"><img src="{{$game->thumb_image}}" target="_blank"
                                                                           alt="..."></a>
                                        @else
                                            <a href="{{route('game.tool', $game->slug)}}"><img
                                                        src="{{$game->thumb_image}}" alt="..."></a>
                                        @endif
                                    </div>
                                    <div class="item-caption">
                                        <h3>{{$game->name}}</h3>
                                        @if(App::getLocale() == 'vi')
                                            {!! $game->description !!}
                                        @else
                                            {!! $game->description_eng !!}
                                        @endif
                                        <hr>

                                        @if(substr($game->slug, 0, 4) == 'http')
                                            <a href="{{$game->slug}}" target="_blank" class="btn btn-primary"
                                               style="width: 100%"

                                               role="button">{{trans('page.rent_now')}}</a>
                                        @else
                                            <a href="{{route('game.tool', $game->slug)}}" class="btn btn-primary"
                                               style="width: 100%"

                                               role="button">{{trans('page.rent_now')}}</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('#charge-form-submit').click(function (e) {
                e.preventDefault();
                $('#charge-form-submit').prop('disabled', true);
                var url = $('#charge-form').data('action');
                var data = {};
                data.provider = $('#charge-form-provider').val();
                data.amount = $('#charge-form-amount').val();
                data.pin = $('#charge-form-pin').val();
                data.seri = $('#charge-form-seri').val();
                data.captcha = $('#charge-form-captcha').val();

                if (data.provider === "" || data.amount === "" || data.pin === "" || data.seri === "" || data.captcha === "") {
                    $('#charge-form-notice').html('{{ trans('page.input_required' )}}');
                    return false;
                } else {
                    $.ajax({
                        url: url,
                        data: data,
                        method: "POST",
                        dataType: "JSON",
                        success: function (response) {
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
                            $('#charge-form-notice').html('{{ trans('page.reinput' )}}');
                            @php $imageLink = url('captcha/default').'?'; @endphp
                            $('#charge-form-captcha-image').html('<img src="@php echo $imageLink; @endphp' + Math.floor((Math.random() * 1000) + 1) + '" />');
                        }
                    })
                }


            })
        });

    </script>
@stop
