@extends('adminlte::page')

@section('title', 'Add new game')

@section('content_header')
    <h1>Add new game</h1>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

@stop

@section('content')
    <form action="{{route('game.store')}}" method="post" role="form">
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
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" id="" placeholder="PUBG Mobile" required>
        </div>
        <div class="form-group">
            <label for="">Path</label>
            <input type="text" class="form-control" name="slug" id="" placeholder="pubg-mobile" required>
        </div>
        <div class="form-group">
            <label for="thumb_image">Picture</label>
            <input type="text" class="form-control" name="thumb_image" id="" placeholder="Nhập link ảnh online tại đây"
                   required>
        </div>

        <div class="form-group">
            <label for="description">Short description</label>
            <input id="description" name="description" class="form-control" value="{{ old('description') }}"/>
        </div>
        <div class="form-group">
            <label for="description_eng">Short description (English)</label>
            <input id="description_eng" name="description_eng" class="form-control"
                   value="{{ old('description_eng') }}"/>
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'head_title',
                    'Header Title',
                    []
                )
            ) !!}
            {!! Form::text(
                'head_title',
                old('head_title'),
                [
                    'id' => 'head_title',
                    'class' => 'form-control',
                    'placeholder' => 'Changing the title in the Browser Tab ...',
                    'required' => 'required',
                ]
            ) !!}
        </div>
        <div class="form-group">
            {!! html_entity_decode(
                Form::label(
                    'head_description',
                    'Header Description',
                    []
                )
            ) !!}
            {!! Form::text(
                'head_description',
                old('head_description'),
                [
                    'id' => 'head_description',
                    'class' => 'form-control',
                    'placeholder' => 'Define a description of your web page ...',
                    'required' => 'required',
                ]
            ) !!}
        </div>
        <div class="form-group">
            <label for="notice">Notice content</label>
            <textarea id="notice" name="notice" rows="10" class="form-control">{{ old('notice') }}</textarea>
        </div>
        <div class="form-group">
            <label for="notice_eng">Notice content (English)</label>
            <textarea id="notice_eng" name="notice_eng" rows="10"
                      class="form-control">{{ old('notice_eng') }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Sort</label>
            <input type="number" class="form-control" name="order" id="" value="1" required>
        </div>
        <br>

        <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
        <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
    </form>
@stop

@section('js')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>

        var editor_config = {
            path_absolute: "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | forecolor backcolor | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>

@stop
