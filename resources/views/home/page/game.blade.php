@extends('layouts.app')
@section('meta')
    @php
        $description = trans("page.description");
        if (isset($game->notice)) {
            $description = strip_tags($game->notice);
        }
    @endphp

    <meta property="description" content="[CHEATSHARP.COM] {{$description}}"/>

    <meta property="og:description" content="[CHEATSHARP.COM] {{$description}}"/>

    <meta property="og:image" content="{{$game->thumb_image}}"/>

@stop
@section('title')
    HACK GAME {{$game->name}} {{ trans('page.header_title') }}
@stop
@section('header-banner')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-intro">
                    <div class="header-intro-text-block">
                        <h1 class="header-title">HACK GAME {{$game->name}} {{ trans('page.header_title') }}</h1>
                        <p class="header-sub-title">{{isset($siteSettings['header_title'])? $siteSettings['header_title']: "TRẦN DUY HƯNG"}}</p>
                    </div>
                    <br>
                    <!--<a href="#" class="big-button">GROUP FACEBOOK</a>-->
                    <div class="header-notice">
                        @if(App::getLocale() == 'vi')
                            {!!(isset($game->notice)? $game->notice: "Nội dung thông báo ở header")!!}
                        @else
                            {!!(isset($game->notice_eng)? $game->notice_eng: "Message content in header")!!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div id="page-wrapper" class="tool-of-game">
    <!--<img src="{{url('images/s3_r.png')}}" class="tool-of-game-people hidden-sm hidden-xs"/>-->
        <div class="container">
            @if(count($listTools) > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header text-center text-uppercase">{{trans('page.types')}}
                            HACK {{$game->name}}</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row item-container">
                    @foreach($listTools as $tool)
                        <div class="col-md-4">
                            <div class="item-bounder">
                                <div class="item-image">
                                    <a href="{{route('tool.getDetail', $tool->name)}}"><img src="{{$tool->logo}}"
                                                                                            alt="..."></a>
                                    @if($tool->updated == TRUE)
                                        <span class="item-status"
                                              style="background: #27ae60">{{trans('page.updated')}}</span>
                                    @else
                                        <span class="item-status"
                                              style="background: #c0392b">{{trans('page.maintenance')}}</span>
                                    @endif

                                </div>
                                <div class="item-caption">
                                    <h3>{{$tool->name}} - {{$game->name}}</h3>
                                    <p>{!! $tool->description !!}</p>
                                    <hr/>
                                    <div class="row">
                                        @if($tool->updated == TRUE)
                                            @if($tool->name != "BYPASS")
                                                <div class="col-md-6">
                                                    <select name="package" class="form-control"
                                                            id="package_list_{{$tool->id}}">
                                                        <option value="">---{{trans('page.select_package')}}---</option>
                                                        @foreach($tool->package AS $hour => $price)
                                                            <option value="{{$hour}}">${{$price}}/{{$hour}}h
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-6">
                                                    @if($tool->name == "FREE")
                                                        <a href="{{url('buy-tool/')}}/{{$tool->id}}/"
                                                           class="buy-now btn btn-success" data-tool="{{$tool->id}}"
                                                           style="width: 100%" role="button">DONATE</a>
                                                    @else
                                                        <a href="{{url('buy-tool/')}}/{{$tool->id}}/"
                                                           class="buy-now btn btn-primary text-uppercase" data-tool="{{$tool->id}}"
                                                           style="width: 100%"
                                                           role="button">{{trans('page.rent_now')}}</a>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <a href="{{route('tool.getDetail', $tool->name)}}"
                                                       class="btn btn-danger" style="width: 100%" role="button">{{trans('page.recommend')}}</a>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-md-12">
                                                <button class="btn btn-danger col-md-12">{{trans('page.maintenance')}}</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div style="height: 10px"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{route('tool.getDetail', $tool->name)}}" class="btn btn-default"
                                               style="width: 100%" role="button"><i
                                                        class="glyphicon glyphicon-facetime-video"></i> {{trans('page.download_info')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header text-center">HACK {{$game->name}} {{ trans('page.will_open') }}...</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('.buy-now').click(function (e) {
                e.preventDefault();
                $('.buy-now').hide();
                var url = $(this).attr('href');
                var tool_id = $(this).attr('data-tool');
                var selected_package = $('#package_list_' + tool_id).val();
                if (!(selected_package > 0)) {
                    alert("{{ trans('page.must_choose_package') }}");
                    $('.buy-now').show();
                    return;
                } else {
                    url += selected_package;
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "JSON",
                        success: function (response) {
                            $('.buy-now').show();
                            if (response.status === "success") {
                                Swal({
                                    title: 'Successfully',
                                    text: "Package " + response.package + " hours. Your key is: " + response.key,
                                    type: 'success'
                                });
                            } else {
                                Swal({
                                    title: 'Something wrong...',
                                    text: response.message,
                                    type: 'error'
                                }).then(function () {
                                    if (response.code === 2) {
                                        window.location = "{{url('/card')}}";
                                    }
                                    if (response.code === 190) {
                                        window.location = "{{url('/login')}}";
                                    }
                                });


                            }
                        }
                    })
                }
            })
        });

    </script>
@stop
