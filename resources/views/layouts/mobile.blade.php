<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
@yield('meta')
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <style>
        .bling-bling {
            background-color: white;
            border: 2px solid white;
            border-radius: 40px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.5);
            color: #387e4d;
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            position: fixed;
            text-decoration: none;
            z-index: 1;
            top: 15px;
            left: 15px;
            padding: 0 15px;
            line-height: 40px;
            height: 40px;
            transition: 0.25s;
        }

        .bling-bling:hover {
            background-color: #5abf79;
            color: white;
        }

        .bling-bling:active {
            background-color: #46ab65;
            color: white;
        }

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
