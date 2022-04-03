<style>
    .text-logo * {
        font-size: 25px
    }

    @media only screen and (max-width: 600px) {
        .text-logo {
            display: none;
        }

        .item-discription {
            height: 250px;
        }

        .container .menu-mobile-container {
            height: 100%;
            position: relative;
            overflow: auto;
        }
    }

    .notification-badge {
        position: relative;
        right: 5px;
        top: -20px;
        color: #b71c1c;
        background-color: #f5f1f2;
        margin: 0 -.8em;
        border-radius: 50%;
        padding: 5px 10px;
    }
</style>
<div class="container-content">
    <div class="toolbar sidebar">
        <div class="sidebar__content">
            @if (isset($master_site_settings['logo_mini']))
                <div class="icon-menu mb-4">
                    {{-- {!! html_entity_decode(
                        Html::linkRoute(
                            'home',
                            Html::image(
                                "https://giphy.com/clips/fire-shooter-sniper-dx2mQm8Ul5Hl0DWmn9",
                                'Home Page',
                                [
                                    'class' => 'img-fluid',
                                    'width' => 100,
                                ]
                            )
                        )
                    ) !!} --}}
                   <img src="https://media0.giphy.com/media/12GphGoFazeoso/200w.webp?cid=ecf05e471n44ygnpqwhafcnk1in6zxfam74ioi1he5kyovvd&rid=200w.webp&ct=g" alt="this slowpoke moves"  width="250" alt="404 image"/>
                </div>
                <ul class="nav flex-column mt-3">
                  @foreach(config('menu.MENUS') as $menu)
                    <li class=" align-items-center nav-item mb-3">
                        <a class="nav-link align-items-center flex-row d-flex" aria-current="page" href={{$menu['href']}}>
													<i class="{{$menu['icon']}} fs-4  fw-bold"></i>
													<span class="fs-5">{{$menu['title']}}</span>
												</a>
                    </li>
                  @endforeach
                </ul>
            @endif
        </div>
				<div class="sidebar__foot">
					<div class="align-items-center nav-item mb-3 mt-3">
						<a class="nav-link align-items-center flex-row d-flex" aria-current="page" href={{$menu['href']}}>
							<i class="{{$menu['icon']}} fs-4  fw-bold"></i>
							<span class="fs-5">Help & getting started</span>
						</a>
					</div>
				</div>

    </div>

    <div class="main">
        <div class="menu">
            <div>
            <!-- @if(isset($master_site_settings['text_logo']))
                <div style="color: var(--text-primary-color); padding-right: 1em" class="text-logo">
													{!! html_entity_decode(
                            Html::linkRoute(
                                'home',
                                Html::image(
                                    '/images/logo/' . $master_site_settings['text_logo'],
                                    'Home Page',
                                    [
                                        'class' => 'img-fluid',
                                        'width' => 230,
                                        'height' => 30
                                    ]
                                )
                            )
                        ) !!}
                    </div>
            @endif -->
                
            </div>
            <div class="desktop">
                <div class="cart shopping-cart cursor-pointer">
                    <a class="modal-trigger" data-bs-toggle="modal" data-bs-target="#cart">
                        <i class="small material-icons icon-blue">shopping_cart</i>
                        <small class="notification-badge"></small>
                    </a>
                </div>

                @guest()
                    <a id="" href="/login" style="display: none">Login</a>
                    <label for="login-button">
                        <div onclick="login()" class="btn-rechange">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <path
                                    d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                    id="Path" fill-rule="nonzero"/>
                                <path
                                    d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                    id="Path" fill-rule="nonzero"
                                    transform="translate(12.000000, 12.000000) rotate(-195.000000) translate(-12.000000, -12.000000) "/>
                                <path
                                    d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                    id="Path" fill-rule="nonzero"/>
                                <path
                                    d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                    id="Path" fill-rule="nonzero"
                                    transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "/>
                            </svg>
                            <div class="space-20px"></div>
                            <a id="login-button" href="/login">Login</a>
                        </div>
                    </label>
                @endguest
                <div class="space-20px"></div>
                {{-- @auth()
                    <div class="space-20px"></div>
                    <div class="space-20px"></div>
                    <svg width="50px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <text x="-13" y="18" fill="green" font-weight="500">
                            ${{ round(Auth::user()->credit, 2) }} </text>
                    </svg>
                @endauth --}}
                <div class="user">
                    @auth
										@if(filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL))
											<img style="border-radius: 50%;" width="24px" height="24px" src="{{ 
											Auth::user()->avatar }}" alt="user-avtar">
										@else 
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M12,24 C18.627417,24 24,18.627417 24,12 C24,5.372583 18.627417,0 12,0 C5.372583,0 0,5.372583 0,12 C0,18.627417 5.372583,24 12,24 Z"
                                id="Path" fill="#979797" fill-rule="nonzero" opacity="0.469866071"/>
                            <path
                                d="M0.521006905,15.5084303 L2.22182541,13.8076118 L5.75735931,10.2720779 C6.92893219,9.10050506 8.82842712,9.10050506 10,10.2720779 L13.5308888,13.8029668 L20.3481586,20.6202366 C18.1882767,22.712365 15.24451,24 12,24 C6.59320039,24 2.02157722,20.4241846 0.521006905,15.5084303 Z"
                                id="Combined-Shape" fill="#979797" fill-rule="nonzero"/>
                            <path
                                d="M8.85600124,23.5839233 L5.27207794,20 C4.10050506,18.8284271 4.10050506,16.9289322 5.27207794,15.7573593 L10.2218254,10.8076118 L13.7573593,7.27207794 C14.9289322,6.10050506 16.8284271,6.10050506 18,7.27207794 L21.5308888,10.8029668 L23.9395859,13.2116639 C23.3321184,19.2700592 18.2184276,24 12,24 C10.9121183,24 9.85804786,23.8552369 8.85600124,23.5839233 Z"
                                id="Combined-Shape" fill="#979797" fill-rule="nonzero" opacity="0.532133557"/>
                        </svg>
										@endif
                    @endauth
                    @guest
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M12,24 C18.627417,24 24,18.627417 24,12 C24,5.372583 18.627417,0 12,0 C5.372583,0 0,5.372583 0,12 C0,18.627417 5.372583,24 12,24 Z"
                                id="Path" fill="#979797" fill-rule="nonzero" opacity="0.469866071"/>
                            <path
                                d="M0.521006905,15.5084303 L2.22182541,13.8076118 L5.75735931,10.2720779 C6.92893219,9.10050506 8.82842712,9.10050506 10,10.2720779 L13.5308888,13.8029668 L20.3481586,20.6202366 C18.1882767,22.712365 15.24451,24 12,24 C6.59320039,24 2.02157722,20.4241846 0.521006905,15.5084303 Z"
                                id="Combined-Shape" fill="#979797" fill-rule="nonzero"/>
                            <path
                                d="M8.85600124,23.5839233 L5.27207794,20 C4.10050506,18.8284271 4.10050506,16.9289322 5.27207794,15.7573593 L10.2218254,10.8076118 L13.7573593,7.27207794 C14.9289322,6.10050506 16.8284271,6.10050506 18,7.27207794 L21.5308888,10.8029668 L23.9395859,13.2116639 C23.3321184,19.2700592 18.2184276,24 12,24 C10.9121183,24 9.85804786,23.8552369 8.85600124,23.5839233 Z"
                                id="Combined-Shape" fill="#979797" fill-rule="nonzero" opacity="0.532133557"/>
                        </svg>
                    @endguest
                    @auth()
                        <div class="user-dropdown">
                            <p class="text-success">Welcome back,</p>
                            <span class="mb-3">{{ Auth::user()->name }}</span>
                            <div class="mb-3">
                                Balance:<span class="text-danger"> ${{ round(Auth::user()->credit, 2) }} </span>
                            </div>
                            <div class="mb-3"
                                 onclick="copyMessage('{{ Auth::user()->id }}')">
                                Your ID: {{ Auth::user()->id }}
                            </div>
                            {{-- <div  class="mb-3">
                                Role
                                : {{ config('const.role_member.icon')[array_search($role['role'], config('const.role_member.member_status'), true)] }}
                            </div> --}}
                            {{-- <div  class="mb-3">
                                Consumption : ${{ round($role['totalMoney'], 2) }}
                            </div> --}}
                            <div
                                onclick="copyMessage('Your referral link: {{request()->getHost() }}/?ref={{ Auth::user()->id }}')"
                                 class="mb-3">
                                Link invite
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-primary">Logout</button>
                            </div>                         
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <div class="content-view">
            <?php $header = \App\Option::where("option", "discord_channel")
              ->get()
              ->first(); ?>
            @if(isset($header->value))
                <style>
                    #notice {
                        background: #3d7fff;
                        color: white;
                        font-weight: 700;
                        align-items: flex-start;
                    }

                    #notice p {
                        margin: 10px;
                        font-size: unset;
                    }

                    #notice .material-icons {
                        margin: 10px;
                        align-items: self-start;
                    }
                </style>
                @php
                    $notice =\App\Option::where('option', 'header_notice')->get()->first();
                    if($notice) {
                        $notice = trim($notice->value);
                    }
                @endphp

                @if ($notice) 
                    <div id="notice" style="display: none">
                        <div style="width: 100%; text-align: center" class="blink">
                            {!! $notice !!}
                        </div>
                        <span style="font-size: 25px; " onclick="hideNotice()">
                        <i class="material-icons dp48">highlight_off</i>
                    </span>
                    </div>
                @endif

            @endif
            <div class="card-container content">
                @yield('content')
            </div>

            @if(\App\Option::where("option", "footer")->get("value")->first()["value"] == "1")
                <div class="footer">
                    <div>
                        <h5>About us</h5>
                        <div>
                            {{$master_site_settings['about_us'] ?? ''}}
                        </div>
                    </div>
                    <div class="space-20px"></div>
                    <div>
                        <h5>For support: </h5>
                        Email : {{$master_site_settings['for_support'] ?? ''}}<br>
                        <br>
                        <h5>Verified Seller By</h5>
                        @if(isset($master_site_settings['verified_seller_url']))
                            {!! html_entity_decode(
                            Html::link(
                                $master_site_settings['verified_seller_url'],
                                Html::image(
                                    '/images/logo/' . $master_site_settings['verified_seller_logo'],
                                    'Home Page',
                                    [
                                        'class' => 'img-fluid',
                                        'alt' => 'seller',
                                        'width' => 100
                                    ]
                                )
                            )
                        ) !!}
                        @endif

                    </div>
                    <div class="space-20px"></div>
                    <div>
                        <div>
                            <p>
                                <img alt="Visa.png"
                                     style="height: auto;" width="64"
                                     src="{{ asset('img/visa.png') }}">
                                &nbsp;&nbsp;
                                <img alt="Mastercard.png" style="height: auto;" width="50"
                                     src="{{ asset('img/master-card.png') }}">
                                &nbsp;&nbsp;
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@auth()
    @if(\App\Blacklist::where('email', Auth::user()->email)->get()->first() == null)
        @include('new.coin-popup')
        @include('new.seller-payment')
        @include("new.stripe-popup")
        @include('new.lexholding-popup')
        <script !src="">
            function createPayment() {
                window.open('https://securemods.com/payment?id=' + '{{Auth::user()->id}}', 'Dynamic Popup', 'height=50%', 'width="50%')
            }
        </script>
    @endif
