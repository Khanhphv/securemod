<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $head_tags ?  $head_tags->head_title : $post->title)
    @section('description', $head_tags ?  $head_tags->head_description : '')
    @include('new.style')
    <style>
        pre {
            white-space: pre-wrap;
            word-break: break-all;
        }
        /* lg */
        @media (min-width: 1200px) {
            .img-fluid {
                height:412px;
                width:1270px;
            }
        }
    </style>
</head>
<body>
@extends('new.master-layout')
@section('content')
<main class="container">
    <div class="text-center">
        <img src="{{$post->thumbnail}}" class="img-fluid" alt="Responsive image" style="overflow: hidden;object-fit: cover;border-radius: 8px;">
    </div>
    <div class="container py-4">
        <div class="py-3">
        @auth()
        <label for="like-post" class="like-post btn btn-outline-light" data-id="{{$post->id ?? ''}}">
            <i id="like-icon" class="bi bi-stars"></i>
            <span class="like-count" id="like-text">Add to liked list</span>
        </label>
        @endauth
        </div>
        <h3>{{ $post->title }} <span class="lead text-muted">by <u>{{$author}}</u></span></h3>
        <p class="lead text-muted">Published: {{ $post->created_at }}</p>
        <div >
            <i class="bi bi-eye-fill text-muted"></i>
            <small class="text-muted">&nbsp; {{ $post->view }} &nbsp;</small>
            <i class="bi bi-heart-fill text-muted"></i>
            <small class="text-muted">&nbsp; {{ $post->like_post ? $post->like_post->like_count : 0 }}</small>
        </div>
        <div class="py-4">
        @foreach ($post->tag as $singleTag)
            <div class="badge bg-light text-dark p-2">{{ $singleTag->name }}</div>
        @endforeach
        </div>
        <div id="detail-post">
        {!! $post->content !!}
    </div>
    </div>

    
    
  </main>
    <script>
        var class_name = 'liked-icon';
        if({{$is_like}}){
            document.getElementById("like-icon").classList.add(class_name);
            document.getElementById("like-text").innerText = 'Remove from liked list'
        }
    </script>
    <script>
        window.addEventListener('load', function() {
            // add class for image in post content
            $('#detail-post').find('img').addClass('responsive-img')

            // action like and dislike
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
                            $(".like-count").text('Liked');
                        } else {
                            document.getElementById("like-icon").classList.remove(class_name);
                            var _prevCount=$(".like-count").text();
                            _prevCount--;
                            $(".like-count").text('Unliked');
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
