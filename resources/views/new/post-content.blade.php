<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $post->title)
    @include('new.post-style')
</head>
<body>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white blog-content">
{{--            Post content--}}
            <div class="blog-title">
{{--                Title--}}
                <h1 class="mt4 text-primary">{{ $post->title }}</h1>
                <div>
                    @foreach ($post->tag as $singleTag)
                        <span class="label-tag">{{ $singleTag->name }}</span>
                    @endforeach
                </div>
                <label>
                    <i style="font-size: inherit" class="material-icons dp48">access_time</i>
                    {{ $post->created_at }}
                </label>
                <label class="m-3" style="float:right;  font-size: 16px">
                    <i class="material-icons e417">remove_red_eye</i>
                    {{ $post->view }}
                </label>
                <div class="m-3" style="font-size: 16px; float:right; color:#0d4dff;" onclick="actOnChirp('{{ $post->id }}')">
                    <i class="material-icons e8dc">thumb_up</i>
                    {{ $post->like_post ? $post->like_post->like_count : 0 }}
                </div>
            </div>
            <div class="col-lg-10 mx-auto">
                <div class="my-4">
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
@endsection
</body>
</html>

@section('js')
    <script>
        function actOnChirp(id) {
            window.location.href = '/post/' +id;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
@stop
