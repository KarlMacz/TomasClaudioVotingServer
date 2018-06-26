<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
@yield('meta')
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <style>
        .moblify {
            align-items: center;
            background-color: #4c9261;
            color: white;
            display: flex;
            flex-direction: column;
            font-size: 10px;
            justify-content: center;
            position: relative;
            text-shadow: 0 2px 2px rgba(0, 0, 0, 0.5);
            padding: 0 25px;
            height: 100%;
            width: 100%;
            box-sizing: border-box;
        }

        .moblify > .moblify-body {
            display: inline-block;
            position: relative;
            text-align: left;
        }

        .moblify > .moblify-footer {
            text-align: center;
            position: absolute;
            bottom: 25px;
        }
    </style>
@yield('resources')
</head>
<body>
@yield('content')
</body>
</html>
