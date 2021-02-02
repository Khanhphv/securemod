@extends('adminlte::page')

@section('title', 'Edit key')

@section('content_header')
    <h1>Edit key</h1>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

@stop

@section('content')
    <form action="{{route('key.update',$key->id)}}" method="post" role="form">
        @method('PUT')
        @csrf

        @if(count($errors)>0)
            <ol>
                @foreach($errors->all() as $err)
                    <li class=" text-warning" style="margin-bottom: 5px">
                        {{$err}}
                    </li>
                @endforeach
            </ol>
        @endif

        <div class="form-group">

            @if(count($tools) == 0)
                <label for="" class="">Chưa có key nào!</label>
            @else
                <label for="tool" class="">Select tool</label>
                <select class="form-control" id="tool" required name="tool_id">
                    @php
                        $packagesList = array();
                        $currentPackage = $key->tool_id."_".$key->package;
                    @endphp
                    <option value="null">-- Select tool --</option>
                    @foreach($tools as $tool)
                        @php
                            $packagesList["t".$tool->id] = $tool->package;
                        @endphp
                        <option value="{{$tool->id}}" {{ ($tool->id == $key->tool_id) ? "selected" : "" }} >{{str_pad($tool->game_name, 50, '.')}}: {{$tool->name}}</option>
                    @endforeach
                </select>
            @endif

        </div>

        <div class="form-group">
            <label for="package" class="">Select key type</label>
            <select class="form-control" id="package" name="package">
            </select>
        </div>
        <div class="form-group">
            <label for="key">Key</label>
            <input name="key" id="key" class="form-control" value="{{old('key',isset($key->key)? $key->key: null)}}"/>
        </div>


        <div class="form-group">
            <label for="user_id" class="">USER</label>
            <input type="number" class="form-control" id="user_id" name="user_id"
                   value="{{old('user_id',isset($key->user_id) ? $key->user_id: null)}}">
        </div>
        <div class="form-group">
            <label for="hwid" class="">Current HWID</label>
            <input type="text" class="form-control" id="user_id" name="hwid"
                   value="{{old('hwid',isset($key->hwid) ? $key->hwid: null)}}">
        </div>
        <div class="form-group">
            <label for="hwid_count" class="">HWID count</label>
            <input type="number" class="form-control" id="user_id" name="hwid_count"
                   value="{{old('hwid_count',isset($key->hwid_count) ? $key->hwid_count: null)}}">
        </div>
        <div class="form-group">
            <label for="hwid_fixed" class="">Static HWID</label>
            <input type="text" class="form-control" id="hwid_fixed" name="hwid_fixed"
                   value="{{old('hwid_fixed',isset($key->hwid_fixed) ? $key->hwid_fixed: null)}}">
        </div>


        <br>

        <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
        <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
    </form>

    @if(isset($history))
        <h3>Key history</h3>
        <div class="table-responsive">

            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>User ID</th>
                    <th>Content</th>
                    <th>Time</th>


                </tr>
                <tr>
                    <td>{{$history->user_id}}</td>
                    <td>{{$history->content}}</td>
                    <td>{{$history->updated_at}}</td>
                </tr>


            </table>
        </div>
    @endif


    @if(count($debugs) > 0)
        <h3>Debug history</h3>
        <div class="table-responsive">
            <a href="{{ route('clear-debug').'/'.$key->id }}" class="btn btn-danger pull-right"
               style="width: 105px;margin-bottom: 15px;">CLEAR DEBUG</a>
            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Log type</th>
                    <th>File</th>
                    <th>Function</th>
                    <th>Log code</th>
                    <th>Line</th>
                    <th>Note</th>
                </tr>
                @foreach($debugs as $debug)
                    <tr>
                        <td>{{$debug->id}}</td>
                        <td>{{$debug->created_at}}</td>
                        <td>{{$debug->log_type_text}}</td>
                        <td>{{$debug->file_code_text}}</td>
                        <td>{{$debug->function_code_text}}</td>
                        <td>{{$debug->log_code_text}}</td>
                        <td>{{$debug->log_line}}</td>
                        <td>{{$debug->log_note}}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    @endif

    @if(count($hwidLogs) > 0)
        <h3>Device history (HWIDS)</h3>
        <div class="table-responsive">
            <table class="table table-hover" style="background: #FFF">

                <tr>
                    <th>HWID</th>
                    <th>IP Address</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                @foreach($hwidLogs as $hwidLog)
                    <tr>
                        <td>{{$hwidLog->hwid}}</td>
                        <td>{{$hwidLog->ip_address}}</td>
                        <td>{{$hwidLog->created_at}}</td>
                        <td>{{$hwidLog->updated_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    @if(isset($historyHwids) && count($historyHwids) > 0)
        <h3>HWIDS</h3>
        <div class="table-responsive">
            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>ID</th>
                    <th>HWID</th>
                    <th>KEY</th>
                    <th>Cheat name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                @foreach($historyHwids as $hwid)
                    <tr>
                        <td>{{$hwid->id}}</td>
                        <td>{{$hwid->hwid}}</td>
                        <td>{{$hwid->key}}</td>
                        <td>{{$hwid->cheat_name}}</td>
                        <td>{{$hwid->created_at}}</td>
                        <td>{{$hwid->updated_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@stop

@section('js')
    <script>
        $(document).ready(function () {
            let toolType = $('#tool').val();
            addOption(toolType)
        });
        $('#tool').on('change', function () {
            let toolType = $(this).val();
            addOption(toolType);
        });

        function addOption(toolType) {
            let packagesList = JSON.parse('@php echo json_encode($packagesList); @endphp');
            $('#package').html('');
            $.each(packagesList["t" + toolType], function (i, e) {

                let packageName = toolType + '_' + i;
                let selected = "";
                if (packageName === "@php echo $currentPackage @endphp") {
                    selected = "selected";
                }
                $('#package').append('<option value="' + i + '" ' + selected + '>' + i + '=' + e + '</option>');
            })
        }
    </script>
@stop
