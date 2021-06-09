<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $post->header_title)
    @section('description', $post->header_description)
    @include('new.style')
</head>
<body>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white post-content">
{{--            Post content--}}
            <div class="post-title">
{{--                Title--}}
                <h1 class="mt-4" style="color: #0d4dff">{{ $post->title }}</h1>
                <div class="content">
                    @foreach ($post->tag as $singleTag)
                        <span class="label-tag">{{ $singleTag->name }}</span>
                    @endforeach
                </div>
                <div class="content">
                    <label>
                        <i style="font-size: inherit" class="material-icons dp48">access_time</i>
                        {{ $post->created_at }}
                    </label>
                    <label style="float:right;  font-size: 16px">
                        <i class="material-icons e417">remove_red_eye</i>
                        {{ $post->view }}
                    </label>
                    <div id="like-icon" class="like-icon" style="font-size: 16px; float:right; color: #9e9e9e">
                        {!! Form::open([
                                'route' => ['like',  $post->id, $user_login],
                                'method' => 'PUT',
                                'id' => 'like-post-' . $post->id,
                                'style' => 'display: none;',
                            ]) !!}

                        {!! Form::close() !!}
                        {!! html_entity_decode(
                            Html::link(
                                null,
                                '<i class="material-icons e8dc">thumb_up</i>'. $post->like_post->like_count,
                                [
                                    'class' => 'like-post',
                                    'data-id' => $post->id
                                ]
                            )
                        )
                        !!}
                    </div>
                </div>

            </div>
            <div class="col s10">
                <div class="post-image">
                    {!! html_entity_decode(
                        Html::image(
                            $post->thumbnail,
                            'Post Image',
                            [
                                'class' => 'img-fluid',
                            ]
                        )
                    ) !!}
                </div>
                <br/>
                <p>
                    {!! $post->content !!}
                </p>
                <br/>
                <hr/>
                {!! html_entity_decode(
                    Form::label(
                        'author',
                        'Post by: '.$author,
                        [
                            'class' => 'd-flex justify-content-end'
                        ]
                    )
                ) !!}
            </div>
        </div>
    </div>
    <script>
        var class_name = 'liked-icon';
        if({{$is_like}}){
            document.getElementById("like-icon").classList.add(class_name);
        }
    </script>
    <script>
        window.addEventListener('load', function() {
            $(document).ready(function() {
                var userId = {{$user_login}};
                $('.like-post').click(function() {
                    event.preventDefault();
                    if (userId){
                        if({{$is_like}}){
                            if (confirm('Are you want to unlike this post?')) {
                                var postId = $(this).attr('data-id');
                                $("#like-post-" + postId).submit();
                            }
                        } else{
                            if (confirm('Are you want to like this post?')) {
                                var postId = $(this).attr('data-id');
                                $("#like-post-" + postId).submit();
                            }
                        }
                    } else {
                        alert('Login to continue');
                    }
                })
            })
        })
    </script>
@endsection
</body>
</html>

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
@stop
