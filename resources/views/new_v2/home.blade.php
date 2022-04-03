<!DOCTYPE html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', $head_tags ?  $head_tags->head_title : 'Home')
    @section('description', $head_tags ?  $head_tags->head_description : '')
    <meta charset="UTF-8">
    <meta name="description" content="provide the ultimate secure private cheats, experimenting and implementing AI into our cheats to keep you hidden and trick any anti-cheat software out there. Keeping your account clean and undetected was our priority when developing this cheat, and it will always be going forward into updating it. With protection against the most popular anti-cheat software's like VAC, Fairfight, Easy Anti-cheat, and most notoriously Battleye and FACEIT Anti-cheat... You can be sure that you're always safe while using our products.">
    <meta name="keywords" content="YOUR SECURITY IS OUR PRIORITY, hack, cheats">
    @include('new_v2.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
@extends('new_v2.master-layout')
@section('content')

@endsection
@section('script')
@endsection

</body>
</html>



