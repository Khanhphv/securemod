<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', 'Keys')
    <meta charset="UTF-8">
    <meta name="description" content="keys history">
    <meta name="keywords" content="history, balance, invoice">
    <meta name="author" content="support@divinesofts.net">
    @include('new.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
    @extends('new.master-layout')
    @section('content')
        <div class="tab-content mobile" style="display: block">
            <div class="row ">
                <div class="col s12 m12">
                    <h2 class="row mb-3">
                        KEYS HISTORY
                    </h5>
                    <table class="table table-striped table-hover table-bordered" id="order-listing">
                            <thead>
                            <tr>
                                <th>Name tool</th>
                                <th>Key</th>
                                <th>Type key</th>
                                <th>Time of purchase</th>
                            </tr>
                            </thead>
                            <tbody>
                            @auth()
                            @if(count($keys) > 0)
                                @foreach($keys as $key)
                                    <tr>
                                        <td>{{$key->tool_name}} / {{$key->game_name}}</td>
                                        <td><span onclick="copyMessage('{{$key->key}}')">{{$key->key}}</span></td>
                                        <td>{{$key->package}} hours</td>
                                        <td>{{date("H:i d/m", strtotime($key->history_created_at))}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @endauth
                            @guest()
                                <tr class="odd">
                                    <td valign="top" colspan="5" class="dataTables_empty">No data available in table</td>
                                </tr>
                            @endguest
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    @endsection
</body>
</html>


