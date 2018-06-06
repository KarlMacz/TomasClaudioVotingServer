<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
@yield('meta')
    <title>{{ config('app.name') }}</title>
@yield('resources')
</head>
<body>
@yield('content')
</body>
</html>