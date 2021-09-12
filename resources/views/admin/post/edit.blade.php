@extends('adminlte::page')

@section('title', 'Add new post')

@section('content_header')
    <h1>Edit post</h1>
@stop

@section('content')
    @include('layouts.success')

    {{--    validate--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="content">
        {!! Form::open([
            'route' => ['post.update', $post->id],
            'method' => 'PUT',
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal',
        ]) !!}
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'title',
                    'Title',
                    []
                )
            ) !!}
            {!! Form::text(
                'title',
                $post['title'],
                [
                    'id' => 'title',
                    'class' => 'form-control',
                    'placeholder' => 'How to use ...',
                    'required' => 'required',
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'path_url',
                    'Path URL',
                    []
                )
            ) !!}
            {!! Form::text(
                'slug',
                $post['slug'],
                [
                    'id' => 'slug',
                    'class' => 'form-control',
                    'placeholder' => 'path-url',
                    'required' => 'required',
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'header_title',
                    'Header Title',
                    []
                )
            ) !!}
            {!! Form::text(
                'header_title',
                $head_tags ? $head_tags->head_title : "",
                [
                    'id' => 'header_title',
                    'class' => 'form-control',
                    'placeholder' => 'Changing the title in the Browser Tab ...',
                    'required' => 'required',
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'header_description',
                    'Header Description',
                    []
                )
            ) !!}
            {!! Form::text(
                'header_description',
                $head_tags ? $head_tags->head_description : "",
                [
                    'id' => 'header_description',
                    'class' => 'form-control',
                    'placeholder' => 'Define a description of your web page ...',
                    'required' => 'required',
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'thumbnail',
                    'Thumbnail image',
                    []
                )
            ) !!}
            {!! Form::text(
                'thumbnail',
                $post['thumbnail'],
                [
                    'id' => 'thumbnail',
                    'class' => 'form-control',
                    'placeholder' => 'http://link_to_image.jpg',
                    'required' => 'required'
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'content',
                    'Content',
                    []
                )
            ) !!}
            {!! Form::textarea(
                'content',
                $post['content'],
                [
                    'id' => 'editor1',
                    'class' => 'form-control',
                    'placeholder' => 'Enter a content',
                    'required' => 'required',
                    'rows' => 15
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! Form::label(
                 'tag',
                 'Tags',
                  [
                      'class' => 'control-label'
                  ]
            ) !!}
            <button type="button" class="btn btn-primary btn-xs" id="selectbtn-tag">
                Select all
            </button>
            <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-tag">
                Deselect all
            </button>
            {!! Form::select(
                  'tag[]',
                   $tags,
                   old('tag')? old('tag') : $post->tag->pluck('id')->toArray(),
                   [
                       'class' => 'form-control select2',
                        'multiple' => 'multiple',
                         'id' => 'selectall-tag'
                   ]
            ) !!}
            <p class="help-block"></p>
            @if($errors->has('tag'))
                <p class="help-block">
                    {{ $errors->first('tag') }}
                </p>
            @endif
        </div>
        <div class="form-group">
            {!! Form::submit(
                            'Update',
                            [
                                'class' => 'btn btn-success',
                            ]
                        ) !!}
            {!! Html::linkRoute(
                'post.index',
                'Cancel',
                [],
                [
                    'class' => 'btn btn-warning',
                ]
            ) !!}
        </div>
    </div>
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

    {{--    select tags--}}
    <script>
        $("#selectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","selected");
            $("#selectall-tag").trigger("change");
        });
        $("#deselectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","");
            $("#selectall-tag").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

@stop
