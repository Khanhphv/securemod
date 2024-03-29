<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $content->title)
    @include('new.style')
</head>
<body>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white blog-content">
            <div class="col s12 m12 head-link">
                <a href="/blogs"><label>Hacking News</label></a>
                <i class="material-icons dp48">chevron_right</i>
                <a href="">
                    <label for="">{{ $content->title }}</label>
                </a>

            </div>
            <div class="col s12 m12 blog-title">
                <h1>{{ $content->title }}</h1>
                <label>
                    <i style="font-size: inherit" class="material-icons dp48">access_time</i>
                    {{ $content->created_at }}
                </label>
            </div>
            <div class="col s12 m12">
                {!! $content->content !!}
            </div>
        </div>
    </div>
@endsection
</body>
</html>


