<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
@yield('meta')
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <style>
        body {
            min-width: 800px;
        }
    </style>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@yield('resources')
</head>
<body>
@yield('content')
</body>
</html>
