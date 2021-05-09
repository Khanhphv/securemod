@extends('new/header', ['blogGame' => $blogGame, 'description' => $content])
@section('content')
    <style>
        body {
            overflow: hidden;
            height: 100vh;
        }
        .footer{
            height: 15%;
        }
        .session-1 {
            background: url('/images/hero-bg.webp');
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 85%;
        }
    </style>
    <div class="session-1 empty-page">
        <div class="cover">
            <div class="headline">
                <div class="title-s0">Not Found <br></div>
                <div class="title-s2" style="max-width: 600px">Articles may be hidden or unpublished.
                </div>
            </div>

        </div>
    </div>
@endsection
