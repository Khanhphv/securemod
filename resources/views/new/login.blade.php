<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/css/vertical-layout-light/style2.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="shortcut icon" href="/images/favicon.png"/>
</head>

<body>
<div id="app">
    <login-component :login_via_facebook="'{{ route('login_via_fb') }}'"
                     :login_via_discord="'{{ route('login_via_discord') }}'"
                     :login_via_google="'{{ route('login_via_gg') }}'"></login-component>

</div>
<script src="/js/app.js"></script>
<script src="/vendors/js/vendor.bundle.base.js"></script>
<script src="/vendors/js/vendor.bundle.addons.js"></script>
<script src="/js/off-canvas.js"></script>
<script src="/js/hoverable-collapse.js"></script>
<script src="/js/template.js"></script>
<script src="/js/settings.js"></script>
<script src="/js/todolist.js"></script>
</body>

</html>