@endauth

@include('new.scrip')
<div id="cart" class="modal fade">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-hover table-bordered" id="shopping_cart">
                <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Game Name</th> --}}
                    <th>Tool Name</th>
                    <th>Package Name</th>
                    <th>Count</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="d-flex" style="align-items: center; justify-content: space-between">
                <a class="" >
                    <b>Total Amount:</b> 
                    <span id="total-amount"></span></a>
                            
                <a class="cursor-pointer" id="checkout">
                    <i style="font-size: 30px"  class="small material-icons right">payment</i>
                </a>
            </div>
            
        </div>
            
        </div>
    
    </div>
</div>

@auth
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {};
        Tawk_API.visitor = {
            name: '{{ Auth::user()->name.' - ID '.Auth::user()->id }}',
            email: '{{ Auth::user()->email }}'
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
    <script !src="">
        $(".btn-quick-recharge").click(function (e) {
            M.Modal.getInstance($('#paypal-popup')).open()
            let value = $(e.currentTarget).find('label').text();
            $('#paypal_amount').val(Number(value));
            M.updateTextFields();
            Ns
            let event = new Event('change')
            $('#paypal_amount')[0].dispatchEvent(event)
        })
        $(document).ready(function () {
            if ($('body').data('theme') == 'dark') {
                $('#themeSwitch').prop('checked', true);
            }
        });
        $('#themeSwitch').on('change', function (event) {
            if (event.target.checked) {
                document.body.setAttribute('data-theme', 'dark');
                let d = new Date();
                d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
                let expires = "expires=" + d.toUTCString();
                document.cookie = "theme=dark" + ";" + expires + ";path=/";
            } else {
                document.body.removeAttribute('data-theme');
                document.cookie = 'theme=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }
        });
    </script>
@endauth

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        function formatCurency(n) {
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }

        function getListItemCart(carts, flag) {
            if (carts) {
                $('.notification-badge').text(carts.length)
                $('#shopping_cart tbody').empty()

                $.each(carts, function (key, value) {

                    $('#shopping_cart tbody').append(
                        '<tr> <td><label><input class="check-item" type="checkbox" ' + value.status + ' value="' + value.id + '"><span class="slider round"></span></label></td>  <td>' + value.name_tool + '</td> <td>'
                        + value.package_name + '</td>  <td width="80"><input type="number" class="package-count" min="1" data-id="' + value.id + '" value="' + value.count + '"></td>  <td>' + value.amount + '</td> <td>'
                        + `<a class="btn-floating " data-index="${value.id}"><i class="text-danger material-icons cursor-pointer">delete</i></a>`
                        + '</td></tr>');
                })

            } else {
                if (flag) {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Shopping cart empty!',
                        icon: 'warning'
                    })

                }
            }
        }

        // check count item cart
        let carts = JSON.parse(localStorage.getItem('cartItem'))
        let total_amount = 0
        $('#total-amount').text(total_amount)
        getTotalAmount()
        if (carts) {
            $('.notification-badge').text(carts.length)
        } else {
            $('.notification-badge').text(0)
        }

        // click icon shopping cart
        $(".shopping-cart").click(function (e) {
            let carts = JSON.parse(localStorage.getItem('cartItem'))
            if (carts && carts.length) {
                getListItemCart(carts, true)
                getTotalAmount()
            } else {
                Swal.fire({
                    title: 'Warning',
                    text: 'Shopping cart empty!',
                    icon: 'warning'
                })

            }

        });

        function removeItemFromCart(params) {
            let carts = JSON.parse(localStorage.getItem('cartItem'))
            console.log("carts>>>", carts)
            params.map(function (item) {
                carts = carts.filter(ele => ele.id != item.id)
                console.log("item>>>", item.id)
                console.log("carts>>>", carts)
            })
            // set cart to local storage
            localStorage.setItem('cartItem', JSON.stringify(carts))
            // update count item
            if (carts && carts.length) {
                $('.notification-badge').html(carts.length)
            } else {
                $('.notification-badge').html(0)
            }
            // load data table
            getListItemCart(carts, false)
            getTotalAmount()
        }

        // click check out cart
        $("#checkout").click(function (e) {
            @auth()
            let balance = '{{ round(Auth::user()->credit, 2) }}'
            if (balance < total_amount) {
                Swal.fire({
                    title: 'Warning',
                    text: 'Your balance is not enough!',
                    icon: 'warning'
                })
                return
            }
            // call ajax method post
            let url = "{{route('tool.buy-tool-cart')}}";
            let params = JSON.parse(localStorage.getItem('cartItem'))
            params = params.filter(ele => ele.status == 'checked')

            Swal.fire({
                title: 'Now loading',
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            })

            if (!params.length) {
                Swal.fire({
                    title: 'Error',
                    text: "Please choose package!",
                    icon: 'error'
                });
            }

            $.ajax({
                url: url,
                data: JSON.stringify(params),
                method: "POST",
                contentType: 'application/json',
                success: function (response) {
                    Swal.close();
                    response = JSON.parse(response)
                    if (response.status === "success") {
                        Swal.fire({
                            title: 'Success',
                            text: "Checkout success",
                            icon: 'success'
                        });
                        //update item in cart
                        removeItemFromCart(params)
                    } else {
                        Swal.fire({
                            title: 'Error',
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
                }, error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            })
            @endauth
            @guest()
            Swal.fire({
                title: 'Warning',
                text: 'Please login',
                icon: 'error'
            })
            window.location = "{{url('login')}}";
            @endguest
        });

        function getTotalAmount() {
            let carts = JSON.parse(localStorage.getItem('cartItem'))
            let total_amount2 = 0
            $.each(carts, function (key, value) {
                if (value.status == 'checked') {
                    total_amount2 = total_amount2 + value.price * value.count;
                }
            })
            $('#total-amount').text(total_amount2)
            total_amount = total_amount2
        }

        // check checkbox item
        $("#shopping_cart").on('click', '.check-item', function () {
            let index = $(this).val()

            let carts = JSON.parse(localStorage.getItem('cartItem'))
            carts.map(function (value) {
                if (value.id == index) {
                    if (value.status == 'uncheck') {
                        value.status = 'checked'
                    } else {
                        value.status = 'uncheck'
                    }
                }
                return value
            })
            localStorage.setItem('cartItem', JSON.stringify(carts))
            getTotalAmount()
        })

        // click delete item
        $("#shopping_cart").on('click', '.act-delete', function () {
            let index = $(this).data("index")
            if (index !== -1) {
                let carts = JSON.parse(localStorage.getItem('cartItem'))
                // remote item delete
                carts = carts.filter(ele => ele.id != index)
                // set cart to local storage
                localStorage.setItem('cartItem', JSON.stringify(carts))
                // update count item
                if (carts && carts.length) {
                    $('.notification-badge').html(carts.length)
                } else {
                    $('.notification-badge').html(0)
                }
                // load data table
                getListItemCart(carts, false)
                getTotalAmount()
            }
        });

        // check checkbox item
        $("#shopping_cart").on('keyup change', '.package-count', function () {
            let count = $(this).val() || 0
            let index = $(this).data('id')
            let carts = JSON.parse(localStorage.getItem('cartItem'))
            let itemChanged = carts.find(e => e.id == index)
            let priceChanged = count * itemChanged.price
            $(this).parent().next().text(priceChanged)
            carts.map(function (value) {
                if (value.id == index) {
                    value.count = count
                    value.amount = value.price * value.count
                }
                return value
            })
            localStorage.setItem('cartItem', JSON.stringify(carts))
            console.log("index>>>", index)
            console.log("count>>>", count)
            // update count item
            if (carts && carts.length) {
                $('.notification-badge').html(carts.length)
            } else {
                $('.notification-badge').html(0)
            }
            getTotalAmount()
        })

    });
</script>

@yield('script')
