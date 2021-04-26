<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <link rel="shortcut icon" href="/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Best PUBG Cheat, APEX Cheat, PUBG Mobile Cheat.... Providers</title>
    <!-- Bootstrap core CSS -->
    <link rel="preload" href="/css/bootstrapv1.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="/css/bootstrapv2.min.css">
    </noscript>
    <!-- Icon core CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <!-- Custom styles for this template -->
    <link href="/css/new_style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/sweetalert2.min.css">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LQK3B0XLXY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LQK3B0XLXY');
    </script>

    <style>
        #elLogo img {
            max-width: 100%;
            width: 300px;
            padding: 20px 0;
        }

        .navbar.navbar-default.navbar-fixed-top {
            padding: 15px 0 5px 0;
            position: absolute;
        }

        .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
            background: transparent;
        }
        #back-top {
            bottom: 109px;
            right: 20px;
        }
        @media (min-width: 768px){
            .game_list {
                margin-left: 110px;
            }
        }
    </style>
</head>
<body id="page-top">
<!-- Navigation -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top"><img src="/images/logo_landing.png" alt="Logo"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
            <!-- <li>
                    <a class="page-scroll" href="#bottom">Info</a>
                </li> -->
                <li class="dropdown game_list">
                    <button class="btn-transp dropdown-toggle" type="button" data-toggle="dropdown" style="background: transparent; border: none;">NEWS & BLOG
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="background: rgba(0, 0, 0, 1); text-align: right; margin-right: 25px;">
                        @foreach($games AS $game)
                            {{--                            <li><a href="{{route('blog_game', $game->id)}}">{{$game->name}}</a></li>--}}
                            <li>
                                <a href="{{ route('blog-game-title', $game->slug) }}">
                                    {{ $game->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
            <ul class="right-menu-dop">
                <!-- <a href="/verify/verification-system.html">  <li class="scrt">verification systems</li></a> -->
                <div style="margin-right: 10px;">
                    <a target="_blank" href='{{ \App\Option::where('option', 'discord_channel')->get()->first()->value }}'>
                        <li class="btn-transp simple">OUR COMMUNITY</li>
                    </a>
                </div>
                <div>
                    <a href="{{ route('home') }}">
                        <li class="btn-light">Buy Now</li>
                    </a>
                </div>
            </ul>
        </div>
        <!-- /.navbar-collapse -->

    </div>
    <!-- /.container-fluid -->
</nav>
<!--
<div style="position: fixed; bottom: 0; background: #FFF; z-index: 999; color: red; font-size: 16px; padding: 10px; font-weight: bold; text-align: inherit">
<div style="width: 79%;">Our website is under attack. We have to block some IP address for 1 hour. Please click slow down to avoid being mistaken as Zombie. Thanks for your patience.</div>
</div>
->>
<!-- Header -->
<header>
    <div class="container">

        <div class="slider-container">
            <div class="intro-text col-md-7">

                <h1 class="intro"><b>Your security</b> is our priority</h1>
                <p class="hero-txt"><b>Securecheat's mission</b> is to create the world's most innovative and secure
                    technology - while achieving top levels in user-friendly software by applying Artificial
                    Intelligence into our cheat's future</p>

                <a href="/home" class="btn-light simple">Home</a>
                <a href="{{ route('login') }}" class="btn-transp simple">Login <span style="margin-left: 15px;"
                                                                                     class="lnr lnr-chevron-right"></span>
                </a>
                <a href="{{ route('register') }}" class="btn-transp simple">Register <span style="margin-left: 15px;"
                                                                                           class="lnr lnr-chevron-right"></span>
                </a>

            </div>

        </div>

    </div>
    <a href="#bottom"><span class="lnr lnr-arrow-down" style="color: #fff;
			font-size: 40px;"></span></a>
    <a name="bottom"></a>
</header>
@include('new.popup')

<section>

    <div class="container">
        <div class="row">
            <div class="col-md-7 colonmob">
                <div class="skills-text">
                    <h2><b>More About us:</b></h2>

                    <p><b>SecureCheats is now about a year old since it was founded - our team of coders are
                            professional and are specialized in many aspects in programming, reverse engineering,
                            exploiting and have made many cheats/hacks/exploits in almost all game engines out
                            there!</b></p>

                    <p>Development goals - to provide the ultimate secure private cheats, experimenting and implementing
                        AI into our cheats to keep you hidden and trick any anti-cheat software out there. Keeping your
                        account clean and undetected was our priority when developing this cheat, and it will always be
                        going forward into updating it. With protection against the most popular anti-cheat software's
                        like VAC, Fairfight, Easy Anti-cheat, and most notoriously Battleye and FACEIT Anti-cheat... You
                        can be sure that you're always safe while using our products.</p>
                    <p><b>Our goal is far more than just business, it's about customer satisfaction!<br> Welcome to
                            SecureCheats, where your satisfaction is our success.
                        </b></p>


                </div>
                <a href="#testimonial" class="btn-light simple semy">Our Reviews</a>

            </div>
            <div class="col-md-5">

                <div class="feat-list"><span class="lnr lnr-lock aboutus-i"></span>
                    <text class="features-txt">Developed goals - to provide the ultimate secure private cheats,
                        experimenting and implementing AI
                        into our cheats to keep you hidden and trick any anti-cheat software out there.
                    </text>
                </div>

                <div class="feat-list"><span class="lnr lnr-cloud-download aboutus-i"></span>
                    <text class="features-txt">Keeping your account clean and undetected was our priority
                        when developing this cheat, and it will always be going forwad into updating it.
                    </text>
                </div>
                <div class="feat-list"><span class="lnr lnr-paperclip aboutus-i"></span>
                    <text class="features-txt">With protection against the most popular anti-cheat softwares
                        like VAC, Farfight, Easy Anticheat, and most notoriously Battleye and FACEIT Anticheat...
                    </text>
                </div>

                <div class="feat-list"><span class="lnr lnr-film-play aboutus-i"></span>
                    <text class="features-txt">You can be sure that you're always safe while using our products.</text>
                </div>

                <div class="feat-list"><span class="lnr lnr-film-play aboutus-i"></span>
                    <text class="features-txt">Not to mention, our cheats are completely private and every user gets
                        their own encrypted build -
                        which means we don't get the anti-cheat's team's full attention at all times - they are more
                        worried about the public cheats.
                    </text>
                </div>

                <div class="feat-list"><span class="lnr lnr-film-play aboutus-i"></span>
                    <text class="features-txt">We employ a double-layer encryption as well as some ID verification for
                        some of our most private cheats to try and completely eliminate infiltration ensuring
                        the most up-to-date and undetected safe cheat you will ever use.
                    </text>
                </div>


            </div>
        </div>
    </div>
</section>


<section class="security">
    <div class="container">
        <div class="row">
            <div class="col-md-6">


            </div>
            <div class="col-md-6 scrt">

                <h2><b>The Safest most Private</b><br>Chats Online...
                </h2>

                <p><b>SecureCheats are developed with the most of safety in mind, but don't think that we're lacking in
                        terms of functions...</b></p>

                <p>We provide the world's deadliest and most accurate aimbot, with all the settings you can imagine at
                    your finger tips - not only that but we do it while looking extremely legit!
                    We also host a powerful ESP with every option in mind, be it vehicles, players, items, everything is
                    included - as well as some interested extra cheats for the furious of you such as no recoil and no
                    sway.</p>

                <p>Easily get your way in every game using our aimbots, ESP and radar to make sure you're never flanked
                    and always on top of your opponent. Always have the best loot and climb the leaderboard while you're
                    at it!</p>

                <p><b>Configurable, Bone Aimbots</b></p>
                <p><b>Easily knock down your opponents in any game we provide for</b></p>
                <p><b>24/7 Fastest support that exists at the moment.</b></p>


            </div>
        </div>
    </div>
</section>


<section id="about" class="light-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2 style="text-align: left;"><b>How it works. What should you know</b></h2></div>
            <div class="col-md-2">
                <a href="{{route('login')}}" class="btn-light simple semy" style="margin-top: 15px;">Login</a>

            </div>
        </div>
        <div class="row colons">
            <!-- about module -->
            <div class="col-md-3 ">
                <div class="mz-module-about">
                    <span class="lnr lnr-star why-us"></span>
                    <h3>Quality Cheats</h3>
                    <p>Get the best cheating features for every single game we support. From our insanely accurate but
                        legit aimbots, to our fully customizable 2D Radars, ESP features and a bunch of other misc
                        features to play with!</p>
                </div>
            </div>
            <!-- end about module -->
            <!-- about module -->
            <div class="col-md-3 ">
                <div class="mz-module-about">
                    <span class="lnr lnr-code why-us"></span>
                    <h3>Continued Development</h3>
                    <p>At SecureCheats we will never stop working and developing new technologies, our team is always
                        looking to keep our cheats not only up-to-date but also undetected for the longest time possible
                        and provide new technologies to do so!</p>
                </div>
            </div>
            <!-- end about module -->
            <!-- about module -->
            <div class="col-md-3">
                <div class="mz-module-about">
                    <span class="lnr lnr-cog why-us"></span>
                    <h3>Unique Encryption Methods</h3>
                    <p>Our team has successfully developed and implemented multiple undetected cheats for all our games
                        using top of the line Artificial Intelligence code that could easily bypass Faceit AC, Battleye,
                        EAC, and any other anti-cheat there is for our games. On top of all that we provide external
                        portal to login from which eliminates our competitors and anti-cheat companies from being able
                        to patch us.

                    </p>
                </div>
            </div>
            <!-- end about module -->
            <!-- about module -->
            <div class="col-md-3">
                <div class="mz-module-about">
                    <span class="lnr lnr-thumbs-up why-us"></span>
                    <h3>Friendly Community</h3>
                    <p> Join our discord for discussions, tips, guides and fast support. Our experiences staff is always
                        there and ready to assist you in anything and everything you might have to ask. Any concerns and
                        issues you encounter, not only with your cheats but also with your computer!</p>
                </div>
            </div>
            <!-- end about module -->
        </div>
    </div>
    <!-- /.container -->
</section>

<a name="testimonial"></a>


<section class="overlay-dark bg-img1 dark-bg">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <h2 class="white-ttl"><b>Our members</b> talk about us</h2>

                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel slide" data-ride="carousel" id="quote-carousel">

                                <!-- Bottom Carousel Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#quote-carousel" data-slide-to="1"></li>
                                    <li data-target="#quote-carousel" data-slide-to="2"></li>
                                </ol>

                                <!-- Carousel Slides / Quotes -->
                                <div class="carousel-inner">

                                    <!-- Quote 1 -->
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="/images/testimonial.png" class="testim-img">
                                                <p class="hero-txt itl">“Bought a month via their forum and all I can
                                                    say is: Awesome!
                                                    First Cheat I see that works so stable and smooth while staying
                                                    undetected.
                                                    Will definitely buy again.”</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quote 2 -->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="/images/testimonial.png" class="testim-img">
                                                <p class="hero-txt itl">“Worth the money. All features are working fine.
                                                    The support help instantly when you got questions. I feel statisfied
                                                    when using their product ”</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quote 3 -->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="/images/testimonial.png" class="testim-img">
                                                <p class="hero-txt itl">“Updates are pushed fast so you can directly
                                                    play after uppdate. All features work great and the aimbot is
                                                    hitting very good , esp look so clearly . There are no peformance
                                                    issues too. I really recommend the cheat!”</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<section class="overlay-dark bg-img-no dark-bg short-section">
    <div class="container">
        <div class="row">
            <h2 class="white-ttl light">Start cheating within just minutes!
            </h2>

            <div class="col-md-4">
                <div class="mz-module-about light">
                    <span class="lnr lnr-laptop why-us"></span>
                    <h3 class="light">Sign-up</h3>
                    <p class="light">Check out our videos and previews then continue to register on our forums!</p>
                </div>

            </div>

            <div class="col-md-4">
                <div class="mz-module-about light">
                    <span class="lnr lnr-enter why-us"></span>
                    <h3 class="light">Instant Access</h3>
                    <p class="light">Once a subscription is bought, you get instant access to all the cheats that you
                        have a membership for by just downloading our loader!
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mz-module-about light">
                    <span class="lnr lnr-select why-us"></span>
                    <h3 class="light">Play</h3>
                    <p class="light">Instantly select and run the game from our loader, you will also have access to our
                        VIP areas and forums.

                    </p>
                </div>
            </div>
        </div>
    </div>

</section>


<p id="back-top">
    <a href="#top"><i class="lnr lnr-arrow-up"></i></a>
</p>

<footer>
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <h3 class="white-ttl foot">Join Our Online Community:</h3>

                <p class="footer-txt">Are you looking for people that are similar to you to discuss gaming, cheating, or
                    just to chill with? Memes, jokes and so on! We have all of that in our Secure Cheats community
                    discord as well as in the forums, where you can forge alliances and make friendships as well as hold
                    positive discussions.<br>
                    Whether you need help setting up for the fire time, or just player with other fellow cheaters, our
                    forum will be very happy to help you with all that you need, we also have tutorials posted for you.
                    We make sure that when you choose Securecheats, Cheating is only part of the full experience!

                </p>

            </div>

            <div class="col-md-4 footer-sm">

                <a href="{{route('login')}}" class="btn-light">Login</a>

            </div>
        </div>

    </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {};
    Tawk_API.visitor = {
        name: '{{ isset(Auth::user()->id) ? Auth::user()->name.' - ID '.Auth::user()->id : 'Guest' }}',
        email: '{{ isset(Auth::user()->id) ? Auth::user()->email : 'guest@gmail.com'}}'
    }, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5de0f78ad96992700fc9e348/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
<script type="text/javascript">
    var source = [
        "/js/bootstrap.min.js",
    ]
    function downloadJSAtOnload(source) {
        for (var i = 0; i < source.length; i++) {
            var element = document.createElement("script");
            element.src = source[i];
            document.body.appendChild(element);
        }

    }
    if (window.addEventListener) {
        window.addEventListener("load", downloadJSAtOnload(source), false);
    } else if (window.attachEvent) {
        window.attachEvent("onload", downloadJSAtOnload(source));
    } else {
        window.onload = downloadJSAtOnload(source);
    }
</script>
<script>
    var beamer_config = {
        product_id : "BMYCfTcP24240", //DO NOT CHANGE: This is your product code on Beamer
        button_position: 'bottom-left',

    };
</script>
<script type="text/javascript" src="https://app.getbeamer.com/js/beamer-embed.js" defer="defer"></script>
</body>
</html>
