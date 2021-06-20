@extends('adminlte::page')

@section('title', 'Edit tool')

@section('content_header')
    <h1>Edit tool {{$tool->name}}</h1>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

@stop

@section('content')
    <form action="{{route('tool.update', $tool->id)}}" method="post" role="form">
        @method('PUT')
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
            <label for="game">Game</label>
            <select class="form-control" id="game" required name="game_id">
                @if(count($games) > 0)
                    @foreach($games as $item)
                        <option value="{{$item->id}}" {{$item->id == $tool->game_id ? "selected" : ""}}>{{$item->name}}</option>
                    @endforeach
                @else
                    <option value="null">-- No game found</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="">Tool name</label>
            <input type="text" class="form-control" name="name" id=""
                   value="{{old('name',isset($tool->name)? $tool->name: null)}}" required>
        </div>
        <div class="form-group">
            <label for="">Note</label>
            <input type="text" class="form-control" name="note" id=""
                   value="{{old('note',isset($tool->note)? $tool->note: null)}}">
        </div>
        <div class="form-group">
            <label for="">Logo</label>
            <input type="text" class="form-control" name="logo" id=""
                   value="{{old('logo',isset($tool->logo)? $tool->logo: null)}}" required>
        </div>
        <div class="form-group">
            <label for="">Slide</label>
            <textarea type="text" class="form-control" name="images" id="images" required
                      placeholder="Mỗi link ảnh trên 1 dòng">{{old('images',isset($tool->images)? $tool->images: null)}}</textarea>
        </div>
        <div class="form-group">
            <label for="showcase">Video Intro</label>
            <input type="text" class="form-control" name="video_intro" id=""
                   value="{{old('video_intro',isset($tool->video_intro)? $tool->video_intro: null)}}">
        </div>
        <div class="form-group">
            <label for="">Download link</label>
            <input type="text" class="form-control" name="link" id="" required
                   value="{{old('link',isset($tool->link)? $tool->link: null)}}">
        </div>
        <div class="form-group">
            <label for="">Backup link</label>
            <input type="text" class="form-control" name="link_backup" id=""
                   value="{{old('link_backup',isset($tool->link_backup)? $tool->link_backup: null)}}">
        </div>
        <div class="form-group">
            <label for="cost">Tool input price (each pack 1 line written in the form 12=3000) </label>
            <textarea id="cost" name="cost" class="form-control"
                      rows="4">{{old('cost', isset($tool->cost)? $tool->cost: null)}}</textarea>
        </div>
        <div class="form-group">
            <label for="package">Packages of the tool (each pack 1 line written in the form 12=3000) </label>
            <textarea name="package" id="package" class="form-control"
                      rows="3">{{old('package', isset($tool->package)? $tool->package: null)}}</textarea>
        </div>

        <div class="form-group">
            <label for="discount">Discount(%)</label>
            <input type="number" class="form-control" name="discount" id="discount"
                   placeholder="Discount percent"
                   value="{{old('discount',isset($tool->discount)? $tool->discount: null)}}">
        </div>

        <div class="form-group">
            <label for="youtube">Usage link</label>
            <input type="text" class="form-control" name="youtube" id="" required
                   value="{{old('youtube',isset($tool->youtube)? $tool->youtube: null)}}">
        </div>



    <!--
		<div class="form-group">
            <label for="error_code">Các mã lỗi. Ví dụ: 01=Nội dung lỗi</label>
            <textarea id="error_code" name="error_code" class="form-control"
                      rows="4">{{old('error_code', isset($tool->error_code)? $tool->error_code: null)}}</textarea>
        </div>
		<div class="form-group">
            <label for="">Mô tả ngắn</label>
            <input type="text" class="form-control" name="description" id="" required
                   value="{{old('description',isset($tool->description)? $tool->description: null)}}">
        </div>
        <div class="form-group">
            <label for="">Mô tả ngắn (tiếng Anh)</label>
            <input type="text" class="form-control" name="description_eng" id=""
                   value="{{old('description_eng',isset($tool->description_eng)? $tool->description_eng: null)}}">
        </div>
        <div class="form-group">
            <label for="content">Hướng dẫn sử dụng</label>
            <textarea id="content" name="content" rows="10"
                      class="form-control my-editor">{{old('content', isset($tool)? $tool->content: null)}}</textarea>
        </div>
        <div class="form-group">
            <label for="content_eng">Hướng dẫn sử dụng (tiếng Anh)</label>
            <textarea id="content_eng" name="content_eng" rows="10"
                      class="form-control my-editor">{{old('content_eng', isset($tool)? $tool->content_eng: null)}}</textarea>
        </div>
		-->
        <div class="form-group">
            <label for="">Order number</label>
            <input type="number" class="form-control" name="order" id="" required
                   value="{{old('order',isset($tool->order)? $tool->order: null)}}">
        </div>
        <div class="form-group">
            <label for="">API get Key</label>
            <input type="text" class="form-control" name="api_get_key" id=""
                   value="{{old('api_get_key',isset($tool->api_get_key)? $tool->api_get_key: null)}}">
        </div>
        <div class="form-group">
            <label for="">Tool type</label>
            <select class="form-control" name="author">
                <option value="me" {{$tool->author == 'me' ? "selected" : ''}}>Owner</option>
                <option value="rent" {{$tool->author == 'rent' ? "selected" : ''}}>Hire</option>
            </select>
        </div>
        <div class="form-group">
            <div class="radio">
                <label><input type="checkbox" name="updated" {{($tool->updated == 1) ? "checked" : ""}}> Updated?</label>
            </div>
        </div>

        <div class="form-group">
            <div class="radio">
                <label><input type="checkbox" name="active" {{($tool->active == 1) ? "checked" : ""}}> Active?</label>
            </div>
        </div>
        <br>

        <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
        <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
    </form>
@stop

@section('js')
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>

        var editor_config = {
            path_absolute: "/",
            selector: ".my-editor",
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
