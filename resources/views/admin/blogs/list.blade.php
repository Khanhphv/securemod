@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1 style="float: left">Posts</h1>
    <a href="{{route('blog.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Add new post</a><br/><br/>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    @if (count($blogs) === 0)
        <p>There are no post</p>
    @else
        <div class="table-responsive">
        <table class="table table-hover" style="background: #FFF">
            <tr>
                <th>ID</th>
				<th>Game</th>
				<th>Author</th>
                <th>Title</th>
                <th>Last update</th>
                <th>Action</th>
            </tr>
            @foreach ($blogs as $blog)
                <tr>
					<td><strong>{{$blog->id}}</strong></td>
					<td><strong>{{$blog->game_name}}</strong></td>
					<td>{{$blog->user_name}}</td>
					<td>{{$blog->title}}</td>
					<td>{{$blog->updated_at}}</td>
                    <td><a href="{{route('blog.edit',$blog->id)}}" class="btn btn-warning">Edit</a>
                        <a href="{{route('blog.delete',$blog->id)}}" onclick="return confirm('Do you want to delete post: {{$blog->name}}')" class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    @endif

@stop
