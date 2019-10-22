<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Halla') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/b56ae09687.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        body{
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #app{
            width: 100%;
            margin-top: -6%;
        }
    </style>
</head>
<body>

    @yield('content')
</body>
</html>
