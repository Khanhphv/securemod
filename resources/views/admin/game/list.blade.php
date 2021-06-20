@extends('adminlte::page')

@section('title', 'Game list')

@section('content_header')
    <h1 style="float: left">Game list</h1>
    <a href="{{route('game.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Add new game</a><br/><br/>
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
                        <td><a href="{{route('game.edit',$game->id)}}" class="btn btn-warning">Edit</a>
                            <form action="{{route('game.destroy',$game->id)}}" style="display: inline-block;" method="POST">
                                @csrf
                                @method('DELETE')
                                <span class="btn btn-danger delete">Delete</span>
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
                let result = confirm("Do you want delete this game ?");
                if (result === true) {
                    $(this).closest('form').submit()
                }
            })
        })
    </script>
@stop
