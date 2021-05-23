@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1 style="float: left">Posts</h1>
    <a href="{{route('post.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Add new post</a><br/><br/>
@stop

@section('content')
    @include('layouts.success')
    @if (count($posts) === 0)
        <p>There are no post</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover" style="background: #FFF">
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>Last update</th>
                    <th>Action</th>
                </tr>
                @foreach ($posts as $post)
                    <tr>
                        <td><strong>{{$post->id}}</strong></td>
                        <td>{{$post->user_name}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            @foreach ($post->tag as $singleTag)
                                <span class="label label-info label-many">{{ $singleTag->name }}</span>
                            @endforeach
                        </td>
                        <td>{{$post->updated_at}}</td>
                        <td>
{{--                            {!! html_entity_decode(--}}
{{--                                Html::linkRoute(--}}
{{--                                'post.edit',--}}
{{--                                '<i class="far fa-edit"></i>',--}}
{{--                                [--}}
{{--                                    'id' => $post->id,--}}
{{--                                ],--}}
{{--                                [--}}
{{--                                    'class' => 'btn btn-warning',--}}
{{--                                ]--}}
{{--                                )--}}
{{--                            )--}}
{{--                            !!}--}}
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('post.delete',$post->id)}}" onclick="return confirm('Do you want to delete post?" class="btn btn-danger" >Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif

@stop
