<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/login/login.css">
    <link rel="shortcut icon" href="/images/favicon.png"/>
</head>

<body>
<div id="app">
    <login-component :login_via_google="'{{ route('login_via_gg') }}'"></login-component>

</div>
<script src="/js/app.js"></script>
</body>

</html>
