@extends('layouts.app_short_header')
@section('title')
    {{trans('page.key_buy_history')}} - {{trans('page.your_account_info')}} - CHEAT GAME ONLINE - CHEATSHARP.COM
@stop
@section('content-banner')
    <h2 class="section-title">
        {{trans('page.key_buy_history')}} - {{trans('page.your_account_info')}}
    </h2>
@stop
@section('content')
    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header text-center"> {{trans('page.your_account_info')}}: {{$user->name}}</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul style="font-size: 16px; background: #fac13d; padding: 20px;">
                        <li><strong>  {{trans('page.amount_available')}}: {{number_format($user->credit)}}</strong>.
                            <strong>  {{trans('page.referer_link')}}: <input type="text"
                                                                             value="{{url('register').'?ref='.$user->id}}"
                                                                             id="myInput" style=" border: 0; background: transparent;
                                                           padding: 0 5px; min-width: 280px" onClick="copyMe(this)"
                                                                             readonly=""></strong></li>
                        {{trans('page.profile_note')}} <strong style="color: #d60000">{{$user->user_ref_commission}}
                            %</strong> {{trans('page.profile_note_2')}}.
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header text-center">{{trans('page.have_buyed')}}  {{count($keys)}} KEY(s)</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(empty($keys))
                        <div style="height: 10px;"></div>
                    @endif
                    <div class="bought_keys">
                        @if(!empty($keys))
                            <div>
                                {!!$keys->render()!!}
                            </div>
                            <div class="table-responsive">
                                <table class="table text-left" style="margin-bottom: 0;">
                                    <thead>
                                    <tr>
                                        <th>{{trans('page.name_tool')}}</th>
                                        <th>{{trans('page.key')}}</th>
                                        <th>{{trans('page.type_key')}}</th>
                                        <th class="text-center">{{trans('page.time_buy')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($keys AS $key)
                                        <tr>
                                            <td>{{$key->tool_name}} / {{$key->game_name}}</td>
                                            <td><input type="text" value="{{$key->key}}"
                                                       style="width: 100%; border: 0; background: transparent; min-width: 160px;
                                                           padding: 0 5px;" onClick="copyMe(this)" readonly=""/>
                                            </td>
                                            <td>{{$key->package}} {{ trans('page.hours') }}</td>
                                            <td class="text-center">{{date("H:i d/m", strtotime($key->history_created_at))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {!!$keys->render()!!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@stop

@section('js')
    <script>
        function copyMe(obj) {
            obj.select();
            document.execCommand("copy");
            swal({
                'title': "Copied",
                'text': obj.value
            });
        }
    </script>
@stop
