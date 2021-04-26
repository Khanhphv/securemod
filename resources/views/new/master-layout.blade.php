<style>
                .text-logo *{
                    font-size: 25px
                }
                @media only screen and (max-width: 600px) {
                    .text-logo {
                        display: none;
                    }
                    .item-discription {
                        height: 250px;
                    }
                    .container .menu-mobile-container{
                        height: 100%;
                        position: relative;
                        overflow: auto;
                    }
                }
            </style>
        <div class="container">
            <div class="menu-mobile-container" style="display: none!important;">
                <div class="title-icon">
                    Menu
                    <span class="close-icon">
                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <path
                                d="M2,7 L14,7 C14.5522847,7 15,7.44771525 15,8 C15,8.55228475 14.5522847,9 14,9 L2,9 C1.44771525,9 1,8.55228475 1,8 C1,7.44771525 1.44771525,7 2,7 Z M8,8 L14,8 L8,8 Z"
                                id="Rectangle" fill-rule="nonzero"
                                transform="translate(8.000000, 8.000000) rotate(-135.000000) translate(-8.000000, -8.000000) " />
                            <path
                                d="M2,7 L14,7 C14.5522847,7 15,7.44771525 15,8 C15,8.55228475 14.5522847,9 14,9 L2,9 C1.44771525,9 1,8.55228475 1,8 C1,7.44771525 1.44771525,7 2,7 Z M8,8 L14,8 L8,8 Z"
                                id="Rectangle" fill-rule="nonzero"
                                transform="translate(8.000000, 8.000000) rotate(-45.000000) translate(-8.000000, -8.000000) " />
                        </svg>
                    </span>
                </div>
                <div class="space-height-20px"></div>
                <div class="space-height-20px"></div>
                <div class="user-mobile">
                    <div>
                        <p>Welcome back,</p>
                        @auth()
                        <span>{{ Auth::user()->name }}</span>
                        @endauth
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center;">
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero"></path>
                            </svg>
                            <div class="space-20px"></div>
                            @auth()
                            {{ round(Auth::user()->credit, 2) }} USD
                            @endauth
                        </div>
                        {{-- <div class="btn-rechange-mobile modal-trigger" href="#paypal-popup">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <path
                                    d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                    id="Path" fill-rule="nonzero"></path>
                                <path
                                    d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                    id="Path" fill-rule="nonzero"
                                    transform="translate(12.000000, 12.000000) rotate(-195.000000) translate(-12.000000, -12.000000) ">
                                </path>
                                <path
                                    d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                    id="Path" fill-rule="nonzero"></path>
                                <path
                                    d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                    id="Path" fill-rule="nonzero"
                                    transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) ">
                                </path>
                            </svg>
                        </div> --}}
                    </div>
                </div>
                <div class="space-height-20px"></div>
                @auth()
                @if(\App\Option::where('option', 'paypal_payment')->get()->first()->value != 0)
                <a onclick="createPayment()" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <img width="24px" src="https://img.icons8.com/pastel-glyph/64/000000/money--v3.png"/>
                        <div class="space-20px"></div>
                        Paypal Recharge
                    </div>
                </a>
                <div class="space-height-20px"></div>
                @endif
                <div class="border-bottom-2px"></div>
                @if(\App\Option::where('option', 'coin_payment')->get()->first()->value != 0)
                <div class="space-height-20px"></div>
                <a href="#coin-popup" class="title-icon modal-trigger">
                    <div style="display: flex; align-items: center;">
                        <img width="24px" src="https://img.icons8.com/cotton/64/000000/money-circulation--v1.png"/>
                        <div class="space-20px"></div>
                        Coin Recharge
                    </div>
                </a>
                @endif

                <div class="space-height-20px"></div>
                @if(\App\Option::where('option', 'seller_payment')->get()->first()->value != 0)
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                <a href="#seller-payment" class="title-icon modal-trigger">
                    <div style="display: flex; align-items: center;">
                        <img width="50px" src="{{ asset('img/SellerPaypal.svg') }}"/>
                        <div class="space-20px"></div>
                        Recharge via seller
                    </div>
                </a>
                @endif
                <div class="space-height-20px"></div>
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                @endauth
                <a href="/home" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <svg class="active" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M2,0 L22,0 C23.1045695,-2.02906125e-16 24,0.8954305 24,2 L24,9 C24,10.1045695 23.1045695,11 22,11 L2,11 C0.8954305,11 1.3527075e-16,10.1045695 0,9 L0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M2,13 L12,13 C13.1045695,13 14,13.8954305 14,15 L14,22 C14,23.1045695 13.1045695,24 12,24 L2,24 C0.8954305,24 1.3527075e-16,23.1045695 0,22 L0,15 C-1.3527075e-16,13.8954305 0.8954305,13 2,13 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M18,13 L22,13 C23.1045695,13 24,13.8954305 24,15 L24,22 C24,23.1045695 23.1045695,24 22,24 L18,24 C16.8954305,24 16,23.1045695 16,22 L16,15 C16,13.8954305 16.8954305,13 18,13 Z"
                                id="Path" fill-rule="nonzero" />
                        </svg>
                        <div class="space-20px"></div>
                        Home
                    </div>
                </a>
                <div class="space-height-20px"></div>
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                <a href="/balance" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                            <path
                                d="M5,6 L8,6 C8.55228475,6 9,6.44771525 9,7 L9,20 C9,20.5522847 8.55228475,21 8,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,7 C4,6.44771525 4.44771525,6 5,6 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M16,3 L19,3 C19.5522847,3 20,3.44771525 20,4 L20,17 C20,17.5522847 19.5522847,18 19,18 L16,18 C15.4477153,18 15,17.5522847 15,17 L15,4 C15,3.44771525 15.4477153,3 16,3 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(17.500000, 10.500000) rotate(-180.000000) translate(-17.500000, -10.500000) " />
                            <path
                                d="M6.07335908,0.739274995 C6.26832389,0.420241668 6.73167611,0.420241668 6.92664092,0.739274995 L12.4266409,9.739275 C12.6302488,10.0724516 12.3904649,10.5 12,10.5 L1,10.5 C0.609535124,10.5 0.36975117,10.0724516 0.573359083,9.739275 L6.07335908,0.739274995 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M17.0733591,13.739275 C17.2683239,13.4202417 17.7316761,13.4202417 17.9266409,13.739275 L23.4266409,22.739275 C23.6302488,23.0724516 23.3904649,23.5 23,23.5 L12,23.5 C11.6095351,23.5 11.3697512,23.0724516 11.5733591,22.739275 L17.0733591,13.739275 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(17.500000, 18.500000) rotate(-180.000000) translate(-17.500000, -18.500000) " />
                        </svg>
                        <div class="space-20px"></div>
                        Transaction History
                    </div>
                </a>
                <div class="space-height-20px"></div>
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                <a href="/keys" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M12,3 C15.0375661,3 17.5,5.46243388 17.5,8.5 L17.5,17.5 C17.5,20.5375661 15.0375661,23 12,23 C8.96243388,23 6.5,20.5375661 6.5,17.5 L6.5,8.5 L4.5,8.5 L4.5,17.5 C4.5,21.6421356 7.85786438,25 12,25 C16.1421356,25 19.5,21.6421356 19.5,17.5 L19.5,8.5 C19.5,4.35786438 16.1421356,1 12,1 L12,3 Z"
                                id="Rectangle" fill-rule="nonzero"
                                transform="translate(12.000000, 13.000000) rotate(-180.000000) translate(-12.000000, -13.000000) ">
                            </path>
                            <path
                                d="M5,9 L19,9 C20.6568542,9 22,10.3431458 22,12 L22,21 C22,22.6568542 20.6568542,24 19,24 L5,24 C3.34314575,24 2,22.6568542 2,21 L2,12 C2,10.3431458 3.34314575,9 5,9 Z"
                                id="Path" fill-rule="nonzero"></path>
                            <path
                                d="M12,14 C13.3807119,14 14.5,15.1192881 14.5,16.5 C14.5,17.8807119 13.3807119,19 12,19 C10.6192881,19 9.5,17.8807119 9.5,16.5 C9.5,15.1192881 10.6192881,14 12,14 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero"></path>
                        </svg>
                        <div class="space-20px"></div>
                        Key Purchased
                    </div>
                </a>
                <div class="space-height-20px"></div>
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                <a href="/keys" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M12,14 C13.3807119,14 14.5,15.1192881 14.5,16.5 C14.5,17.8807119 13.3807119,19 12,19 C10.6192881,19 9.5,17.8807119 9.5,16.5 C9.5,15.1192881 10.6192881,14 12,14 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                            <path
                                d="M9.5,24 C14.7467051,24 19,19.7467051 19,14.5 C19,9.25329488 14.7467051,5 9.5,5 C4.25329488,5 0,9.25329488 0,14.5 C0,19.7467051 4.25329488,24 9.5,24 Z"
                                id="Path" fill-rule="nonzero" opacity="0.394647507" />
                            <path
                                d="M13.5,21 C19.2989899,21 24,16.2989899 24,10.5 C24,4.70101013 19.2989899,0 13.5,0 C7.70101013,0 3,4.70101013 3,10.5 C3,16.2989899 7.70101013,21 13.5,21 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(13.500000, 10.500000) rotate(-315.000000) translate(-13.500000, -10.500000) " />
                            <path
                                d="M10.6322892,9.71085659 C11.7368587,9.71085659 12.6322892,8.81542608 12.6322892,7.71085659 C12.6322892,6.60628709 11.7368587,5.71085659 10.6322892,5.71085659 C9.52771967,5.71085659 8.63228917,6.60628709 8.63228917,7.71085659 C8.63228917,8.81542608 9.52771967,9.71085659 10.6322892,9.71085659 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                transform="translate(10.632289, 7.710857) rotate(-315.000000) translate(-10.632289, -7.710857) " />
                            <path
                                d="M10.6322892,8.71085659 C10.0800044,8.71085659 9.63228917,8.26314134 9.63228917,7.71085659 C9.63228917,7.15857184 10.0800044,6.71085659 10.6322892,6.71085659 C11.1845739,6.71085659 11.6322892,7.15857184 11.6322892,7.71085659 C11.6322892,8.26314134 11.1845739,8.71085659 10.6322892,8.71085659 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(10.632289, 7.710857) rotate(-315.000000) translate(-10.632289, -7.710857) " />
                            <path
                                d="M16.2891434,15.3677108 C17.3937129,15.3677108 18.2891434,14.4722803 18.2891434,13.3677108 C18.2891434,12.2631413 17.3937129,11.3677108 16.2891434,11.3677108 C15.1845739,11.3677108 14.2891434,12.2631413 14.2891434,13.3677108 C14.2891434,14.4722803 15.1845739,15.3677108 16.2891434,15.3677108 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                transform="translate(16.289143, 13.367711) rotate(-315.000000) translate(-16.289143, -13.367711) " />
                            <path
                                d="M16.2891434,14.3677108 C15.7368587,14.3677108 15.2891434,13.9199956 15.2891434,13.3677108 C15.2891434,12.8154261 15.7368587,12.3677108 16.2891434,12.3677108 C16.8414282,12.3677108 17.2891434,12.8154261 17.2891434,13.3677108 C17.2891434,13.9199956 16.8414282,14.3677108 16.2891434,14.3677108 Z"
                                id="Path" fill="#979797" fill-rule="nonzero"
                                transform="translate(16.289143, 13.367711) rotate(-315.000000) translate(-16.289143, -13.367711) " />
                            <path
                                d="M13,6.05555556 L13,14.9444444 C13,15.2205868 13.2238576,15.4444444 13.5,15.4444444 C13.7761424,15.4444444 14,15.2205868 14,14.9444444 L14,6.05555556 C14,5.77941318 13.7761424,5.55555556 13.5,5.55555556 C13.2238576,5.55555556 13,5.77941318 13,6.05555556 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                transform="translate(13.500000, 10.500000) rotate(-315.000000) translate(-13.500000, -10.500000) " />
                        </svg>
                        <div class="space-20px"></div>
                        Commisstion 5%
                    </div>
                </a>
                <div class="space-height-20px"></div>
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                <a href="/terms-of-services" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M6,0 L13,0 L18,0 C19.6568542,-3.04359188e-16 21,1.34314575 21,3 L21,7.9934309 L21,21 C21,22.6568542 19.6568542,24 18,24 L6,24 C4.34314575,24 3,22.6568542 3,21 L3,3 C3,1.34314575 4.34314575,3.04359188e-16 6,0 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M7.51158831,5 L13.5,5 C13.7761424,5 14,4.77614237 14,4.5 C14,4.22385763 13.7761424,4 13.5,4 L7.51158831,4 C7.23544593,4 7.01158831,4.22385763 7.01158831,4.5 C7.01158831,4.77614237 7.23544593,5 7.51158831,5 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                            <path
                                d="M7.51158831,9 L16.5,9 C16.7761424,9 17,8.77614237 17,8.5 C17,8.22385763 16.7761424,8 16.5,8 L7.51158831,8 C7.23544593,8 7.01158831,8.22385763 7.01158831,8.5 C7.01158831,8.77614237 7.23544593,9 7.51158831,9 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                            <path
                                d="M7.51158831,13 L16.5,13 C16.7761424,13 17,12.7761424 17,12.5 C17,12.2238576 16.7761424,12 16.5,12 L7.51158831,12 C7.23544593,12 7.01158831,12.2238576 7.01158831,12.5 C7.01158831,12.7761424 7.23544593,13 7.51158831,13 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                            <path
                                d="M13.5,20 L16.5,20 C16.7761424,20 17,19.7761424 17,19.5 C17,19.2238576 16.7761424,19 16.5,19 L13.5,19 C13.2238576,19 13,19.2238576 13,19.5 C13,19.7761424 13.2238576,20 13.5,20 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                        </svg>
                        <div class="space-20px"></div>
                        Terms of services
                    </div>
                </a>
                <div class="space-height-20px"></div>
                <div class="border-bottom-2px"></div>
                <div class="space-height-20px"></div>
                @auth()
                <a href="/logout" class="title-icon">
                    <div style="display: flex; align-items: center;">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                            <path
                                d="M12,23.5 C18.3512746,23.5 23.5,18.3512746 23.5,12 C23.5,5.64872538 18.3512746,0.5 12,0.5 C5.64872538,0.5 0.5,5.64872538 0.5,12 C0.5,18.3512746 5.64872538,23.5 12,23.5 Z"
                                id="Path" fill-rule="nonzero" opacity="0.768391927" />
                            <path
                                d="M12,19.5 C16.1421356,19.5 19.5,16.1421356 19.5,12 C19.5,7.85786438 16.1421356,4.5 12,4.5 C7.85786438,4.5 4.5,7.85786438 4.5,12 C4.5,12.2761424 4.72385763,12.5 5,12.5 C5.27614237,12.5 5.5,12.2761424 5.5,12 C5.5,8.41014913 8.41014913,5.5 12,5.5 C15.5898509,5.5 18.5,8.41014913 18.5,12 C18.5,15.5898509 15.5898509,18.5 12,18.5 C11.7238576,18.5 11.5,18.7238576 11.5,19 C11.5,19.2761424 11.7238576,19.5 12,19.5 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                transform="translate(12.000000, 12.000000) rotate(-225.000000) translate(-12.000000, -12.000000) " />
                            <path
                                d="M8.5,7 L15.5,7 C15.7761424,7 16,7.22385763 16,7.5 C16,7.77614237 15.7761424,8 15.5,8 L8.5,8 C8.22385763,8 8,7.77614237 8,7.5 C8,7.22385763 8.22385763,7 8.5,7 Z"
                                id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                transform="translate(12.000000, 7.500000) rotate(-270.000000) translate(-12.000000, -7.500000) " />
                        </svg>
                        <div class="space-20px"></div>
                        Logout
                    </div>
                </a>
                @endauth
                @guest()
                    <a href="/login" class="title-icon">
                        <div style="display: flex; align-items: center;">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <path
                                    d="M12,23.5 C18.3512746,23.5 23.5,18.3512746 23.5,12 C23.5,5.64872538 18.3512746,0.5 12,0.5 C5.64872538,0.5 0.5,5.64872538 0.5,12 C0.5,18.3512746 5.64872538,23.5 12,23.5 Z"
                                    id="Path" fill-rule="nonzero" opacity="0.768391927" />
                                <path
                                    d="M12,19.5 C16.1421356,19.5 19.5,16.1421356 19.5,12 C19.5,7.85786438 16.1421356,4.5 12,4.5 C7.85786438,4.5 4.5,7.85786438 4.5,12 C4.5,12.2761424 4.72385763,12.5 5,12.5 C5.27614237,12.5 5.5,12.2761424 5.5,12 C5.5,8.41014913 8.41014913,5.5 12,5.5 C15.5898509,5.5 18.5,8.41014913 18.5,12 C18.5,15.5898509 15.5898509,18.5 12,18.5 C11.7238576,18.5 11.5,18.7238576 11.5,19 C11.5,19.2761424 11.7238576,19.5 12,19.5 Z"
                                    id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                    transform="translate(12.000000, 12.000000) rotate(-225.000000) translate(-12.000000, -12.000000) " />
                                <path
                                    d="M8.5,7 L15.5,7 C15.7761424,7 16,7.22385763 16,7.5 C16,7.77614237 15.7761424,8 15.5,8 L8.5,8 C8.22385763,8 8,7.77614237 8,7.5 C8,7.22385763 8.22385763,7 8.5,7 Z"
                                    id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                    transform="translate(12.000000, 7.500000) rotate(-270.000000) translate(-12.000000, -7.500000) " />
                            </svg>
                            <div class="space-20px"></div>
                            Login
                        </div>
                    </a>
                @endguest
            </div>
            <div class="slide-container" style="display: none!important;">
                <div class="slide-bar">
                    <div>
                        <div class="title-icon">
                            Detail game
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="img-detail" style="background-image: url(./img/Contract-Wars.jpg);">
                            <div>
                            <span>America's Army:
                                Proving Grounds PREMIUM</span>
                                <p>INCEPTION</p>
                            </div>
                            <div class="btn-white">
                                Buy now
                            </div>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="img-detail" style="background-image: url(./img/Contract-Wars.jpg);">
                            <div>
                            <span>America's Army:
                                Proving Grounds PREMIUM</span>
                                <p>INCEPTION</p>
                            </div>
                            <div class="btn-white">
                                Buy now
                            </div>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>
                        <div class="title-icon">
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>

                                Status
                            </div>
                            <svg width="16px" height="16px" viewBox="0 0 16 16">
                                <path
                                    d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                    id="Path" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="space-height-20px"></div>
                        <div class="border-bottom-2px"></div>
                        <div class="space-height-20px"></div>

                    </div>
                </div>
            </div>
            <div class="menu" style="box-shadow: 1px 1px 10px #afafaf">
                <div>
                    <svg class="icon-menu" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <a xlink:href="/home">
                            <path
                                d="M6.37871478,9 L12,4.43270576 L19.0541111,10.164171 C19.697065,10.686571 20.641771,10.5888428 21.164171,9.94588894 C21.686571,9.30293505 21.5888428,8.35822904 20.9458889,7.835829 L12.9458889,1.335829 C12.3947849,0.888057 11.6052151,0.888057 11.0541111,1.335829 L3.05411106,7.835829 C2.31529631,8.43611598 2.31529631,9.56388402 3.05411106,10.164171 L11.0541111,16.664171 C11.697065,17.186571 12.641771,17.0888428 13.164171,16.4458889 C13.686571,15.802935 13.5888428,14.858229 12.9458889,14.335829 L6.37871478,9 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M6.37871478,15.5 L12,10.9327058 L19.0541111,16.664171 C19.697065,17.186571 20.641771,17.0888428 21.164171,16.4458889 C21.686571,15.802935 21.5888428,14.858229 20.9458889,14.335829 L12.9458889,7.835829 C12.3947849,7.388057 11.6052151,7.388057 11.0541111,7.835829 L3.05411106,14.335829 C2.31529631,14.936116 2.31529631,16.063884 3.05411106,16.664171 L11.0541111,23.164171 C11.697065,23.686571 12.641771,23.5888428 13.164171,22.9458889 C13.686571,22.302935 13.5888428,21.358229 12.9458889,20.835829 L6.37871478,15.5 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(12.000024, 15.500024) rotate(-180.000000) translate(-12.000024, -15.500024) " />
                        </a>
                    </svg>
                    <div class="space-20px desktop"></div>
                    <div class="space-20px"></div>
                    <div style="color: var(--text-primary-color); padding-right: 1em" class="text-logo">
                        <a href="/home">
                            <b>SECURE</b>
                            CHEATS
                        </a>
                    </div>
                    <div class="space-20px desktop"></div>
                    <div class="space-20px desktop"></div>
                    <select id="selectbox-games" class="browser-default"  onchange="handleSelectGame(event)">
                        <option value="">Choose game</option>
                        @foreach($allGames as $game)
                            <option value="{{ $game->slug }}" >{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="desktop">
                    @auth()
                    <div class="space-20px"></div>
                    <div class="border-right-2px" style="height: 40px;"></div>
                    <div class="btn-rechange">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(12.000000, 12.000000) rotate(-195.000000) translate(-12.000000, -12.000000) " />
                            <path
                                d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                id="Path" fill-rule="nonzero" />
                            <path
                                d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                id="Path" fill-rule="nonzero"
                                transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " />
                        </svg>
                        <div class="space-20px"></div>
                        Recharge
                        <div class="user-dropdown">
                            <span>Payment</span>
                            <div class="space-height-20px"></div>
                            <div class="border-bottom-2px"></div>
                            @auth
                                @if(\App\Option::where('option', 'paypal_payment')->get()->first()->value != 0)
                                <div class="space-height-20px"></div>
                                <div style="display: flex; align-items: center;">
                                    <a onclick="createPayment()" class="waves-effect waves-light btn-large"
                                       style="background: white; width: 150px;">
                                        <img   style="width: 120%;height: 100%; left: -8px"
                                             src="https://www.paypalobjects.com/checkoutweb/release/hermione/media/logo.7e5b43e3.svg"
                                             alt="paypal-payment">
                                    </a>
                                </div>
                                @endif
                                @if(\App\Option::where('option', 'coin_payment')->get()->first()->value != 0)
                                <div class="space-height-20px"></div>
                                <div style="display: flex; align-items: center;">
                                    <a class="waves-effect waves-light btn-large modal-trigger" href="#coin-popup"
                                       style="background: white; width: 150px;">
                                        <img style="width: 135%; left: -14px; top: 3px" src="{{ asset('img/coinpayment.png') }}" alt="coin-payment">
                                    </a>
                                </div>
                                @endif
                                @if(\App\Option::where('option', 'seller_payment')->get()->first()->value != 0)
                                <div class="space-height-20px"></div>
                                <div style="display: flex; align-items: center;">
                                    <a target="blank" class="waves-effect waves-light btn-large modal-trigger" href="#seller-payment"
                                       style="background: white; width: 150px;">
                                        <img style="height: -webkit-fill-available; width: 100%" src="{{ asset('img/SellerPaypal.svg')}}" alt="seller-payment">
                                    </a>
                                </div>
                                @endif
                                @if(\App\Option::where('option', 'stripe_payment')->get()->first()->value != 0)
                                <div class="space-height-20px"></div>
                                <div style="display: flex; align-items: center;">
                                    <a target="blank" class="waves-effect waves-light btn-large modal-trigger" href="#stripe-popup"
                                       style="background: white; width: 150px;">
                                        <img style="height: -webkit-fill-available" src="{{ asset('img/stripe.png')}}" alt="stripe-popup">
                                    </a>
                                </div>
                                @endif


                            @endauth

                        </div>
                    </div>
                    @endauth
                    @guest()
                        <a id="" href="/login" style="display: none">Login</a>
                        <label for="login-button">
                            <div onclick="login()" class="btn-rechange">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <path
                                        d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M12,21.5 C17.2467051,21.5 21.5,17.2467051 21.5,12 C21.5,6.75329488 17.2467051,2.5 12,2.5 C6.75329488,2.5 2.5,6.75329488 2.5,12 L3.5,12 C3.5,7.30557963 7.30557963,3.5 12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 L12,21.5 Z"
                                        id="Path" fill-rule="nonzero"
                                        transform="translate(12.000000, 12.000000) rotate(-195.000000) translate(-12.000000, -12.000000) " />
                                    <path
                                        d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M8,11 L16,11 C16.5522847,11 17,11.4477153 17,12 C17,12.5522847 16.5522847,13 16,13 L8,13 C7.44771525,13 7,12.5522847 7,12 C7,11.4477153 7.44771525,11 8,11 Z"
                                        id="Path" fill-rule="nonzero"
                                        transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " />
                                </svg>
                                <div class="space-20px"></div>
                                <a id="login-button" href="/login">Login</a>
                            </div>
                        </label>
                        @endguest
                    <div class="space-20px"></div>
                    <div class="border-right-2px" style="height: 40px;"></div>

                    @auth()
                        <div class="space-20px"></div>
                        <div class="space-20px"></div>
                        <svg width="50px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <text x="-13" y="18" fill="green" font-weight="500">${{ round(Auth::user()->credit, 2) }} </text>
                        </svg>
                    @endauth
                    <div class="space-20px"></div>
                    <div class="space-20px"></div>
                    <div class="user">
                    @auth
                        <img style="border-radius: 50%;" width="24px" height="24px" src="{{ Auth::user()->avatar }}" alt="user-avtar">
                    @endauth
                    @guest
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <path
                                d="M12,24 C18.627417,24 24,18.627417 24,12 C24,5.372583 18.627417,0 12,0 C5.372583,0 0,5.372583 0,12 C0,18.627417 5.372583,24 12,24 Z"
                                id="Path" fill="#979797" fill-rule="nonzero" opacity="0.469866071" />
                            <path
                                d="M0.521006905,15.5084303 L2.22182541,13.8076118 L5.75735931,10.2720779 C6.92893219,9.10050506 8.82842712,9.10050506 10,10.2720779 L13.5308888,13.8029668 L20.3481586,20.6202366 C18.1882767,22.712365 15.24451,24 12,24 C6.59320039,24 2.02157722,20.4241846 0.521006905,15.5084303 Z"
                                id="Combined-Shape" fill="#979797" fill-rule="nonzero" />
                            <path
                                d="M8.85600124,23.5839233 L5.27207794,20 C4.10050506,18.8284271 4.10050506,16.9289322 5.27207794,15.7573593 L10.2218254,10.8076118 L13.7573593,7.27207794 C14.9289322,6.10050506 16.8284271,6.10050506 18,7.27207794 L21.5308888,10.8029668 L23.9395859,13.2116639 C23.3321184,19.2700592 18.2184276,24 12,24 C10.9121183,24 9.85804786,23.8552369 8.85600124,23.5839233 Z"
                                id="Combined-Shape" fill="#979797" fill-rule="nonzero" opacity="0.532133557" />
                        </svg>
                    @endguest
                    @auth()
                        <div class="user-dropdown">
                            <p>Welcome back,</p>
                            <span>{{ Auth::user()->name }}</span>
                            <div class="space-height-20px"></div>
                            <div class="border-bottom-2px"></div>
                            <div class="space-height-20px"></div>
                            <div style="display: flex; align-items: center;" onclick="copyMessage('{{ Auth::user()->id }}')">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>
                                Your ID: {{ Auth::user()->id }}
                            </div>
                            <div class="space-height-20px"></div>
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>
                                Role : {{ config('const.role_member.icon')[array_search($role['role'], config('const.role_member.member_status'), true)] }}
                            </div>
                            <div class="space-height-20px"></div>
                            <div style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>
                                Consumption : ${{ round($role['totalMoney'], 2) }}
                            </div>
                            <div class="space-height-20px"></div>
                            <div onclick="copyMessage('Your referral link: {{request()->getHost() }}/?ref={{ Auth::user()->id }}')"  style="display: flex; align-items: center;">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <path
                                        d="M8,16 C12.418278,16 16,12.418278 16,8 C16,3.581722 12.418278,0 8,0 C3.581722,0 0,3.581722 0,8 C0,12.418278 3.581722,16 8,16 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                                <div class="space-20px"></div>
                                    Link invite
                            </div>
                        </div>
                    @endauth
                    </div>
                </div>
                <span class="menu-mobile">
                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                        <path
                            d="M6,2 L15,2 C15.5522847,2 16,2.44771525 16,3 C16,3.55228475 15.5522847,4 15,4 L6,4 C5.44771525,4 5,3.55228475 5,3 C5,2.44771525 5.44771525,2 6,2 Z"
                            id="Path" fill-rule="nonzero" />
                        <path
                            d="M6,7 L15,7 C15.5522847,7 16,7.44771525 16,8 C16,8.55228475 15.5522847,9 15,9 L6,9 C5.44771525,9 5,8.55228475 5,8 C5,7.44771525 5.44771525,7 6,7 Z"
                            id="Path" fill-rule="nonzero" />
                        <path
                            d="M6,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L6,14 C5.44771525,14 5,13.5522847 5,13 C5,12.4477153 5.44771525,12 6,12 Z"
                            id="Path" fill-rule="nonzero" />
                        <path
                            d="M1.5,11.5 C2.32842712,11.5 3,12.1715729 3,13 C3,13.8284271 2.32842712,14.5 1.5,14.5 C0.671572875,14.5 1.01453063e-16,13.8284271 0,13 C-1.01453063e-16,12.1715729 0.671572875,11.5 1.5,11.5 Z"
                            id="Path" fill-rule="nonzero" />
                        <path
                            d="M1.5,6.5 C2.32842712,6.5 3,7.17157288 3,8 C3,8.82842712 2.32842712,9.5 1.5,9.5 C0.671572875,9.5 1.01453063e-16,8.82842712 0,8 C-1.01453063e-16,7.17157288 0.671572875,6.5 1.5,6.5 Z"
                            id="Path" fill-rule="nonzero" />
                        <path
                            d="M1.5,1.5 C2.32842712,1.5 3,2.17157288 3,3 C3,3.82842712 2.32842712,4.5 1.5,4.5 C0.671572875,4.5 1.01453063e-16,3.82842712 0,3 C-1.01453063e-16,2.17157288 0.671572875,1.5 1.5,1.5 Z"
                            id="Path" fill-rule="nonzero" />
                    </svg>
                </span>
            </div>
            <div class="main">
                <div class="toolbar desktop">
                    <div>
                        <a href="/home">
                            <svg class="active" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <a xlink:href="/home">
                                    <path
                                        d="M2,0 L22,0 C23.1045695,-2.02906125e-16 24,0.8954305 24,2 L24,9 C24,10.1045695 23.1045695,11 22,11 L2,11 C0.8954305,11 1.3527075e-16,10.1045695 0,9 L0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M2,13 L12,13 C13.1045695,13 14,13.8954305 14,15 L14,22 C14,23.1045695 13.1045695,24 12,24 L2,24 C0.8954305,24 1.3527075e-16,23.1045695 0,22 L0,15 C-1.3527075e-16,13.8954305 0.8954305,13 2,13 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M18,13 L22,13 C23.1045695,13 24,13.8954305 24,15 L24,22 C24,23.1045695 23.1045695,24 22,24 L18,24 C16.8954305,24 16,23.1045695 16,22 L16,15 C16,13.8954305 16.8954305,13 18,13 Z"
                                        id="Path" fill-rule="nonzero" />
                                </a>
                            </svg>
                        </a>
                        <a href="/balance">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <a xlink:href="/balance">
                                    <path
                                        d="M5,6 L8,6 C8.55228475,6 9,6.44771525 9,7 L9,20 C9,20.5522847 8.55228475,21 8,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,7 C4,6.44771525 4.44771525,6 5,6 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M16,3 L19,3 C19.5522847,3 20,3.44771525 20,4 L20,17 C20,17.5522847 19.5522847,18 19,18 L16,18 C15.4477153,18 15,17.5522847 15,17 L15,4 C15,3.44771525 15.4477153,3 16,3 Z"
                                        id="Path" fill-rule="nonzero"
                                        transform="translate(17.500000, 10.500000) rotate(-180.000000) translate(-17.500000, -10.500000) " />
                                    <path
                                        d="M6.07335908,0.739274995 C6.26832389,0.420241668 6.73167611,0.420241668 6.92664092,0.739274995 L12.4266409,9.739275 C12.6302488,10.0724516 12.3904649,10.5 12,10.5 L1,10.5 C0.609535124,10.5 0.36975117,10.0724516 0.573359083,9.739275 L6.07335908,0.739274995 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M17.0733591,13.739275 C17.2683239,13.4202417 17.7316761,13.4202417 17.9266409,13.739275 L23.4266409,22.739275 C23.6302488,23.0724516 23.3904649,23.5 23,23.5 L12,23.5 C11.6095351,23.5 11.3697512,23.0724516 11.5733591,22.739275 L17.0733591,13.739275 Z"
                                        id="Path" fill-rule="nonzero"
                                        transform="translate(17.500000, 18.500000) rotate(-180.000000) translate(-17.500000, -18.500000) " />
                                </a>
                            </svg>
                        </a>
                        <a href="/keys">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <a xlink:href="/keys">
                                    <path
                                        d="M12,3 C15.0375661,3 17.5,5.46243388 17.5,8.5 L17.5,17.5 C17.5,20.5375661 15.0375661,23 12,23 C8.96243388,23 6.5,20.5375661 6.5,17.5 L6.5,8.5 L4.5,8.5 L4.5,17.5 C4.5,21.6421356 7.85786438,25 12,25 C16.1421356,25 19.5,21.6421356 19.5,17.5 L19.5,8.5 C19.5,4.35786438 16.1421356,1 12,1 L12,3 Z"
                                        id="Rectangle" fill-rule="nonzero"
                                        transform="translate(12.000000, 13.000000) rotate(-180.000000) translate(-12.000000, -13.000000) ">
                                    </path>
                                    <path
                                        d="M5,9 L19,9 C20.6568542,9 22,10.3431458 22,12 L22,21 C22,22.6568542 20.6568542,24 19,24 L5,24 C3.34314575,24 2,22.6568542 2,21 L2,12 C2,10.3431458 3.34314575,9 5,9 Z"
                                        id="Path" fill-rule="nonzero"></path>
                                    <path
                                        d="M12,14 C13.3807119,14 14.5,15.1192881 14.5,16.5 C14.5,17.8807119 13.3807119,19 12,19 C10.6192881,19 9.5,17.8807119 9.5,16.5 C9.5,15.1192881 10.6192881,14 12,14 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero"></path>
                                </a>
                            </svg>
                        </a>
                        <a href="/keys">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <a xlink:href="/keys">
                                    <path
                                        d="M12,14 C13.3807119,14 14.5,15.1192881 14.5,16.5 C14.5,17.8807119 13.3807119,19 12,19 C10.6192881,19 9.5,17.8807119 9.5,16.5 C9.5,15.1192881 10.6192881,14 12,14 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                                    <path
                                        d="M9.5,24 C14.7467051,24 19,19.7467051 19,14.5 C19,9.25329488 14.7467051,5 9.5,5 C4.25329488,5 0,9.25329488 0,14.5 C0,19.7467051 4.25329488,24 9.5,24 Z"
                                        id="Path" fill-rule="nonzero" opacity="0.394647507" />
                                    <path
                                        d="M13.5,21 C19.2989899,21 24,16.2989899 24,10.5 C24,4.70101013 19.2989899,0 13.5,0 C7.70101013,0 3,4.70101013 3,10.5 C3,16.2989899 7.70101013,21 13.5,21 Z"
                                        id="Path" fill-rule="nonzero"
                                        transform="translate(13.500000, 10.500000) rotate(-315.000000) translate(-13.500000, -10.500000) " />
                                    <path
                                        d="M10.6322892,9.71085659 C11.7368587,9.71085659 12.6322892,8.81542608 12.6322892,7.71085659 C12.6322892,6.60628709 11.7368587,5.71085659 10.6322892,5.71085659 C9.52771967,5.71085659 8.63228917,6.60628709 8.63228917,7.71085659 C8.63228917,8.81542608 9.52771967,9.71085659 10.6322892,9.71085659 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                        transform="translate(10.632289, 7.710857) rotate(-315.000000) translate(-10.632289, -7.710857) " />
                                    <path
                                        d="M10.6322892,8.71085659 C10.0800044,8.71085659 9.63228917,8.26314134 9.63228917,7.71085659 C9.63228917,7.15857184 10.0800044,6.71085659 10.6322892,6.71085659 C11.1845739,6.71085659 11.6322892,7.15857184 11.6322892,7.71085659 C11.6322892,8.26314134 11.1845739,8.71085659 10.6322892,8.71085659 Z"
                                        id="Path" fill-rule="nonzero"
                                        transform="translate(10.632289, 7.710857) rotate(-315.000000) translate(-10.632289, -7.710857) " />
                                    <path
                                        d="M16.2891434,15.3677108 C17.3937129,15.3677108 18.2891434,14.4722803 18.2891434,13.3677108 C18.2891434,12.2631413 17.3937129,11.3677108 16.2891434,11.3677108 C15.1845739,11.3677108 14.2891434,12.2631413 14.2891434,13.3677108 C14.2891434,14.4722803 15.1845739,15.3677108 16.2891434,15.3677108 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                        transform="translate(16.289143, 13.367711) rotate(-315.000000) translate(-16.289143, -13.367711) " />
                                    <path
                                    d="M16.2891434,14.3677108 C15.7368587,14.3677108 15.2891434,13.9199956 15.2891434,13.3677108 C15.2891434,12.8154261 15.7368587,12.3677108 16.2891434,12.3677108 C16.8414282,12.3677108 17.2891434,12.8154261 17.2891434,13.3677108 C17.2891434,13.9199956 16.8414282,14.3677108 16.2891434,14.3677108 Z"
                                        id="Path" fill="#979797" fill-rule="nonzero"
                                        transform="translate(16.289143, 13.367711) rotate(-315.000000) translate(-16.289143, -13.367711) " />
                                    <path
                                        d="M13,6.05555556 L13,14.9444444 C13,15.2205868 13.2238576,15.4444444 13.5,15.4444444 C13.7761424,15.4444444 14,15.2205868 14,14.9444444 L14,6.05555556 C14,5.77941318 13.7761424,5.55555556 13.5,5.55555556 C13.2238576,5.55555556 13,5.77941318 13,6.05555556 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                        transform="translate(13.500000, 10.500000) rotate(-315.000000) translate(-13.500000, -10.500000) " />
                                </a>
                            </svg>
                        </a>
                        <a href="/terms-of-services">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <a xlink:href="/terms-of-services">
                                    <path
                                        d="M6,0 L13,0 L18,0 C19.6568542,-3.04359188e-16 21,1.34314575 21,3 L21,7.9934309 L21,21 C21,22.6568542 19.6568542,24 18,24 L6,24 C4.34314575,24 3,22.6568542 3,21 L3,3 C3,1.34314575 4.34314575,3.04359188e-16 6,0 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M7.51158831,5 L13.5,5 C13.7761424,5 14,4.77614237 14,4.5 C14,4.22385763 13.7761424,4 13.5,4 L7.51158831,4 C7.23544593,4 7.01158831,4.22385763 7.01158831,4.5 C7.01158831,4.77614237 7.23544593,5 7.51158831,5 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                                    <path
                                        d="M7.51158831,9 L16.5,9 C16.7761424,9 17,8.77614237 17,8.5 C17,8.22385763 16.7761424,8 16.5,8 L7.51158831,8 C7.23544593,8 7.01158831,8.22385763 7.01158831,8.5 C7.01158831,8.77614237 7.23544593,9 7.51158831,9 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                                    <path
                                        d="M7.51158831,13 L16.5,13 C16.7761424,13 17,12.7761424 17,12.5 C17,12.2238576 16.7761424,12 16.5,12 L7.51158831,12 C7.23544593,12 7.01158831,12.2238576 7.01158831,12.5 C7.01158831,12.7761424 7.23544593,13 7.51158831,13 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                                    <path
                                        d="M13.5,20 L16.5,20 C16.7761424,20 17,19.7761424 17,19.5 C17,19.2238576 16.7761424,19 16.5,19 L13.5,19 C13.2238576,19 13,19.2238576 13,19.5 C13,19.7761424 13.2238576,20 13.5,20 Z"
                                        id="Path" fill="#FFFFFF" fill-rule="nonzero" />
                                </a>
                            </svg>
                        </a>



                    </div>
                    <div>
                        <a href="/logout">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <path
                                    d="M12,23.5 C18.3512746,23.5 23.5,18.3512746 23.5,12 C23.5,5.64872538 18.3512746,0.5 12,0.5 C5.64872538,0.5 0.5,5.64872538 0.5,12 C0.5,18.3512746 5.64872538,23.5 12,23.5 Z"
                                    id="Path" fill-rule="nonzero" opacity="0.768391927" />
                                <path
                                    d="M12,19.5 C16.1421356,19.5 19.5,16.1421356 19.5,12 C19.5,7.85786438 16.1421356,4.5 12,4.5 C7.85786438,4.5 4.5,7.85786438 4.5,12 C4.5,12.2761424 4.72385763,12.5 5,12.5 C5.27614237,12.5 5.5,12.2761424 5.5,12 C5.5,8.41014913 8.41014913,5.5 12,5.5 C15.5898509,5.5 18.5,8.41014913 18.5,12 C18.5,15.5898509 15.5898509,18.5 12,18.5 C11.7238576,18.5 11.5,18.7238576 11.5,19 C11.5,19.2761424 11.7238576,19.5 12,19.5 Z"
                                    id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                    transform="translate(12.000000, 12.000000) rotate(-225.000000) translate(-12.000000, -12.000000) " />
                                <path
                                    d="M8.5,7 L15.5,7 C15.7761424,7 16,7.22385763 16,7.5 C16,7.77614237 15.7761424,8 15.5,8 L8.5,8 C8.22385763,8 8,7.77614237 8,7.5 C8,7.22385763 8.22385763,7 8.5,7 Z"
                                    id="Path" fill="#FFFFFF" fill-rule="nonzero"
                                    transform="translate(12.000000, 7.500000) rotate(-270.000000) translate(-12.000000, -7.500000) " />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="content-view">
                    <?php
                    $discord = \App\Option::where('option', 'discord_channel')->get()->first()->value;
                    ?>
                    @if(\App\Option::where('option', 'header_notice')->get()->first()->value)
                        <style>
                            #notice {
                                background: #3d7fff;
                                color: white;
                                font-weight: 700;
                                align-items: flex-start;
                            }
                            #notice p{
                                margin: 10px;
                                font-size: unset;
                            }
                            #notice .material-icons{
                                margin: 10px;
                                align-items: self-start;
                            }
                        </style>
                        <div id="notice">
                            <div style="width: 100%; text-align: center" class="blink">
                                {!! \App\Option::where('option', 'header_notice')->get()->first()->value !!}
                            </div>

                            <span style="font-size: 25px; " onclick="hideNotice()">
                        <i class="material-icons dp48">highlight_off</i>
                    </span>
                        </div>
                    @endif
                    @yield('content')
                    <div class="footer">
                        <div>
                            <h5>About us</h5>
                            <div>
                                SecureCheats is now about 3 years old since it was founded - our team of coders are professional and are specialized in many aspects in programming,
                                reverse engineering, exploiting and have made many cheats/hacks/exploits in almost all game engines out there!
                            </div>
                        </div>
                        <div class="space-20px"></div>
                        <div>
                            <h5>For support: </h5>
                            Email : support@securecheat.xyz<br>
                            <br>
                            <h5>Verified Seller By</h5>
                            <a target="blank" href="https://www.elitepvpers.com/">
                                <img src="https://cdn.discordapp.com/attachments/796683451087585280/809374850102722580/logo.png" alt="seller" width="100">
                            </a>

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

                </div>
            </div>
        </div>
        @auth()
            @if(\App\Blacklist::where('email', Auth::user()->email)->get()->first() == null)
                @include('new.coin-popup')
                @include('new.seller-payment')
                @include("new.stripe-popup")
                <script !src="">
                    function createPayment() {
                        window.open('https://securemods.com/payment?id=' + '{{Auth::user()->id}}' , 'Dynamic Popup', 'height=50%', 'width="50%')
                    }
                </script>
            @endif
        @endauth

        @include('new.scrip')


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
        s1.src='https://embed.tawk.to/5de0f78ad96992700fc9e348/default';
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
        M.updateTextFields();Ns
        let event = new Event('change')
        $('#paypal_amount')[0].dispatchEvent(event)
    })
</script>
@endauth

@yield('script')
