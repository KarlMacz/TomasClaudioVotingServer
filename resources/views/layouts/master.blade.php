<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
@yield('meta')
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <style>
        body {
            min-width: 800px;
        }
    </style>
@yield('resources')
</head>
<body>
@yield('content')
</body>
</html>
