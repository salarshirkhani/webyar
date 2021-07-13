<!DOCTYPE html>
<html lang="fa_IR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="https://cdn.fontcdn.ir/Font/Persian/Shabnam/Shabnam.css" rel="stylesheet">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{ asset("assets/auth/js/tilt.jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("assets/auth/js/main.js") }}" type="text/javascript"></script>
</body>
</html>
