<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $head_tags ?  $head_tags->head_title : $post->title)
    @section('description', $head_tags ?  $head_tags->head_description : '')
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
                    <div  class="like-icon" style="font-size: 16px; float:right; color: #9e9e9e">
                        <label for="like-post" class="like-post" data-id="{{$post->id}}">
                            <i id="like-icon" class="material-icons e8dc">thumb_up</i>
                            <span class="like-count">{{$post->like_post->like_count}}</span>
                        </label>
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
            $(document).on('click','.like-post',function(){
                var postId = $(this).attr('data-id');
                var userId = {{$user_login}};
                var vm=$(this);
                // Run Ajax
                $.ajax({
                    url:"{{ url('like') }}",
                    type:"post",
                    // dataType:'json',
                    data:{
                        post_id:postId,
                        user_id:userId,
                        _token:"{{ csrf_token() }}"
                    },
                    success:function(res){
                        var class_name = 'liked-icon';
                        if(res.bool==="Like"){
                            document.getElementById("like-icon").classList.add(class_name);
                            var _prevCount=$(".like-count").text();
                            _prevCount++;
                            $(".like-count").text(_prevCount);
                        } else {
                            document.getElementById("like-icon").classList.remove(class_name);
                            var _prevCount=$(".like-count").text();
                            _prevCount--;
                            $(".like-count").text(_prevCount);
                        }
                    }
                });
            });
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
