@extends('adminlte::page')

@section('title', 'Danh sách Tool')

@section('content_header')
    <h1 style="float: left">Kết quả lọc</h1>
    <a href="{{route('key.create')}}" class="btn btn-block btn-success pull-right" style="max-width: 200px">Thêm key
        mới</a><br/><br/>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    <form role="form" class="form-horizontal" action="{{route('key.search')}}" method="GET">

        <div class="form-group">
            <div class="col-sm-6"><input type="text" class="form-control" placeholder="Nhập key vào đây" name="key"
                                         value="{{isset(request()->key)? request()->key: null}}">
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="tool" name="toolID">
                    @php
                        $packagesList = array();
                    @endphp
                    <option value="0">-- Chọn tool --</option>
                    @foreach($tools as $tool)
                        <option value="{{$tool->id}}" @if (request()->toolID == $tool->id) {{ 'selected' }} @endif>{{$tool->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" placeholder="ID người dùng" name="userID"
                       value="{{isset(request()->userID)? request()->userID: null}}">
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success form-control" type="submit">Tìm kiếm</button>
                <br><br>
                <button class="btn btn-danger form-control" type="button" onclick="Export()">Xuất key</button>
            </div>
        </div>
    </form>

    @if (count($listKeys) == 0)
        <div>Hiện không có key nào</div>
    @else
        <div class="table-responsive">
        <table class="table table-hover" style="background: #FFF" id="result">
            <tr>
                <th>STT</th>
                <th>Loại tool</th>
                <th>Gói</th>
                <th>Key</th>
                <th>ID User</th>
                <th>Thao tác</th>
            </tr>
            @foreach ($listKeys as $key)
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
                    <td><a href="{{route('key.edit',$key->id)}}" class="btn btn-warning">Sửa</a>
                        {{--<a href="{{route('tool.ajax',$tool->id)}}" class="btn btn-danger" >Xóa</a>--}}
                    </td>
                </tr>
            @endforeach
            {!! $listKeys->render() !!}
        </table>
        </div>
    @endif

@stop
@section('js')
    <script src="/js/jquery.table2excel.js"></script>
    <script>
        function Export() {
            $("#result").table2excel({
                exclude: ".noExl",
                name: "Keys_{{ \Carbon\Carbon::now() }}",
                filename: "Keys_{{ \Carbon\Carbon::now() }}",
                fileext: ".xls"
            });
        }
    </script>
@endsection
