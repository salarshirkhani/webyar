<!DOCTYPE html>
<html lang="fa_IR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.css') }}" />

    <!-- Styles -->
    <link href="{{ asset('assets/fonts/shabnam.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/main.rtl.css') }}" rel="stylesheet">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset("assets/auth/js/tilt.jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("assets/auth/js/main.js") }}" type="text/javascript"></script>
</body>
</html>
