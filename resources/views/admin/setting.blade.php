{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>System Interface Settings</h1>
@stop

@section('content')
    @include('admin.success')
    <!-- change icon web system -->
    <div class="box-body">
        <div class="change_logo">
            {!! Form::open([
                'route' => ['setting_system_edit'],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal row',
            ]) !!}
                <div class="content">
                    <ul>
                        <li style="list-style: none;"><h3>Change logo mini</h3></li>
                        <li style="list-style: none;">
                            {!! Html::image(
                                '/images/logo/logo_mini.png',
                                'Logo Mini',
                                [
                                    'id' => 'logo_mini',
                                    'class' => 'img img-thumbnail img-responsive',
                                    'width' => 150
                                ]
                            ) !!}
                        </li>
                        <li style="list-style: none; margin-top: 5px">
                            {!! html_entity_decode(
                                Form::label(
                                    'file_upload_logo_mini',
                                    '<i class="fa fa-cloud-upload"></i> ' . 'Change logo mini'
                                    ,
                                    [
                                        'class' => 'custom-file-upload',
                                    ]
                                )
                            ) !!}
                            {!! Form::file(
                                'logo_mini',
                                [
                                    'id' => 'file_upload_logo_mini',
                                    'accept' => 'image/*',
                                ]
                            ) !!}
                        </li>
                        <li style="list-style: none;">
                            <p id="file_name_logo_mini"></p>
                        </li>
                    </ul>
                </div>

                <div class="content">
                    <ul>
                        <li style="list-style: none;"><h3>Change logo</h3></li>
                        <li style="list-style: none;">
                            {!! Html::image(
                                '/images/logo/logo.png',
                                'Logo Mini',
                                [
                                    'id' => 'logo_text',
                                    'class' => 'img img-thumbnail img-responsive',
                                    'width' => 400
                                ]
                            ) !!}
                        </li>
                        <li style="list-style: none; margin-top: 5px">
                            {!! html_entity_decode(
                                Form::label(
                                    'file-upload',
                                    '<i class="fa fa-cloud-upload"></i> ' . 'Change logo'
                                    ,
                                    [
                                        'class' => 'custom-file-upload',
                                    ]
                                )
                            ) !!}
                            {!! Form::file(
                                'logo',
                                [
                                    'id' => 'file_upload_logo_text',
                                    'accept' => 'image/*',
                                ]
                            ) !!}
                        </li>
                        <li style="list-style: none;">
                            <p id="file_name_logo_text"></p>
                        </li>
                    </ul>
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-md-offset-3">
                        {!! Form::submit(
                            'Update',
                            [
                                'class' => 'btn btn-success',
                            ]
                        ) !!}
                        {!! Html::linkRoute(
                            'setting_system',
                            'Cancel',
                            [],
                            [
                                'class' => 'btn btn-warning',
                            ]
                        ) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

        function previewImage($file_upload, $image, $file) {
            console.log('#'+ $image)
            document.querySelector('#'+ $file_upload).onchange = function(){loadFile(event)};              
                var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById($image);
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };

            $(document).ready(function(e){
                $('#'+ $file_upload).change(function(e){
                    var filename = $('#'+$file_upload).val().toString();
                    if (filename.substring(3,11) == 'fakepath') {
                        filename = filename.substring(12);
                    }
                    $('#'.$file).text(filename);
                })
            })
        }
        previewImage('file_upload_logo_mini', 'logo_mini', 'file_name_logo_mini')
        previewImage('file_upload_logo_text', 'logo_text', 'file_name_logo_text')
    </script>
@stop

