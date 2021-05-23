@extends('adminlte::page')

@section('title', 'Add new post')

@section('content_header')
    <h1>Add new post</h1>
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
            'route' => ['post.store'],
            'method' => 'POST',
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
                    old('title'),
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
                        'summary',
                        'Summary',
                        []
                    )
                ) !!}
                {!! Form::text(
                    'summary',
                    old('summary'),
                    [
                        'id' => 'summary',
                        'class' => 'form-control',
                        'placeholder' => 'Summary for the  post ...',
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
                    old('thumbnail'),
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
                    old('content'),
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
                       old('tag'),
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
                            'Create',
                            [
                                'class' => 'btn btn-success',
                            ]
                        ) !!}
            {!! Html::linkRoute(
                'post.create',
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
