<!doctype html>
<html lang="en">
<head>
@extends('new.header')
@section('headerTitle', $head_tags ?  $head_tags->head_title : 'Post')
@section('description', $head_tags ?  $head_tags->head_description : '')
@include('new.style')
</head>
<body>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white blog-content">
            <div class="blog-title" style="text-align: center">
                <h3>
                    LATEST NEWS
                </h3>
            </div>
            <div>
                <div class="row">
                    <div class="post-block mobile">
                        @foreach($posts->chunk(4) as $post_row)
                        <div>
                            <div>
                                @foreach($post_row as $post)

                                    <div class="item" onclick="redirectToSpecificPost('{{ $post->id }}')" style="background-image: url('{{ $post->thumbnail }}'); background-position: inherit">
                                        <div>
                                            <p>{{ $post->title }}</p>
                                            <span>{{ $post->user_name }}</span>
                                            <div>
                                                <div>
                                                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                                        <path
                                                            d="M8,3 C10.6729538,3 13.3396205,4.66666667 16,8 C13.3461529,11.3333333 10.681235,13 8.00524656,13 C5.32925808,13 2.66084256,11.3333333 -1.77635684e-15,8 C2.66037955,4.66666667 5.32704621,3 8,3 Z M8,10.5 C9.38071187,10.5 10.5,9.38071187 10.5,8 C10.5,6.61928813 9.38071187,5.5 8,5.5 C6.61928813,5.5 5.5,6.61928813 5.5,8 C5.5,9.38071187 6.61928813,10.5 8,10.5 Z"
                                                            id="Combined-Shape" fill="#FFFFFF" />
                                                    </svg>
                                                    <div class="space-20px"></div>
                                                    {{ $post->view }}
                                                </div>
                                                <div>
                                                    <div class="right-align">
                                                        <span>
                                                            Like: {{ $post->like_post ? $post->like_post->like_count : 0 }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagi right-align">
                        <ul class="pagination">
                            {{--Previous Page--}}
                            @if ($posts->onFirstPage())
                            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                            @else
                                <li class="waves-effect"><a href="{{ $posts->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                            @endif
                            {{--Page Number--}}
                            @for($i=1; $i<=$posts->lastPage(); $i++)
                                @if($i==$posts->currentPage())
                                    <li class="active"><a href="?page={{$i}}">{{$i}}</a></li>
                                @else
                                    <li class="waves-effect"><a href="?page={{$i}}">{{$i}}</a></li>
                                @endif
                            @endfor
                            {{-- Next Page Link --}}
                            @if ($posts->hasMorePages())
                                <li class="waves-effect"><a href="{{ $posts->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                            @else
                                <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function redirectToSpecificPost(id) {
        window.location.href = '/post/' +id;
    }
</script>
</body>
</html>


