<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', 'List Order')
    <meta charset="UTF-8">
    <meta name="description" content="list order">
    <meta name="keywords" content="history, balance, invoice">
    <meta name="author" content="support@divinesofts.net">
    @include('new.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
    @extends('new.master-layout')
    @section('content')
        <div class="tab-content mobile" style="display: flex">
            <div class="row bg-white">
                <div class="col s12 m12">
                    <h5 class="row">
                        LIST ORDER
                    </h5>
                    <table class="striped display compact" id="order-listing">
                        <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>Link</th> --}}
                            {{-- <th>Description</th> --}}
                            {{-- <th>Youtube</th> --}}
                            <th>Game Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @auth()
                        @if(count($tools) > 0)
                            @foreach($tools as $index => $tool)
                                <tr class="modal-trigger" href="#key{{$index}}" data-activates="notification">
                                    <td>{{$tool->name}}</td>
                                    {{-- <td><span onclick="copyMessage('{{$tool->link}}')">{{$tool->link}}</span></td> --}}
                                    {{-- <td>{{$tool->description}}</td>
                                    <td><span onclick="copyMessage('{{$tool->youtube}}')">{{$tool->youtube}}</span></td> --}}
                                    <td>{{$tool->game ? $tool->game->name : ''}}</td>
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
                    @if(count($tools) > 0)
                        @foreach($tools as $index => $tool)
                        <!-- Modal Structure -->
                        <div id="key{{$index}}" class="modal modal-fixed-footer">
                            <div class="modal-content">
                                <table id="list-key">
                                    <thead>
                                    <tr>
                                        <th>Name tool</th>
                                        <th>Key</th>
                                        <th>Type key</th>
                                        <th>Time of purchase</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($tool->key) > 0)
                                        @foreach($tool->key as $key)
                                            <tr>
                                                <td>{{$key->tool_name}} / {{$tool->name}}</td>
                                                <td><span onclick="copyMessage('{{$key->key}}')">{{$key->key}}</span></td>
                                                <td>{{$key->package}} hours</td>
                                                <td>{{date("H:i:s d/m", strtotime($key->updated_at))}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endsection
</body>
</html>
{{--(`id`, `name`, `logo`, `images`, `link`, `link_backup`, `description_eng`, `content_eng`, `youtube`, `game_id`, `video_intro`, `updated`,--}}
{{--`active`, `cost`, `package`, `reseller`, `error_code`, `mode`, `description`, `abstract`, `content`, `showcase`, `order`, `author`,--}}
{{--`api_get_key`, `discount`, `created_at`, `updated_at`)--}}

