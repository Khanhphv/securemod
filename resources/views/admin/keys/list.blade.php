@extends('adminlte::page')

@section('title', 'List key')

@section('content_header')
    <h1 style="float: left">List key</h1>
    <a href="{{route('key.create')}}" class="btn btn-block btn-success pull-right" style="max-width: 200px">Add new key</a><br/><br/>
    @if(request()->has('view_deleted'))
            <a href="{{route('key.index')}}" type="button" class="btn btn-block btn-warning pull-right"
            style="max-width: 200px">Show available tools</a><br/><br/>
        @else
            <a href="{{route('key.index', ['view_deleted' => 'DeletedRecords'])}}" type="button" class="btn btn-block btn-warning pull-right"
        style="max-width: 200px">Show trashed tools</a><br/><br/>
        @endif
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    <form role="form" class="form-horizontal" action="{{route('key.search')}}" method="GET">

        <div class="form-group">
            <div class="col-sm-6"><input type="text" class="form-control" placeholder="Input key here" name="key"
                                         value="{{old('key',isset($request->key)? $request->key: null)}}">
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="tool" name="toolID">
                    @php
                        $packagesList = array();
                    @endphp
                    <option value="0">-- Select tool --</option>
                    @foreach($tools as $tool)
                        <option value="{{$tool->id}}" @if (old('toolID') == $tool->id) {{ 'selected' }} @endif>{{$tool->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" placeholder="ID user" name="userID"
                       value="{{ old('userID') }}">
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success form-control" type="submit">Search</button>
            </div>
        </div>
    </form>

    @if (count($listKeys) == 0)
        <div>No key found</div>
    @else
        <div class="table-responsive">
            {!!$listKeys->render()!!}
            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>Index</th>
                    <th>Tool</th>
                    <th>Package</th>
                    <th>Key</th>
                    <th>ID User</th>
                    <th>Added date</th>
                    <th>Action</th>
                </tr>
                @php
                $sortedlist = $listKeys->sortByDesc('created_at');
                @endphp
                @foreach ($sortedlist as $key)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @php
                                $oneTool = DB::table('tools')->where('id',$key->tool_id)->first();
                               if($oneTool != null)
                               {
                                   echo $oneTool->name;
                               }
                            @endphp
                        </td>
                        <td>{{$key->package}}</td>
                        <td>{{$key->key}}</td>
                        <td>{{$key->user_id}}</td>
                        <td>{{$key->created_at}}</td>
                        <td>
                            
                            @if(request()->has('view_deleted'))
                                    <a href="{{route('key.restore',$key->id)}}" class="btn btn-warning">Restore</a>
                                    <a href="{{route('key.forcedelete',$key->id)}}" class="btn btn-danger delete">Force Delete</a>
                                @else
                                    <a href="{{route('key.edit',$key->id)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{route('key.delete',$key->id)}}" class="btn btn-danger">Move to trash</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
        <div>
            {!!$listKeys->render()!!}
        </div>
    @endif
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.delete').on('click', function () {
                let result = confirm("Do you want delete this key ?");
                if (result === true) {
                    $(this).closest('form').submit()
                }
            })
        })
    </script>
@stop
