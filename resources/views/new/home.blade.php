<!DOCTYPE html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $head_tags ?  $head_tags->head_title : 'Home')
    @section('description', $head_tags ?  $head_tags->head_description : '')
    <meta charset="UTF-8">
    <meta name="description" content="provide the ultimate secure private cheats, experimenting and implementing AI into our cheats to keep you hidden and trick any anti-cheat software out there. Keeping your account clean and undetected was our priority when developing this cheat, and it will always be going forward into updating it. With protection against the most popular anti-cheat software's like VAC, Fairfight, Easy Anti-cheat, and most notoriously Battleye and FACEIT Anti-cheat... You can be sure that you're always safe while using our products.">
    <meta name="keywords" content="YOUR SECURITY IS OUR PRIORITY, hack, cheats">
    @include('new.style')
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/cd9d9d634b0434b043fd644ef/0cff08fc814719677ff41187b.js");</script>
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
    @extends('new.master-layout')
    @section('content')
        <div class="tab-name mobile">
            <div onclick="getAllGames(event)" class="active">
                All Game
            </div>
            <div onclick="getRattingGames(event)">
                Rating
            </div>
            <div onclick="getTrendGames(event)">
                Trending
            </div>
           
        </div>
        <div class="tab-content mobile">
            @if(isset($games) && count($games) > 0)
                @foreach($games as $game)
                    @include('v2.card', ['game' => $game])
                @endforeach
            @endif
        </div>
    @endsection
    @section('script')
    <script>
        const height = $('.tab-content').height() + 50
        const games = $('.tab-content').children().toArray();
        function getAllGames(event) {
            toggleActiveClass(event);
            showContent(games)
        }
        function getNewGames(event) {
            toggleActiveClass(event);
            let newGames = [...games].sort(function(a,b){
                let a_date = new Date($(a).find('.created_at').html());
                let b_date = new Date($(b).find('.created_at').html());
                return b_date - a_date
            });
            showContent(newGames)
        }
        function getRattingGames(event) {
            toggleActiveClass(event);
            let newGames = [...games].sort(function(a,b){
                let a_date = ($(a).find('.ratting').html());
                let b_date = ($(b).find('.ratting').html());
                return b_date - a_date
            });
            showContent(newGames)
        }
        function getTrendGames(event) {
            toggleActiveClass(event);
            let newGames = [...games].sort(function(a,b){
                let a_date = ($(a).find('.views').html());
                let b_date = ($(b).find('.views').html());
                return b_date - a_date
            });
            showContent(newGames)
        }
        function toggleActiveClass(event) {
            $('.tab-content').css('min-height', height)
            $('.tab-content').hide()
            $('.tab-name .active').removeClass('active')
            $(event.target).toggleClass('active')
        }
        function showContent(newGames) {
            $('.tab-content').empty();
            newGames.forEach(e =>{
                $('.tab-content').append(e.outerHTML);
            })
            $('.tab-content').show(300)


        }
        function redirectToSpecificGame(id) {
            window.location.href = '/game/' +id;
        }
    </script>
    @endsection
    @include('new.popup')
</body>
</html>



