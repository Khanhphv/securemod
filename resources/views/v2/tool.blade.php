<!DOCTYPE html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $head_tags ?  $head_tags->head_title : $game->name)
    @section('description', $head_tags ?  $head_tags->head_description : '')
    <meta charset="UTF-8">
    <meta name="description" content="{{ $game->description }}">
    <meta name="keywords" content="{{ $game->keyword }}">
    <meta name="author" content="support@securecheats.xyz">
    @include('new.style')
    <style>
        .carousel-slider{
            height: 40vh!important;
        }
        .carousel-slider .carousel-item{
            display: flex;
        }

        .discount {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-text-size-adjust: 100%;
            position: absolute;
            top: 35%;
            left: 30%;
            display: inline-block;
            background: #e57373;
            width: auto;
            height: 30px;
            line-height: 32px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 0 15px;
        }

        .discount:after {
            content: " ";
            height: 22px;
            width: 22px;
            background: #e57373;
            position: absolute;
            top: 4px;
            left: -9px;
            border-radius: 4px;
            -moz-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .discount:before {
            content: "";
            width: 7px;
            height: 7px;
            background: #fff;
            position: absolute;
            top: 12px;
            left: 0px;
            z-index: 1;
            border-radius: 10px;
        }

        .tool-game {
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        }
        .card:hover {
            box-shadow: 5px 5px 15px #9a9a9a;
        }
        .card-title {
            max-width : 100%;
            font-size: 1.2em!important;
            font-weight: 550!important;
            height: 30px;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }
        .tab-content .select-dropdown {
            width: fit-content !important;
        }
        .tab-content .select-dropdown span{
            white-space: nowrap;
        }
        .ribbon {
            line-height: 0.8em;
            font-size: 2em;
            text-transform: uppercase;
            text-align: center;
            font-weight: bold;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);
            letter-spacing: -2px;
            display: block;
            width: 6rem;
            height: 4rem;
            background: linear-gradient(to bottom, #999999 0%, #cccccc 100%);
            color: white;
            margin: 1em 0.5em 0;
            float: left;
            padding-top: 1rem;
            position: relative;
            -webkit-filter: drop-shadow(0 0.5rem 0.3em rgba(0, 0, 0, 0.5));
            transform: translate3d(0, 0, 0);
            z-index: 10;
            box-sizing: content-box;
        }
        .ribbon:after{
            content: "";
            width: 0;
            height: 0;
            border-right: 3rem solid transparent;
            border-left: 3rem solid transparent;
            border-top: 1.5rem solid #CCCCCC;
            position: absolute;
            top: 5rem;
            left: 0;
        }
        .ribbon.ribbon--red {
            background: linear-gradient(to bottom, #d3362d 0%, #e57368 100%);
        }
        .ribbon.ribbon--red:after {
            border-top: 1.5rem solid #E57368;
        }
        @media screen and (max-width: 500px) {
            .tool-game {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
                padding: 20px 0
            }
        }
        @media (min-width: 500px) and (max-width: 1999px) {
            .tool-game {
                grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            }
        }
        @media screen and (min-width: 2000px) {
            .tool-game {
                grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            }
        }
        .product__price-tag {
            width: auto;
            display: flex;
            align-items: center;
            height: 50px;
            border-radius: 8px 8px 8px 0;
            background: #ffea2e;
            z-index: 99;
            position: absolute;
            top: -15px;
            left: -20px;
        }
        .product__price-tag-price {
            padding: 0 20px;
            color: #152ba3;
            font-size: 15px;
            font-weight: 700;
        }
        .product__price-tag::after {
            content: "";
            position: absolute;
            border-left: 20px solid transparent;
            border-top: 10px solid #8c8228;
            left: 0px;
            top: 50px;
        }
    </style>
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
@extends('new.master-layout')
@section('content')
    <h1 style="display:none">{{ $game->name }}</h1>
    <div class="tab-content mobile tool-game">
        @if(isset($tools) && count($tools) > 0)
            @foreach($tools as $tool)
                <div id="tool_{{$tool->id}}" class="card" style="margin: 1em">
                    @if($tool->note !== '')
                        <div class="product__price-tag">
                            <p class="product__price-tag-price">{{$tool->note}}</p>
                        </div>
                    @endif
                    @if($tool->discount && $tool->discount > 0)
                        <div style="position: absolute; right: 0">
                            <div class="ribbon  ribbon--red">SAVE {{ $tool->discount }}%</div>
                        </div>
                    @endif
                    @if($tool->video_intro)
                        <div style="height: 40vh">
                            <iframe width="100%" height="100%" loading="lazy" src="{{ $tool->video_intro}}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                            </iframe>
                        </div>
                    @else
                        <div>
                            <div class="carousel carousel-slider center" style="max-height: 100%!important;height: 40vh!important">
                                <?php
                                $listImg = explode(PHP_EOL, $tool->images);
                                ?>
                                @foreach($listImg as $image)
                                    <div class="carousel-item white-text" href="#one!">
                                        <img onclick="showImage(event)" loading="lazy" src="{{ $image }}" alt="{{ $tool->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="row card-content card-header" style="position: relative">
                        <h2 class="card-title" style="">{{ $tool->name }}</h2>
                        <label for="">Status</label>:
                        @if($tool->updated == 1)
                            <label class="green-text"> Working</label>
                            <!-- <div class="discount" style="position:absolute">-15%</div> -->
                            <div style="position: relative">
                                <button type="button" style="position: absolute; top: 0px; right: 0" class="btn-floating"
                                        onclick="buyTool({{$tool->id}})">
                                    <i class="material-icons">shopping_cart</i>
                                </button>
                            </div>
                            <div class="input-field" style="max-width: fit-content">
                                <select class="game-package" style="padding-left: 0.5em">
                                    <option value="" disabled selected>Choose package</option>
                                    @foreach(json_decode($tool->package, true) as $package => $price)
                                        @auth()
                                            @if($tool->discount && $tool->discount > 0)
                                                <option value="{{ $package }}">{{ $package.'H = '. round($price, 2). ' -> ' . round($price - ($price * $tool->discount /100) , 2) .  ' USD' }} </option>
                                            @else
                                                @if(isset($role) && $role['role'] > 0)
                                                    <option value="{{ $package }}">{{ $package.'H = '. round($price, 2). ' -> ' . round($price - ($price * $role['discount']) , 2) .  ' USD' }} </option>
                                                @else
                                                    <option value="{{ $package }}">{{ $package.'H = '.$price.' USD' }}</option>
                                                @endif
                                            @endif
                                        @endauth
                                        @guest()
                                            @if($tool->discount && $tool->discount > 0)
                                                <option value="{{ $package }}">{{ $package.'H = '. round($price, 2). ' -> ' . round($price - ($price * $tool->discount /100) , 2) .  ' USD' }} </option>
                                            @else
                                                <option value="{{ $package }}">{{ $package.'H = '.$price.' USD' }}</option>
                                            @endif
                                        @endguest
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <label class="red-text">Updating</label>
                        @endif
                    </div>
                    <div class="card-action">
                        <p>
                            <a href="{{ $tool->link  }}" target="_blank">
                                <i style="position: relative; top: 7px" class="material-icons">file_download</i>
                                Download
                            </a>
                        </p>
                        <p>
                            <a href="{{ $tool->youtube }}" target="_blank">
                                <i style="position: relative; top: 7px" class="material-icons">book</i>
                                Tutorial
                            </a>
                        </p>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
<script>
    let firstClickTime;
    function showImage(event) {
        if(window.screen.width < 1200) return;
        if (new Date().getTime() - firstClickTime < 300){
            let img = event.target;
            console.log(img.src)
            Swal.fire({
                imageUrl: img.src,
                width: '70%',
                imageWidth: '100%',
                imageHeight: '100%',
                showConfirmButton: false,
                background: 'none'
            })
        }
        firstClickTime = new Date().getTime();
    }
    function buyTool(tool_id) {
            @auth()
        let package_tool = $(`#tool_${tool_id} .game-package`).val();
        if (!package_tool) {
            Swal.fire({
                title: 'Warning',
                text: 'Please choose package',
                icon: 'error'
            })
            return
        }
        let url = "{{route('tool.buy-tool', [":tool_id", ":package"])}}";
        url = url.replace(':tool_id', tool_id);
        url = url.replace(':package', package_tool);
        Swal.fire({
            title: 'Now loading',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                Swal.showLoading();
            }
        })
        $.ajax({
            url: url,
            method: "GET",
            dataType: "JSON",
            success: function (response) {
                Swal.close();
                if (response.status === "success") {
                    Swal.fire({
                        title: '{{ trans('page.rent_successful') }}',
                        text: "Please check your email",
                        icon: 'success'
                    });
                } else {
                    Swal.fire({


                        title: '{{ trans('page.rent_failed') }}',
                        text: response.message,
                        icon: 'error'
                    }).then(function () {
                        if (response.code === 2) {
                            $("#recharge").show();
                        }
                        if (response.code === 190) {
                            window.location = "{{url('login')}}";
                        }
                    });
                }
            }
        })
        @endauth
        @guest()
        Swal.fire({
            title: 'Warning',
            text: 'Please login',
            icon: 'error'
        })
        @endguest
    }
</script>
</body>
</html>




