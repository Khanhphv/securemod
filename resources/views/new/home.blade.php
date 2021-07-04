<!DOCTYPE html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $head_tags ?  $head_tags->head_title : 'Home')
    @section('description', $head_tags ?  $head_tags->head_description : '')
    <meta charset="UTF-8">
    <meta name="description" content="provide the ultimate secure private cheats, experimenting and implementing AI into our cheats to keep you hidden and trick any anti-cheat software out there. Keeping your account clean and undetected was our priority when developing this cheat, and it will always be going forward into updating it. With protection against the most popular anti-cheat software's like VAC, Fairfight, Easy Anti-cheat, and most notoriously Battleye and FACEIT Anti-cheat... You can be sure that you're always safe while using our products.">
    <meta name="keywords" content="YOUR SECURITY IS OUR PRIORITY, hack, cheats">
    <meta name="author" content="support@divinesofts.net">
    @include('new.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
    @extends('new.master-layout')
    @section('content')
        <div class="hero-block mobile">
            @if (isset($games[0]))
                <div onclick="redirectToSpecificGame('{{ $games[0]->slug }}')" class="item" style="background-image: url('{{$games[0]->thumb_image}}'); background-position: inherit">
                    <div class="item-detail-hover">
                        <p>{{ ($games[0]->name) }}</p>
                        <span>Game</span>
                        <div>
                            <div>
                                <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                    <path
                                        d="M8,3 C10.6729538,3 13.3396205,4.66666667 16,8 C13.3461529,11.3333333 10.681235,13 8.00524656,13 C5.32925808,13 2.66084256,11.3333333 -1.77635684e-15,8 C2.66037955,4.66666667 5.32704621,3 8,3 Z M8,10.5 C9.38071187,10.5 10.5,9.38071187 10.5,8 C10.5,6.61928813 9.38071187,5.5 8,5.5 C6.61928813,5.5 5.5,6.61928813 5.5,8 C5.5,9.38071187 6.61928813,10.5 8,10.5 Z"
                                        id="Combined-Shape" fill="#FFFFFF" />
                                </svg>
                                <div class="space-20px"></div>
                                {{ $games[0]->views }}
                            </div>
                            <div>
                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <path
                                        d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                        id="Oval" fill-rule="nonzero" />
                                    <path
                                        d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                        id="Oval" fill-rule="nonzero"
                                        transform="translate(6.500000, 12.500000) rotate(-210.000000) translate(-6.500000, -12.500000) " />
                                    <path
                                        d="M11.5,11.5 L18.5,11.5 C19.0522847,11.5 19.5,11.9477153 19.5,12.5 C19.5,13.0522847 19.0522847,13.5 18.5,13.5 L11.5,13.5 C10.9477153,13.5 10.5,13.0522847 10.5,12.5 C10.5,11.9477153 10.9477153,11.5 11.5,11.5 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M15,11.5 L22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 C23,13.0522847 22.5522847,13.5 22,13.5 L15,13.5 C14.4477153,13.5 14,13.0522847 14,12.5 C14,11.9477153 14.4477153,11.5 15,11.5 Z"
                                        id="Path-Copy" fill-rule="nonzero" />
                                    <path
                                        d="M22,13 C22.5522847,13 23,13.4477153 23,14 L23,16 C23,16.5522847 22.5522847,17 22,17 C21.4477153,17 21,16.5522847 21,16 L21,14 C21,13.4477153 21.4477153,13 22,13 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M17,13 C17.5522847,13 18,13.4477153 18,14 L18,16 C18,16.5522847 17.5522847,17 17,17 C16.4477153,17 16,16.5522847 16,16 L16,14 C16,13.4477153 16.4477153,13 17,13 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 L23,14.5 C23,15.0522847 22.5522847,15.5 22,15.5 C21.4477153,15.5 21,15.0522847 21,14.5 L21,12.5 C21,11.9477153 21.4477153,11.5 22,11.5 Z"
                                        id="Path" fill-rule="nonzero" />
                                    <path
                                        d="M17,11.5 C17.5522847,11.5 18,11.9477153 18,12.5 L18,14.5 C18,15.0522847 17.5522847,15.5 17,15.5 C16.4477153,15.5 16,15.0522847 16,14.5 L16,12.5 C16,11.9477153 16.4477153,11.5 17,11.5 Z"
                                        id="Path" fill-rule="nonzero" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                <div>
                    @if (isset($games[1]))
                        <div class="item" onclick="redirectToSpecificGame('{{ $games[1]->slug }}')" style="background-image: url('{{ $games[1]->thumb_image }}'); background-position: inherit">
                            <div>
                                <p>{{ $games[1]->name }}</p>
                                <span>Game</span>
                                <div>
                                    <div>
                                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                            <path
                                                d="M8,3 C10.6729538,3 13.3396205,4.66666667 16,8 C13.3461529,11.3333333 10.681235,13 8.00524656,13 C5.32925808,13 2.66084256,11.3333333 -1.77635684e-15,8 C2.66037955,4.66666667 5.32704621,3 8,3 Z M8,10.5 C9.38071187,10.5 10.5,9.38071187 10.5,8 C10.5,6.61928813 9.38071187,5.5 8,5.5 C6.61928813,5.5 5.5,6.61928813 5.5,8 C5.5,9.38071187 6.61928813,10.5 8,10.5 Z"
                                                id="Combined-Shape" fill="#FFFFFF" />
                                        </svg>
                                        <div class="space-20px"></div>
                                        {{ $games[1]->views }}
                                    </div>
                                    <div>
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <path
                                                d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                id="Oval" fill-rule="nonzero" />
                                            <path
                                                d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                id="Oval" fill-rule="nonzero"
                                                transform="translate(6.500000, 12.500000) rotate(-210.000000) translate(-6.500000, -12.500000) " />
                                            <path
                                                d="M11.5,11.5 L18.5,11.5 C19.0522847,11.5 19.5,11.9477153 19.5,12.5 C19.5,13.0522847 19.0522847,13.5 18.5,13.5 L11.5,13.5 C10.9477153,13.5 10.5,13.0522847 10.5,12.5 C10.5,11.9477153 10.9477153,11.5 11.5,11.5 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M15,11.5 L22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 C23,13.0522847 22.5522847,13.5 22,13.5 L15,13.5 C14.4477153,13.5 14,13.0522847 14,12.5 C14,11.9477153 14.4477153,11.5 15,11.5 Z"
                                                id="Path-Copy" fill-rule="nonzero" />
                                            <path
                                                d="M22,13 C22.5522847,13 23,13.4477153 23,14 L23,16 C23,16.5522847 22.5522847,17 22,17 C21.4477153,17 21,16.5522847 21,16 L21,14 C21,13.4477153 21.4477153,13 22,13 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M17,13 C17.5522847,13 18,13.4477153 18,14 L18,16 C18,16.5522847 17.5522847,17 17,17 C16.4477153,17 16,16.5522847 16,16 L16,14 C16,13.4477153 16.4477153,13 17,13 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 L23,14.5 C23,15.0522847 22.5522847,15.5 22,15.5 C21.4477153,15.5 21,15.0522847 21,14.5 L21,12.5 C21,11.9477153 21.4477153,11.5 22,11.5 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M17,11.5 C17.5522847,11.5 18,11.9477153 18,12.5 L18,14.5 C18,15.0522847 17.5522847,15.5 17,15.5 C16.4477153,15.5 16,15.0522847 16,14.5 L16,12.5 C16,11.9477153 16.4477153,11.5 17,11.5 Z"
                                                id="Path" fill-rule="nonzero" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($games[2]))
                            <div class="item" onclick="redirectToSpecificGame('{{ $games[2]->slug }}')" style="background-image: url('{{ $games[2]->thumb_image }}'); background-position: inherit">
                                <div>
                                    <p>{{ $games[2]->name }}</p>
                                    <span>Game</span>
                                    <div>
                                        <div>
                                            <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                                <path
                                                    d="M8,3 C10.6729538,3 13.3396205,4.66666667 16,8 C13.3461529,11.3333333 10.681235,13 8.00524656,13 C5.32925808,13 2.66084256,11.3333333 -1.77635684e-15,8 C2.66037955,4.66666667 5.32704621,3 8,3 Z M8,10.5 C9.38071187,10.5 10.5,9.38071187 10.5,8 C10.5,6.61928813 9.38071187,5.5 8,5.5 C6.61928813,5.5 5.5,6.61928813 5.5,8 C5.5,9.38071187 6.61928813,10.5 8,10.5 Z"
                                                    id="Combined-Shape" fill="#FFFFFF" />
                                            </svg>
                                            <div class="space-20px"></div>
                                            {{ $games[2]->views }}
                                        </div>
                                        <div>
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                <path
                                                    d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                    id="Oval" fill-rule="nonzero" />
                                                <path
                                                    d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                    id="Oval" fill-rule="nonzero"
                                                    transform="translate(6.500000, 12.500000) rotate(-210.000000) translate(-6.500000, -12.500000) " />
                                                <path
                                                    d="M11.5,11.5 L18.5,11.5 C19.0522847,11.5 19.5,11.9477153 19.5,12.5 C19.5,13.0522847 19.0522847,13.5 18.5,13.5 L11.5,13.5 C10.9477153,13.5 10.5,13.0522847 10.5,12.5 C10.5,11.9477153 10.9477153,11.5 11.5,11.5 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M15,11.5 L22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 C23,13.0522847 22.5522847,13.5 22,13.5 L15,13.5 C14.4477153,13.5 14,13.0522847 14,12.5 C14,11.9477153 14.4477153,11.5 15,11.5 Z"
                                                    id="Path-Copy" fill-rule="nonzero" />
                                                <path
                                                    d="M22,13 C22.5522847,13 23,13.4477153 23,14 L23,16 C23,16.5522847 22.5522847,17 22,17 C21.4477153,17 21,16.5522847 21,16 L21,14 C21,13.4477153 21.4477153,13 22,13 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M17,13 C17.5522847,13 18,13.4477153 18,14 L18,16 C18,16.5522847 17.5522847,17 17,17 C16.4477153,17 16,16.5522847 16,16 L16,14 C16,13.4477153 16.4477153,13 17,13 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 L23,14.5 C23,15.0522847 22.5522847,15.5 22,15.5 C21.4477153,15.5 21,15.0522847 21,14.5 L21,12.5 C21,11.9477153 21.4477153,11.5 22,11.5 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M17,11.5 C17.5522847,11.5 18,11.9477153 18,12.5 L18,14.5 C18,15.0522847 17.5522847,15.5 17,15.5 C16.4477153,15.5 16,15.0522847 16,14.5 L16,12.5 C16,11.9477153 16.4477153,11.5 17,11.5 Z"
                                                    id="Path" fill-rule="nonzero" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
                <div>
                    @if (isset($games[3]))
                        <div class="item" onclick="redirectToSpecificGame('{{ $games[3]->slug }}')" style="background-image: url('{{ $games[3]->thumb_image }}'); background-position: inherit">
                            <div>
                                <p>{{ $games[3]->name }}</p>
                                <span>Game</span>
                                <div>
                                    <div>
                                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                            <path
                                                d="M8,3 C10.6729538,3 13.3396205,4.66666667 16,8 C13.3461529,11.3333333 10.681235,13 8.00524656,13 C5.32925808,13 2.66084256,11.3333333 -1.77635684e-15,8 C2.66037955,4.66666667 5.32704621,3 8,3 Z M8,10.5 C9.38071187,10.5 10.5,9.38071187 10.5,8 C10.5,6.61928813 9.38071187,5.5 8,5.5 C6.61928813,5.5 5.5,6.61928813 5.5,8 C5.5,9.38071187 6.61928813,10.5 8,10.5 Z"
                                                id="Combined-Shape" fill="#FFFFFF" />
                                        </svg>
                                        <div class="space-20px"></div>
                                        {{ $games[3]->views }}
                                    </div>
                                    <div>
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <path
                                                d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                id="Oval" fill-rule="nonzero" />
                                            <path
                                                d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                id="Oval" fill-rule="nonzero"
                                                transform="translate(6.500000, 12.500000) rotate(-210.000000) translate(-6.500000, -12.500000) " />
                                            <path
                                                d="M11.5,11.5 L18.5,11.5 C19.0522847,11.5 19.5,11.9477153 19.5,12.5 C19.5,13.0522847 19.0522847,13.5 18.5,13.5 L11.5,13.5 C10.9477153,13.5 10.5,13.0522847 10.5,12.5 C10.5,11.9477153 10.9477153,11.5 11.5,11.5 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M15,11.5 L22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 C23,13.0522847 22.5522847,13.5 22,13.5 L15,13.5 C14.4477153,13.5 14,13.0522847 14,12.5 C14,11.9477153 14.4477153,11.5 15,11.5 Z"
                                                id="Path-Copy" fill-rule="nonzero" />
                                            <path
                                                d="M22,13 C22.5522847,13 23,13.4477153 23,14 L23,16 C23,16.5522847 22.5522847,17 22,17 C21.4477153,17 21,16.5522847 21,16 L21,14 C21,13.4477153 21.4477153,13 22,13 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M17,13 C17.5522847,13 18,13.4477153 18,14 L18,16 C18,16.5522847 17.5522847,17 17,17 C16.4477153,17 16,16.5522847 16,16 L16,14 C16,13.4477153 16.4477153,13 17,13 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 L23,14.5 C23,15.0522847 22.5522847,15.5 22,15.5 C21.4477153,15.5 21,15.0522847 21,14.5 L21,12.5 C21,11.9477153 21.4477153,11.5 22,11.5 Z"
                                                id="Path" fill-rule="nonzero" />
                                            <path
                                                d="M17,11.5 C17.5522847,11.5 18,11.9477153 18,12.5 L18,14.5 C18,15.0522847 17.5522847,15.5 17,15.5 C16.4477153,15.5 16,15.0522847 16,14.5 L16,12.5 C16,11.9477153 16.4477153,11.5 17,11.5 Z"
                                                id="Path" fill-rule="nonzero" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(isset($gammes[4]))
                            <div class="item" onclick="redirectToSpecificGame('{{ $games[4]->slug }}')" style="background-image: url('{{ $games[4]->thumb_image }}'); background-position: inherit">
                                <div>
                                    <p>{{ $games[4]->name }}</p>
                                    <span>Game</span>
                                    <div>
                                        <div>
                                            <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                                <path
                                                    d="M8,3 C10.6729538,3 13.3396205,4.66666667 16,8 C13.3461529,11.3333333 10.681235,13 8.00524656,13 C5.32925808,13 2.66084256,11.3333333 -1.77635684e-15,8 C2.66037955,4.66666667 5.32704621,3 8,3 Z M8,10.5 C9.38071187,10.5 10.5,9.38071187 10.5,8 C10.5,6.61928813 9.38071187,5.5 8,5.5 C6.61928813,5.5 5.5,6.61928813 5.5,8 C5.5,9.38071187 6.61928813,10.5 8,10.5 Z"
                                                    id="Combined-Shape" fill="#FFFFFF" />
                                            </svg>
                                            <div class="space-20px"></div>
                                            {{ $games[4]->views }}
                                        </div>
                                        <div>
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                <path
                                                    d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                    id="Oval" fill-rule="nonzero" />
                                                <path
                                                    d="M6.5,18 C9.53756612,18 12,15.5375661 12,12.5 C12,9.46243388 9.53756612,7 6.5,7 C3.46243388,7 1,9.46243388 1,12.5 L3,12.5 C3,10.5670034 4.56700338,9 6.5,9 C8.43299662,9 10,10.5670034 10,12.5 C10,14.4329966 8.43299662,16 6.5,16 L6.5,18 Z"
                                                    id="Oval" fill-rule="nonzero"
                                                    transform="translate(6.500000, 12.500000) rotate(-210.000000) translate(-6.500000, -12.500000) " />
                                                <path
                                                    d="M11.5,11.5 L18.5,11.5 C19.0522847,11.5 19.5,11.9477153 19.5,12.5 C19.5,13.0522847 19.0522847,13.5 18.5,13.5 L11.5,13.5 C10.9477153,13.5 10.5,13.0522847 10.5,12.5 C10.5,11.9477153 10.9477153,11.5 11.5,11.5 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M15,11.5 L22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 C23,13.0522847 22.5522847,13.5 22,13.5 L15,13.5 C14.4477153,13.5 14,13.0522847 14,12.5 C14,11.9477153 14.4477153,11.5 15,11.5 Z"
                                                    id="Path-Copy" fill-rule="nonzero" />
                                                <path
                                                    d="M22,13 C22.5522847,13 23,13.4477153 23,14 L23,16 C23,16.5522847 22.5522847,17 22,17 C21.4477153,17 21,16.5522847 21,16 L21,14 C21,13.4477153 21.4477153,13 22,13 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M17,13 C17.5522847,13 18,13.4477153 18,14 L18,16 C18,16.5522847 17.5522847,17 17,17 C16.4477153,17 16,16.5522847 16,16 L16,14 C16,13.4477153 16.4477153,13 17,13 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M22,11.5 C22.5522847,11.5 23,11.9477153 23,12.5 L23,14.5 C23,15.0522847 22.5522847,15.5 22,15.5 C21.4477153,15.5 21,15.0522847 21,14.5 L21,12.5 C21,11.9477153 21.4477153,11.5 22,11.5 Z"
                                                    id="Path" fill-rule="nonzero" />
                                                <path
                                                    d="M17,11.5 C17.5522847,11.5 18,11.9477153 18,12.5 L18,14.5 C18,15.0522847 17.5522847,15.5 17,15.5 C16.4477153,15.5 16,15.0522847 16,14.5 L16,12.5 C16,11.9477153 16.4477153,11.5 17,11.5 Z"
                                                    id="Path" fill-rule="nonzero" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-name mobile">
            <div onclick="getAllGames(event)" class="active">
                <span>All Game</span>
                <div></div>
            </div>
            <div onclick="getRattingGames(event)">
                <span >Rating</span>
                <div></div>
            </div>
            <div onclick="getTrendGames(event)">
                <span>Trending</span>
                <div></div>
            </div>
            <div onclick="getNewGames(event)">
                <span>New</span>
                <div></div>
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
            $(event.target).parent().toggleClass('active')
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



