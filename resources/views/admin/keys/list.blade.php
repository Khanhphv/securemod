@extends('adminlte::page')

@section('title', 'List key')

@section('content_header')
    <h1 style="float: left">List key</h1>
    <a href="{{route('key.create')}}" class="btn btn-block btn-success pull-right" style="max-width: 200px">Add new key</a><br/><br/>
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
                        <td><a href="{{route('key.edit',$key->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('key.delete',$key->id)}}" class="btn btn-danger" >Xóa</a>
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
