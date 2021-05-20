@extends('adminlte::page')

@section('title', 'Add new post')

@section('content_header')
    <h1>Add new post</h1>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

@stop

@section('content')
    <form action="{{route('blog.store')}}" method="post" role="form">
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
            <label for="game">Choose game</label>
            <select class="form-control" id="game" required name="game_id">
                @if(count($games) > 0)
                    @foreach($games as $game)
                        <option value="{{$game->id}}">{{$game->name}}</option>
                    @endforeach
                @else
                    <option value="null">-- There are no game to select</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="How to use ..." required>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail image</label>
            <input type="text" class="form-control" name="thumbnail" id="thumbnail" placeholder="http://link_to_image.jpg" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="editor1" name="content" rows="20" class="form-control my-editor" placeholder="Enter a content">{{ old('content') }}</textarea>
        </div>
        <br>
        @if(count($games) > 0)
            <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
            <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
        @else
            <h3>Vui lòng thêm game trước!</h3>
        @endif
    </form>
@stop

@section('js')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script type="text/javascript" >
        var options = {
            height: 500,
            extraPlugins: 'codesnippet',
            codeSnippet_theme: 'monokai_sublime',
        };
        CKEDITOR.replace('editor1', options);

    </script>

@stop
