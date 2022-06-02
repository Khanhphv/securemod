@extends('adminlte::page')

@section('title', 'Game list')

@section('content_header')
    <h1 style="float: left">Game list</h1>
    <a href="{{route('game.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Add new game</a><br/><br/>
    @if(request()->has('view_deleted'))
            <a href="{{route('game.index')}}" type="button" class="btn btn-block btn-warning pull-right"
            style="max-width: 200px">Show available games</a><br/><br/>
        @else
            <a href="{{route('game.index', ['view_deleted' => 'DeletedRecords'])}}" type="button" class="btn btn-block btn-warning pull-right"
        style="max-width: 200px">Show trashed games</a><br/><br/>
    @endif
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    @if (count($listGames) === 0)
        <p>No game</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @foreach ($listGames as $game)
                    <tr>
                        <td>{{$game->name}}</td>
                        <td><img src="{{$game->thumb_image}}" class="img-circle" width="60px" height="60px" alt=""></td>
                        <td>{!! \Illuminate\Support\Str::limit($game->description,100) !!}</td>
                        <td>                            
                            @if(request()->has('view_deleted'))
                                    <a href="{{route('game.restore',$game->id)}}" class="btn btn-warning">Restore</a>
                                    <a href="{{route('game.forcedelete',$game->id)}}" class="btn btn-danger delete">Force Delete</a>
                                @else
                                    <a href="{{route('game.edit',$game->id)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{route('game.delete',$game->id)}}" class="btn btn-danger" >Move to trash</a>
                            @endif
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
                let result = confirm("Do you want delete this game ?");
                if (result === true) {
                    $(this).closest('form').submit()
                }
            })
        })
    </script>
@stop
