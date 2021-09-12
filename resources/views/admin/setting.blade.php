{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Master Site Settings</h1>
@stop

@section('content')
    @include('layouts.success')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                                                'favicon',
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
                                                    []
                                                )
                                            ) !!}
                                        </div>
                                        @if (isset($settings['about_us']))
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
                                        @endif
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
                                        @if(isset($settings['for_support']))
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
                                        @endif

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
                                        @if (isset($settings['verified_seller_url']))
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
                                        @endif
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
        <div class="mt-3">
            <br/>
        </div>
        {{--change head tags--}}
        <div class="col-md">
            {!! Form::open([
                'route' => ['edit_head'],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal',
            ]) !!}
            <div class="box box-primary">
                <div class="box-body">
                    <label>Setting Meta Tag</label>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'select_page_type',
                                            'Select page type'
                                            ,
                                            [
                                                'style' => 'margin-top: 5px'
                                            ]
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    {!!
                                       Form::select(
                                           'type',
                                            [
                                                'welcome' => 'Welcome',
                                                'home' => 'Home',
                                                'list_post' => 'List Post'
                                            ],
                                            'welcome',
                                            [
                                                'id' => 'type_select',
                                                'class' => 'form-control'
                                            ]
                                       )
                                    !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'head_title',
                                            'Header Title',
                                            ['style' => 'margin-top: 5px']
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md-10 col-xs-12">
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
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'head_description',
                                            'Header Description',
                                            ['style' => 'margin-top: 5px']
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md-10 col-xs-12">
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
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 col-md-offset-5">
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
    </script>
@stop

