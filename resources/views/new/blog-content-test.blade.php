@extends('new/header', ['blogGame' => $blogGame, 'description' => $content])
@section('content')
    {!! ($content->content) !!}

    <div class="suggestion-control">
        <div class="title-s1">Suggestion</div>
        <div>
            <div class="suggestion-pre"> </div>
            <div class="suggestion-next"></div>
        </div>
    </div>
    <div id="suggestion" class="suggestion">
        @foreach($relevancies as $relateBlog)
            <a href="{{route('blog-game-title', $relateBlog['slug'])}}">
                <div class="suggestion-item">
                    <img src="{{ $relateBlog['thumb_image'] }}">
                    <div class="title-s1">{{ ($relateBlog['title']) }}</div>
                </div>
            </a>
        @endforeach
    </div>
<script>
    $('.icon-caret').click(function () {
        $(this).toggleClass("rotate")
        element = $(this).parent().parent();
        element.children()[1].classList.toggle("show");
    });
    $('.menu-icon').click(function () {
        $(this).toggleClass("rotate");
        $('.menu-wrapper').toggleClass('hide')
    });
    $('.icon-close-menu').click(function () {
        $('.menu-wrapper').toggleClass('hide')
    });
    $('.show-video').click(function () {
        $('.video-wrapper').toggleClass('hide')
    });
    $('.close-video').click(function () {
        $('.video-wrapper').toggleClass('hide')
        $('.iframe-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
    });
    $('.suggestion-pre').click(function () {
        let widthSuggestion = '-=' + String($('#suggestion').width() - 60);
        $('#suggestion').animate({ scrollLeft: widthSuggestion }, 1000);
    });
    $('.suggestion-next').click(function () {
        let widthSuggestion = '+=' + String($('#suggestion').width() - 60);
        $('#suggestion').animate({ scrollLeft: widthSuggestion }, 1000);
    });

</script>
@endsection

