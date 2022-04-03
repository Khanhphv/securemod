<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', isset($head_tags) ?  $head_tags->head_title : $content->title ?? '')
    @section('description', isset($head_tags) ?  $head_tags->head_description : '')
    @include('new.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: block">
        <div class="row blog-content">
            @if (Auth::check() && Auth::user()->type == "admin")
                <div class="content">
                    @if (isset($content))
                        {!! html_entity_decode(
                        Html::linkRoute(
                            'post.edit',
                            '<i class="material-icons e3c9">edit</i>  Edit Terms of Service',
                            [
                                'post' => $content,
                            ],
                            [
                                'class' => 'btn btn-warning',
                                'style' => 'float:right;  font-size: 16px'
                            ]
                        )
                    )
                    !!}
                    @endif
                </div>
            @endif

            <div class="col s12 m12 head-link">
                <a href="/post"><label>Hacking News</label></a>
                <i class="material-icons dp48">chevron_right</i>
                <a href="">
                    <label for="">{{ $content->title ?? '' }}</label>
                </a>
            </div>
            <div class="col s12 m12 blog-title">
                <h1>{{ $content->title ?? '' }}</h1>
                <label>
                    <i style="font-size: inherit" class="material-icons dp48">access_time</i>
                    {{ $content->created_at ?? '' }}
                </label>
            </div>
            <div class="col s12 m12">
                {!! $content->content ?? '' !!}
            </div>
        </div>
    </div>
@endsection
</body>
</html>


