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
    <nav class="navbar shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <div class="dropdown">
                    <a href="#" class="item">Menu</a>
                    <ul class="dropdown-menu shadow">
                        <li><a href="{{ route('admin.get.reports_tally') }}">Reports</a></li>
                        <li>
                            <a href="#" class="logout-button">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
@yield('content')
</body>
</html>
