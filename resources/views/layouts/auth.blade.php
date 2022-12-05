<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <title>{{ config('app.name') }} | @yield('title') </title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <style>
            .login-page {
                background-image: url("{{ asset('img/background/login.jpg') }}");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>

    </head>
    <body class="hold-transition login-page" style="">

        @yield('content')

        <script src="{{ mix('js/app.js') }}"></script>

        @stack('inline_scripts')
    </body>
</html>
