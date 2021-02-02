@extends('adminlte::page')

@section('title', 'Danh sách game')

@section('content_header')
    <h1 style="float: left">Danh sách game</h1>
    <a href="{{route('game.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Thêm game mới</a><br/><br/>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    @if (count($listGames) === 0)
        <p>Hiện không có game nào</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>Tên game</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                </tr>
                @foreach ($listGames as $game)
                    <tr>
                        <td>{{$game->name}}</td>
                        <td><img src="{{$game->thumb_image}}" class="img-circle" width="60px" height="60px" alt=""></td>
                        <td>{!! str_limit($game->description,100) !!}</td>
                        <td><a href="{{route('game.edit',$game->id)}}" class="btn btn-warning">Sửa</a>
                            <form action="{{route('game.destroy',$game->id)}}" style="display: inline-block;" method="POST">
                                @csrf
                                @method('DELETE')
                                <span class="btn btn-danger delete">Xóa</span>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif

@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.delete').on('click', function () {
                let result = confirm("Bạn có chắc muốn xóa!");
                if (result === true) {
                    $(this).closest('form').submit()
                }
            })
        })
    </script>
@stop