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
        <div class="tab-content mobile" style="display: block">
            <div class="row">
                <div class="col s12 m12">
                    <h2 class="row mb-3">
                        LIST ORDER
                    </h5>
                    <table class="table table-striped table-hover table-bordered" id="order-listing">
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
                                <tr data-bs-toggle="modal" data-bs-target="#key{{$index}}" >
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
                        <div id="key{{$index}}" class="modal fade modal-fixed-footer">
                             <div class="modal-dialog">
                                <div class="modal-content">
                                {{-- <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> --}}
                                <div class="modal-body">
                                   <table class="table table-bordered" id="list-key">
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
                                        @else
                                            <tr><td colspan="4">No data to display</td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>                               
                                </div>
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

