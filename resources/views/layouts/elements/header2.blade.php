<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('')}}">
                    <img src="{{url('/images/logo.svg')}}" height="50px" title="{{config('const.site_url')}}" alt="Logo SECURECHEAT.com"
                    class="logo">
                    <h2 class="site-title">{{config('const.site_url')}}<span>{{trans('header.slogan')}}</span></h2>
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                            @guest
                            <li><a class="nav-link " href="{{ route('login') }}">{{ trans('auth.login') }}</a></li>
                            @if (Route::has('register'))
                            <li>
                                <a class="nav-link" href="{{ route('register') }}"
                                onclick="gtag_report_conversion()">{{ trans('auth.register') }}</a>
                            </li>
                            @endif
                            @endguest
                </ul>

                </div>
            </div>
        </div>
    </div>
</nav>
