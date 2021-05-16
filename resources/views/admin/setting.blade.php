{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Master Site Settings</h1>
@stop

@section('content')
    @include('layouts.success')
    <!-- change icon web system -->
    <div class="content">
        <div>
            {!! Form::open([
                'route' => ['setting_system_edit'],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal row',
            ]) !!}
                <div class="col-md-4">
{{--                    change logo--}}
                    <div class="box box-primary">
                        <div class="box-body">
                            <label>Change Logo System</label>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'file_upload_logo_mini',
                                                    '<i class="fa fa-cloud-upload"></i> ' . 'Logo mini'
                                                    ,
                                                    [
                                                        'class' => 'custom-file-upload',
                                                    ]
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-8 col-xs-12">
                                            {!! Form::file(
                                                'logo_mini',
                                                [
                                                    'id' => 'file_upload_logo_mini',
                                                    'accept' => 'image/*',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'file-upload',
                                                    '<i class="fa fa-cloud-upload"></i> ' . 'Text logo'
                                                    ,
                                                    [
                                                        'class' => 'custom-file-upload',
                                                    ]
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-8 col-xs-12">
                                            {!! Form::file(
                                                'text_logo',
                                                [
                                                    'id' => 'file_upload_logo_text',
                                                    'accept' => 'image/*',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'file-upload',
                                                    '<i class="fa fa-cloud-upload"></i> ' . 'Favicon'
                                                    ,
                                                    [
                                                        'class' => 'custom-file-upload',
                                                    ]
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-8 col-xs-12">
                                            {!! Form::file(
                                                'fav_icon',
                                                [
                                                    'id' => 'file_upload_favicon',
                                                    'accept' => 'image/*',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            <label>Change Footer System</label>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'about_us',
                                                    '<i class="fa fa-info-circle"></i> ' . 'About Us'
                                                    ,
                                                    [

                                                    ]
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-10 col-xs-12">
                                            {!! Form::textarea(
                                                'about_us',
                                                $settings['about_us'],
                                                [
                                                    'class' => 'form-control',
                                                    'rows' => 3,
                                                    'placeholder' => 'About Us',
                                                    'required' => 'required',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'for_support',
                                                    '<i class="fa fa-envelope"></i> ' . 'For Support',
                                                    []
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-10 col-xs-12">
                                            {!! Form::email(
                                                'for_support',
                                                $settings['for_support'],
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'For Support',
                                                    'required' => 'required',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'verified_seller_url',
                                                    '<i class="fa fa-info-circle"></i> ' . 'Verified Seller URl',
                                                    []
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-10 col-xs-12">
                                            {!! Form::text(
                                                'verified_seller_url',
                                                $settings['verified_seller_url'],
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Verified Seller URl',
                                                    'required' => 'required',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            {!! html_entity_decode(
                                                Form::label(
                                                    'file-upload',
                                                    '<i class="fa fa-cloud-upload"></i> ' . 'Verified Seller Logo'
                                                    ,
                                                    [
                                                        'class' => 'custom-file-upload',
                                                    ]
                                                )
                                            ) !!}
                                        </div>
                                        <div class="col-md-8 col-xs-12">
                                            {!! Form::file(
                                                'verified_seller_logo',
                                                [
                                                    'id' => 'file_upload_verified_seller_logo',
                                                    'accept' => 'image/*',
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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

