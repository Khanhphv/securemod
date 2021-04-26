@extends('layouts.app_short_header')
@section('title')
    {{trans('page.transaction_history')}} - TOOL PUBG MOBILE - CHEATSHARP.COM
@stop
@section('content-banner')
    <h2 class="section-title">
        {{trans('page.transaction_history')}}
    </h2>
@stop
@section('content')
    <meta http-equiv="refresh" content="30">
    <div class="section" style="margin-bottom: 50px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($histories) > 0 )
                        <h1 class="section-title text-center"></h1>
                        <div>
                            {!!$histories->render()!!}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="text-align: center"> {{trans('page.action')}}</th>
                                    <th style="text-align: center"> {{trans('page.amount')}}</th>

                                    <th> {{trans('page.content')}}</th>
                                    <th style="text-align: center"> {{trans('page.time')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($histories as $history)
                                    <tr>
                                        <td>{{$history->id}}</td>
                                        <td style="text-align: center">{{$history->action}}</td>
                                        <td style="text-align: center">{{number_format($history->amount2)}}</td>
                                        <td>@if ($history->action == "MUA_KEY_DAI_LY") <a href="{{route('reseller.bought', $history->id)}}">[{{trans('page.view_file')}}] </a>@endif{{$history->content}}
                                            @if(App::getLocale() == 'vi')
                                                {{$history->content}}
                                            @else
                                                {{$history->content_eng}}
                                            @endif</td>
                                        <td style="text-align: center">{{$history->updated_at->format('H:i:s d/m')}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {!!$histories->render()!!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
