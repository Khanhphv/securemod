@extends('layouts.app_short_header')
@section('meta')
    @php
        $description = "AIMBOT, ESP and more... Try it now!";

        if (isset($toolDetails->description)) {
            if(App::getLocale() == 'vi'){
             $description = strip_tags($toolDetails->description);
            } else
                $description = strip_tags($toolDetails->description_eng);
        }
    @endphp

    <meta property="description" content="[CHEATSHARP.COM] {{$description}}"/>

    <meta property="og:description" content="[CHEATSHARP.COM] {{$description}}"/>
    <meta property="og:image" content="{{$toolDetails->logo}}"/>
@stop
@section('title')
    @if($toolDetails->name == "BYPASS")
        GUIDE {{$toolDetails->name}}
    @else
        RENT {{$toolDetails->name}} HACK
    @endif

@stop
@section('content-banner')
    <div class="text-center">
        <h1 class="section-title text-center">{{$toolDetails->name}} - CHEATSHARP</h1>
        @if(App::getLocale() == 'vi')
            <span class="tool-description">{{$toolDetails->description}}</span>
        @else
            <span class="tool-description">{{$toolDetails->description_eng}}</span>
        @endif
        <br> <br>
    </div>

    @if(Session::has('error'))
        <div class="text-center" id="">
            <div class="">
                <h2 class=""> {{Session::get('error')}}</h2>
            </div>
        </div>
    @endif
@stop

@section('listTool')
    @if($toolDetails->updated == FALSE)
        <div class="row">
            <div class="col-xs-12">
                <div style="background: darkred; color: #FFF; text-align: center; padding: 5px;">
                    {{ trans('page.tool_is_maintenance') }}
                </div>
            </div>
        </div>
        <br>
    @endif

    @if($toolDetails->name != "BYPASS"  && $toolDetails->updated == TRUE)
        <div class="container">
            <div class="row text-center">
                <div class="package-list">
                    @if(count($package) > 0)
                        @php
                            $countPackage = 0;
                            foreach ($package AS $hour => $price) {
                                if ($hour > 2) {
                                    $countPackage++;
                                }
                            }
                            $row = 4;
                            if ($countPackage == 4 ) {
                                $row = 3;
                            }
                        @endphp
                        @foreach ($package AS $hour => $price)
                            <div class="col-md-{{$row}} text-center">
                                <div class="tool-item">
                                @if($hour == 7)
                                    <!--<div class="ribbon"><span>RẺ NHẤT</span></div>-->
                                    @endif
                                    @php
                                        if(App::getLocale() == 'en') {
                                        $price = round($price/23000,PHP_ROUND_HALF_UP).'$';
                                        } else {
                                        $price = number_format($price).' USD';
                                        }
                                    @endphp
                                    <div class="package-item-hour">
                                        @php if($hour < 24) { $unit = trans('page.hour'); echo $hour;} else {$unit = trans('page.day'); echo (int)($hour/24);};@endphp
                                    </div>
                                    <div class="text-left">
                                        <div style="color: #FFF; padding-bottom: 5px">

                                            {{$unit}} = {{$price}}
                                        </div>
                                        @guest
                                            <a href="{{route('login')}}">{{trans('page.must_login_to_rent')}}</a>
                                        @else
                                            <a href="{{route('tool.buy-tool', [$toolDetails->id, $hour])}}"
                                               class="buy-now">{{trans('page.rent_now')}}</a>
                                        @endguest

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="tool-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tool-review">
                    <div class="tool-review-bounder">
                        <div class="col-xs-12 col-md-6 tool-download" style="padding-right: 0">
                            @if(Auth::user())
                                @if($toolDetails->game_id == 1)
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <a href="https://www.evernote.com/l/AtOjB29dDeVB9ZQYsOpEYK9RDaywsGcZeuY/"
                                               target="_blank" title="LINK SETUP" class="btn btn-primary col-xs-12"
                                               rel="nofollow"><i
                                                        class="glyphicon glyphicon-download-alt"></i>{{trans('page.setup_before')}}
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="https://www.youtube.com/watch?v=Xnm33f0xT_4" target="_blank"
                                               title="Download link" class="btn btn-primary col-xs-12" rel="nofollow"><i
                                                        class="glyphicon glyphicon-facetime-video"></i> {{trans('page.video_setup')}}
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                @if($toolDetails->id != 11)
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <a href="{{$toolDetails->link}}" target="_blank" title="Download link"
                                               class="btn btn-primary col-xs-12" rel="nofollow"><i
                                                        class="glyphicon glyphicon-download-alt"></i> {{ trans('page.download_link_here') }}
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{{$toolDetails->link_backup}}" target="_blank" title="Download link"
                                               class="btn btn-primary col-xs-12" rel="nofollow"><i
                                                        class="glyphicon glyphicon-download-alt"></i> {{trans('page.link_download_backup')}}
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                @else
                                    @if(count($keys) > 0)
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a class="btn btn-primary col-xs-12"
                                                   href="{{url('/download-lite')}}/{{$keys[0]->key}}"><i
                                                            class="glyphicon glyphicon-download-alt"></i> {{ trans('page.download_link_here') }}
                                                </a>
                                            </div>
                                        </div>
                                        <br>
                                    @else
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div style="background: darkred; color: #FFF; text-align: center; padding: 5px;">
                                                    {{trans('page.warning_rent')}}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                @endif
                            @else
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div style="background: darkred; color: #FFF; text-align: center; padding: 5px;">
                                            {{ trans('page.must_login_to_download') }}
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endif
                            <h3 class="page-header" style="margin-top: 0">
                                VIDEO {{trans('page.install')}} {{$toolDetails->name}}
                            </h3>
                            <div class="embed-responsive embed-responsive-16by9 tool-review-bounder">
                                <iframe class="embed-responsive-item"
                                        src="//www.youtube.com/embed/{{$toolDetails->youtube}}"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="text-justify">
                            @if(App::getLocale() == 'vi')
                                {!!  $toolDetails->content !!}
                            @else
                                {!!  $toolDetails->content_eng !!}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        $('.buy-now').click(function (e) {
            e.preventDefault();
            $('.buy-now').hide();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                method: "GET",
                dataType: "JSON",
                success: function (response) {
                    $('.buy-now').show();
                    if (response.status === "success") {
                        $('.bought_keys').show();
                        $('.bought_keys table tbody').prepend('<tr style="color: red"><td>' + response.key + '</td><tdclass="col-sm-8 col-sm-offset-2" class="text-center">' + response.package + '</td><td class="text-center">' + response.time + '</td></tr>');
                        Swal({
                            title: '{{ trans('page.rent_successful') }}',
                            text: "Package " + response.package + " hours, your key is " + response.key,
                            type: 'success'
                        });
                    } else {
                        Swal({
                            title: '{{ trans('page.rent_failed') }}',
                            text: response.message,
                            type: 'error'
                        }).then(function () {
                            if (response.code === 2) {
                                window.location = "{{url('card')}}";
                            }
                            if (response.code === 190) {
                                window.location = "{{url('login')}}";
                            }
                        });


                    }
                }
            })
        })
    </script>
@stop
