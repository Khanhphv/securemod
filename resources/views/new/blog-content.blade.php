@extends('new/master-layout')
@section('content')
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" id="viewport"
              content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 .07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }

            .ugly-vl {

                display: none;

            }
        </style>
        <link rel="stylesheet" id="wp-block-library-css" href="/blog_files/style.min.css" type="text/css" media="all">
        <link rel="stylesheet" id="theiaPostSlider-css" href="/blog_files/font-theme-2.3.1.css" type="text/css"
              media="all">
        <style id="theiaPostSlider-inline-css" type="text/css">
            .theiaPostSlider_nav.fontTheme ._title,
            .theiaPostSlider_nav.fontTheme ._text {
                line-height: 48px;
            }

            .theiaPostSlider_nav.fontTheme ._button,
            .theiaPostSlider_nav.fontTheme ._button svg {
                color: #eabf00;
                fill: #eabf00;
            }

            .theiaPostSlider_nav.fontTheme ._button ._2 span {
                font-size: 48px;
                line-height: 48px;
            }

            .theiaPostSlider_nav.fontTheme ._button ._2 svg {
                width: 48px;
            }

            .theiaPostSlider_nav.fontTheme ._button:hover,
            .theiaPostSlider_nav.fontTheme ._button:focus,
            .theiaPostSlider_nav.fontTheme ._button:hover svg,
            .theiaPostSlider_nav.fontTheme ._button:focus svg {
                color: #ffd934;
                fill: #ffd934;
            }

            .theiaPostSlider_nav.fontTheme ._disabled,
            .theiaPostSlider_nav.fontTheme ._disabled svg {
                color: #757575 !important;
                fill: #757575 !important;
            }
        </style>
        <link rel="stylesheet" id="theiaPostSlider-font-css" href="/blog_files/style-2.3.1.css" type="text/css"
              media="all">
        <link rel="stylesheet" id="wpmfAddonFrontStyle-css" href="/blog_files/front-3.2.1.css" type="text/css"
              media="all">
        <link rel="stylesheet" id="ql-jquery-ui-css" href="/blog_files/jquery-ui.css" type="text/css" media="all">
        <link rel="stylesheet" id="mvp-custom-style-css" href="/blog_files/style.css" type="text/css" media="all">
        <style id="mvp-custom-style-inline-css" type="text/css">
            #mvp-wallpaper {
                background: url() no-repeat 50% 0;
            }

            #mvp-foot-copy a {
                color: #0be6af;
            }

            #mvp-content-main p a,
            .mvp-post-add-main p a {
                box-shadow: inset 0 -4px 0 #0be6af;
            }

            #mvp-content-main p a:hover,
            .mvp-post-add-main p a:hover {
                background: #0be6af;
            }

            a,
            a:visited,
            .post-info-name a,
            .woocommerce .woocommerce-breadcrumb a {
                color: #ff005b;
            }

            #mvp-side-wrap a:hover {
                color: #ff005b;
            }

            .mvp-fly-top:hover,
            .mvp-vid-box-wrap,
            ul.mvp-soc-mob-list li.mvp-soc-mob-com {
                background: #ff005b;
            }

            nav.mvp-fly-nav-menu ul li.menu-item-has-children:after,
            .mvp-feat1-left-wrap span.mvp-cd-cat,
            .mvp-widget-feat1-top-story span.mvp-cd-cat,
            .mvp-widget-feat2-left-cont span.mvp-cd-cat,
            .mvp-widget-dark-feat span.mvp-cd-cat,
            .mvp-widget-dark-sub span.mvp-cd-cat,
            .mvp-vid-wide-text span.mvp-cd-cat,
            .mvp-feat2-top-text span.mvp-cd-cat,
            .mvp-feat3-main-story span.mvp-cd-cat,
            .mvp-feat3-sub-text span.mvp-cd-cat,
            .mvp-feat4-main-text span.mvp-cd-cat,
            .woocommerce-message:before,
            .woocommerce-info:before,
            .woocommerce-message:before {
                color: #ff005b;
            }

            #searchform input,
            .mvp-authors-name {
                border-bottom: 1px solid #ff005b;
            }

            .mvp-fly-top:hover {
                border-top: 1px solid #ff005b;
                border-left: 1px solid #ff005b;
                border-bottom: 1px solid #ff005b;
            }

            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
            .woocommerce #respond input#submit.alt,
            .woocommerce a.button.alt,
            .woocommerce button.button.alt,
            .woocommerce input.button.alt,
            .woocommerce #respond input#submit.alt:hover,
            .woocommerce a.button.alt:hover,
            .woocommerce button.button.alt:hover,
            .woocommerce input.button.alt:hover {
                background-color: #ff005b;
            }

            .woocommerce-error,
            .woocommerce-info,
            .woocommerce-message {
                border-top-color: #ff005b;
            }

            ul.mvp-feat1-list-buts li.active span.mvp-feat1-list-but,
            span.mvp-widget-home-title,
            span.mvp-post-cat,
            span.mvp-feat1-pop-head {
                background: #ff005b;
            }

            .woocommerce span.onsale {
                background-color: #ff005b;
            }

            .mvp-widget-feat2-side-more-but,
            .woocommerce .star-rating span:before,
            span.mvp-prev-next-label,
            .mvp-cat-date-wrap .sticky {
                color: #ff005b !important;
            }

            #mvp-main-nav-top,
            #mvp-fly-wrap,
            .mvp-soc-mob-right,
            #mvp-main-nav-small-cont {
                background: #1d202b;
            }

            #mvp-main-nav-small .mvp-fly-but-wrap span,
            #mvp-main-nav-small .mvp-search-but-wrap span,
            .mvp-nav-top-left .mvp-fly-but-wrap span,
            #mvp-fly-wrap .mvp-fly-but-wrap span {
                background: #efefef;
            }

            .mvp-nav-top-right .mvp-nav-search-but,
            span.mvp-fly-soc-head,
            .mvp-soc-mob-right i,
            #mvp-main-nav-small span.mvp-nav-search-but,
            #mvp-main-nav-small .mvp-nav-menu ul li a {
                color: #efefef;
            }

            #mvp-main-nav-small .mvp-nav-menu ul li.menu-item-has-children a:after {
                border-color: #efefef transparent transparent transparent;
            }

            #mvp-nav-top-wrap span.mvp-nav-search-but:hover,
            #mvp-main-nav-small span.mvp-nav-search-but:hover {
                color: #ffffff;
            }

            #mvp-nav-top-wrap .mvp-fly-but-wrap:hover span,
            #mvp-main-nav-small .mvp-fly-but-wrap:hover span,
            span.mvp-woo-cart-num:hover {
                background: #ffffff;
            }

            #mvp-main-nav-bot-cont {
                background: #eff4ff;
            }

            #mvp-nav-bot-wrap .mvp-fly-but-wrap span,
            #mvp-nav-bot-wrap .mvp-search-but-wrap span {
                background: #353535;
            }

            #mvp-nav-bot-wrap span.mvp-nav-search-but,
            #mvp-nav-bot-wrap .mvp-nav-menu ul li a {
                color: #353535;
            }

            #mvp-nav-bot-wrap .mvp-nav-menu ul li.menu-item-has-children a:after {
                border-color: #353535 transparent transparent transparent;
            }

            .mvp-nav-menu ul li:hover a {
                border-bottom: 5px solid #ff005b;
            }

            #mvp-nav-bot-wrap .mvp-fly-but-wrap:hover span {
                background: #ff005b;
            }

            #mvp-nav-bot-wrap span.mvp-nav-search-but:hover {
                color: #ff005b;
            }

            body,
            .mvp-feat1-feat-text p,
            .mvp-feat2-top-text p,
            .mvp-feat3-main-text p,
            .mvp-feat3-sub-text p,
            #searchform input,
            .mvp-author-info-text,
            span.mvp-post-excerpt,
            .mvp-nav-menu ul li ul.sub-menu li a,
            nav.mvp-fly-nav-menu ul li a,
            .mvp-ad-label,
            span.mvp-feat-caption,
            .mvp-post-tags a,
            .mvp-post-tags a:visited,
            span.mvp-author-box-name a,
            #mvp-author-box-text p,
            .mvp-post-gallery-text p,
            ul.mvp-soc-mob-list li span,
            #comments,
            h3#reply-title,
            h2.comments,
            #mvp-foot-copy p,
            span.mvp-fly-soc-head,
            .mvp-post-tags-header,
            span.mvp-prev-next-label,
            span.mvp-post-add-link-but,
            #mvp-comments-button a,
            #mvp-comments-button span.mvp-comment-but-text,
            .woocommerce ul.product_list_widget span.product-title,
            .woocommerce ul.product_list_widget li a,
            .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
            .woocommerce div.product p.price,
            .woocommerce div.product p.price ins,
            .woocommerce div.product p.price del,
            .woocommerce ul.products li.product .price del,
            .woocommerce ul.products li.product .price ins,
            .woocommerce ul.products li.product .price,
            .woocommerce #respond input#submit,
            .woocommerce a.button,
            .woocommerce button.button,
            .woocommerce input.button,
            .woocommerce .widget_price_filter .price_slider_amount .button,
            .woocommerce span.onsale,
            .woocommerce-review-link,
            #woo-content p.woocommerce-result-count,
            .woocommerce div.product .woocommerce-tabs ul.tabs li a,
            a.mvp-inf-more-but,
            span.mvp-cont-read-but,
            span.mvp-cd-cat,
            span.mvp-cd-date,
            .mvp-feat4-main-text p,
            span.mvp-woo-cart-num,
            span.mvp-widget-home-title2,
            .wp-caption,
            #mvp-content-main p.wp-caption-text,
            .gallery-caption,
            .mvp-post-add-main p.wp-caption-text,
            #bbpress-forums,
            #bbpress-forums p,
            .protected-post-form input,
            #mvp-feat6-text p {
                font-family: 'Roboto', sans-serif;
            }

            .mvp-blog-story-text p,
            span.mvp-author-page-desc,
            #mvp-404 p,
            .mvp-widget-feat1-bot-text p,
            .mvp-widget-feat2-left-text p,
            .mvp-flex-story-text p,
            .mvp-search-text p,
            #mvp-content-main p,
            .mvp-post-add-main p,
            #mvp-content-main ul li,
            #mvp-content-main ol li,
            .rwp-summary,
            .rwp-u-review__comment,
            .mvp-feat5-mid-main-text p,
            .mvp-feat5-small-main-text p,
            #mvp-content-main .wp-block-button__link,
            .wp-block-audio figcaption,
            .wp-block-video figcaption,
            .wp-block-embed figcaption,
            .wp-block-verse pre,
            pre.wp-block-verse {
                font-family: 'PT Serif', sans-serif;
            }

            .mvp-nav-menu ul li a,
            #mvp-foot-menu ul li a {
                font-family: 'Oswald', sans-serif;
            }

            .mvp-feat1-sub-text h2,
            .mvp-feat1-pop-text h2,
            .mvp-feat1-list-text h2,
            .mvp-widget-feat1-top-text h2,
            .mvp-widget-feat1-bot-text h2,
            .mvp-widget-dark-feat-text h2,
            .mvp-widget-dark-sub-text h2,
            .mvp-widget-feat2-left-text h2,
            .mvp-widget-feat2-right-text h2,
            .mvp-blog-story-text h2,
            .mvp-flex-story-text h2,
            .mvp-vid-wide-more-text p,
            .mvp-prev-next-text p,
            .mvp-related-text,
            .mvp-post-more-text p,
            h2.mvp-authors-latest a,
            .mvp-feat2-bot-text h2,
            .mvp-feat3-sub-text h2,
            .mvp-feat3-main-text h2,
            .mvp-feat4-main-text h2,
            .mvp-feat5-text h2,
            .mvp-feat5-mid-main-text h2,
            .mvp-feat5-small-main-text h2,
            .mvp-feat5-mid-sub-text h2,
            #mvp-feat6-text h2,
            .alp-related-posts-wrapper .alp-related-post .post-title {
                font-family: 'Oswald', sans-serif;
            }

            .mvp-feat2-top-text h2,
            .mvp-feat1-feat-text h2,
            h1.mvp-post-title,
            h1.mvp-post-title-wide,
            .mvp-drop-nav-title h4,
            #mvp-content-main blockquote p,
            .mvp-post-add-main blockquote p,
            #mvp-content-main p.has-large-font-size,
            #mvp-404 h1,
            #woo-content h1.page-title,
            .woocommerce div.product .product_title,
            .woocommerce ul.products li.product h3,
            .alp-related-posts .current .post-title {
                font-family: 'Oswald', sans-serif;
            }

            span.mvp-feat1-pop-head,
            .mvp-feat1-pop-text:before,
            span.mvp-feat1-list-but,
            span.mvp-widget-home-title,
            .mvp-widget-feat2-side-more,
            span.mvp-post-cat,
            span.mvp-page-head,
            h1.mvp-author-top-head,
            .mvp-authors-name,
            #mvp-content-main h1,
            #mvp-content-main h2,
            #mvp-content-main h3,
            #mvp-content-main h4,
            #mvp-content-main h5,
            #mvp-content-main h6,
            .woocommerce .related h2,
            .woocommerce div.product .woocommerce-tabs .panel h2,
            .woocommerce div.product .product_title,
            .mvp-feat5-side-list .mvp-feat1-list-img:after {
                font-family: 'Roboto', sans-serif;
            }

            .mvp-vid-box-wrap,
            .mvp-feat1-left-wrap span.mvp-cd-cat,
            .mvp-widget-feat1-top-story span.mvp-cd-cat,
            .mvp-widget-feat2-left-cont span.mvp-cd-cat,
            .mvp-widget-dark-feat span.mvp-cd-cat,
            .mvp-widget-dark-sub span.mvp-cd-cat,
            .mvp-vid-wide-text span.mvp-cd-cat,
            .mvp-feat2-top-text span.mvp-cd-cat,
            .mvp-feat3-main-story span.mvp-cd-cat {
                color: #fff;
            }

            #mvp-leader-wrap {
                position: relative;
            }

            #mvp-site-main {
                margin-top: 0;
            }

            #mvp-leader-wrap {
                top: 0 !important;
            }

            .mvp-nav-links {
                display: none;
            }

            .mvp-auto-post-grid {
                grid-template-columns: 340px minmax(0, auto);
            }

            .alp-advert {
                display: none;
            }

            .alp-related-posts-wrapper .alp-related-posts .current {
                margin: 0 0 10px;
            }
        </style>
        <link rel="stylesheet" id="mvp-reset-css" href="/blog_files/reset.css" type="text/css" media="all">
        <link rel="stylesheet" id="mvp-media-queries-css" href="/blog_files/media-queries.css" type="text/css"
              media="all">
        <style type="text/css" id="wp-custom-css">
            .sidebar-offcanvas.active {
                right: 0;
                z-index: 999999 !important;
            }


            #mvp-main-body-wrap {
                padding-top: 6px;
            }

            .callout-button a {
                background-color: #fff000;
                border: none;
                color: white;
                padding: 6px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }

            .callout-button a:hover {
                color: #ffffff;
            }

            .callout-button a:after {
                display: none !important;
            }


            .dt_clock_1000 div {
                display: none !important
            }
        </style>
    </head>
    <body class="post-template-default single single-post postid-5440 single-format-standard theiaPostSlider_body cookies-not-set"
          style="transform: none;">
    <div id="mvp-site" class="left relative" style="transform: none;">
        <div id="mvp-site-wall" class="left relative" style="transform: none;">
            <div id="mvp-site-main" class="left relative" style="transform: none;">
                <!--mvp-main-head-wrap-->
                <div id="mvp-main-body-wrap" class="left relative" style="transform: none; margin-top: 0px;">
                    <div class="mvp-main-box" style="transform: none;">
                        <div class="mvp-auto-post-grid" style="transform: none;">
                            <div class="mvp-alp-side"
                                 style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                                <!--mvp-alp-side-in-->
                                <div class="theiaStickySidebar"
                                     style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 351.5px; top: 0px;">
                                    <div class="mvp-alp-side-in" tabindex="5000"
                                         style="overflow: hidden; outline: none;">
                                        <div class="alp-related-posts-wrapper">
                                            <div class="alp-related-posts">
                                                <div class="alp-related-post post-5501" data-id="5501"
                                                     style="display: block;">
                                                    <div class="post-details">
                                                        <p class="post-meta">
                                                            <a class="post-category"
                                                               href="#">Post
                                                                Relevance</a>
                                                        </p>
                                                        @foreach($relevancies as $relevancy)
                                                            <a class="post-title mb-3"
                                                               href="/blog/{{ $relevancy->id }}" target="_blank">{{ $relevancy->title }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                            <!--alp-related-posts-->
                                        </div>
                                        <!--alp-related-posts-wrapper-->
                                    </div>
                                    <div class="resize-sensor"
                                         style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                                        <div class="resize-sensor-expand"
                                             style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 350px; height: 14812px;"></div>
                                        </div>
                                        <div class="resize-sensor-shrink"
                                             style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--mvp-alp-side-->
                            <div class="mvp-auto-post-main">
                                <article id="post-5440" class="mvp-article-wrap first" itemscope=""
                                         itemtype="http://schema.org/NewsArticle">
                                    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                                          itemid="/2020/02/21/travel-firms-in-vietnam-offer-huge-discounts-during-coronavirus-outbreak/">
                                    <div id="mvp-article-cont" class="left relative">
                                        <div id="mvp-post-main" class="left relative">
                                            <header id="mvp-post-head" class="left relative">
                                                <h3 class="mvp-post-cat left relative"><a class="mvp-post-cat-link"
                                                                                          href="/news-in-brief/"><span
                                                                class="mvp-post-cat left">Hacking News</span></a></h3>
                                                <h1 class="mvp-post-title left entry-title mb-5" itemprop="headline">
                                                    {{ $content->title }}</h1>
                                                <div class="mvp-author-info-wrap left relative mt-3">
                                                    <div class="mvp-author-info-thumb left relative">
                                                        <img src="https://image.freepik.com/free-vector/colorful-phoenix-eagle-logo_144543-216.jpg"
                                                             width="46" height="46"
                                                             alt="Admin"
                                                             class="avatar avatar-46 wp-user-avatar wp-user-avatar-46 alignnone photo">
                                                    </div>
                                                    <!--mvp-author-info-thumb-->
                                                    <div class="mvp-author-info-text left relative">
                                                        <div class="mvp-author-info-date left relative">
                                                            <p>Published</p>
                                                            <p>on</p>
                                                            <span class="mvp-post-date">{{ $content->created_at }}</span>
                                                        </div>
                                                        <!--mvp-author-info-date-->
                                                        <div class="mvp-author-info-name left relative"
                                                             itemprop="author"
                                                             itemscope="" itemtype="https://schema.org/Person">
                                                            <p>By</p>
                                                            <span class="author-name vcard fn author" itemprop="name"><a
                                                                        href="#">Admin</a></span>
                                                        </div>
                                                        <!--mvp-author-info-name-->
                                                    </div>
                                                    <!--mvp-author-info-text-->
                                                </div>
                                                <!--mvp-author-info-wrap-->
                                            </header>
                                            <div id="mvp-post-content" class="left relative">
                                                <div id="mvp-post-feat-img"
                                                     class="left relative mvp-post-feat-img-wide2">
                                                    <img src="{{ $content->thumbnail }}">
                                                </div>
                                                <div id="mvp-content-wrap" class="left relative">
                                                    <div id="mvp-content-body" class="left relative">
                                                        <div id="mvp-content-body-top" class="left relative">
                                                            <div id="mvp-content-main" class="left relative">
                                                                <div id="tps_slideContainer_5440"
                                                                     class="theiaPostSlider_slides"
                                                                     style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                                    <div class="theiaPostSlider_preloadedSlide">
                                                                        {!! $content->content !!}
                                                                    </div>
                                                                </div>
                                                                <div class="theiaPostSlider_footer _footer"></div>
                                                                <p>
                                                                    <!-- END THEIA POST SLIDER -->
                                                                </p>
                                                            </div>
                                                            <!--mvp-content-main-->
                                                        </div>
                                                        <!--mvp-content-body-top-->
                                                    </div>
                                                    <!--mvp-content-body-->
                                                </div>
                                                <!--mvp-content-wrap-->
                                            </div>
                                            <!--mvp-post-content-->
                                        </div>
                                        <!--mvp-post-main-->
                                    </div>
                                    <!--mvp-article-cont-->

                                </article>
                                <!--mvp-article-wrap-->
                            </div>
                            <!--mvp-auto-post-main-->
                        </div>
                        <!--mvp-auto-post-grid-->
                    </div>
                    <!--mvp-main-box-->
                </div>
                <!--mvp-main-body-wrap-->
            </div>
            <!--mvp-site-main-->
        </div>
        <!--mvp-site-wall-->
    </div>
    <!--mvp-site-->
    </body>
@endsection
