@extends('adminlte::page')

@section('title', 'Danh sách tool')

@section('content_header')
    <h1 style="float: left">Danh sách Tool</h1>
    <a href="{{route('tool.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Thêm loại tool mới</a><br/><br/>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    @if (count($tools) === 0)
        <p>Hiện không có tool nào</p>
    @else
        <div class="table-responsive">
        <table class="table table-hover" style="background: #FFF">
            <tr>
                <th>Tên Tool</th>
                <th>Đã update</th>
                <th>Đang kích hoạt</th>
                <th>Thứ tự sắp xếp</th>
                <th>Thao tác</th>
            </tr>
            @foreach ($listTool as $tool)
                <tr>
                    <td><strong>{{$tool->game_name}}</strong> - {{$tool->name}}</td>
                    <td>@if ($tool->updated === 1) <i class="fa fa-check-square"></i> Có @else <i
                                class="fa fa-close"></i> Không @endif</td>
                    <td>@if ($tool->active === 1) <i class="fa fa-check-square"></i> Có @else <i
                                class="fa fa-close"></i> Không @endif</td>
                    <td>{{$tool->order}}</td>
                    <td><a href="{{route('tool.edit',$tool->id)}}" class="btn btn-warning">Sửa</a>
                        <a href="{{route('tool.delete',$tool->id)}}" onclick="return confirm('XÓA TOOL {{$tool->name}} ĐỒNG NGHĨA VỚI VIỆC XÓA HẾT TOÀN BỘ KEY. HÀNH ĐỘNG NÀY CỰC KÌ NGUY HIỂM! SAU KHI ẤN OK SẼ KHÔNG THỂ PHÔI PHỤC ĐƯỢC NỮA')" class="btn btn-danger" >Xóa</a>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    @endif

@stop
