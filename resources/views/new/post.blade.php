<!doctype html>
<html lang="en">
<head>
@extends('new.header')
@section('headerTitle', 'Post')
@include('new.style')
</head>
<body>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white blog-content">
            <div class="col s12 m12 blog-title">
                <h1>Terms of Service and Refund Policy</h1>
                <label>
                    <i style="font-size: inherit" class="material-icons dp48">access_time</i>
{{--                    {{ $content->created_at }}--}}
                    cess_time 2020-03-05 23:59:34
                </label>
            </div>
            <div class="col s12 m12">
{{--                {!! $content->content !!}--}}
                The following terms of service (the "Agreement") govern all use of all services and products available at or through Securecheats (the "Site"), including, but not limited to, website features such as the forum and user registration, and the products featured. The Site is operated by Securecheats
            </div>
        </div>
    </div>
@endsection
</body>
</html>

