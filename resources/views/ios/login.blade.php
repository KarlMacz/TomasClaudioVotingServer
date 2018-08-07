@extends('layouts.mobile')

@section('resources')
    <style>
        .login-content {
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            height: 100%;
            width: 100%;
        }

        .login-header {
            background-color: #4c9261;
            border-radius: 450px;
            display: flex;
            flex-direction: column;
            position: absolute;
            top: -600px;
            left: 50%;
            margin-left: -450px;
            height: 900px;
            width: 900px;
        }

        .login-header > .login-header-content {
            align-items: center;
            display: flex;
            flex-direction: column;
            position: relative;
            margin-top: 625px;
            margin-left: 300px;
            width: 300px;
        }

        .login-header > .login-header-content > .login-header-logo {
            height: 150px;
            width: 150px;
        }

        .login-header > .login-header-content > .login-header-title {
            color: white;
            font-family: 'Satisfy';
            font-size: 50px;
            text-align: center;
            text-shadow: 0 2px 4px #222;
        }

        .login-body {
            align-items: center;
            display: flex;
            flex: 1;
            padding: 30px;
            margin-top: 300px;
        }

        .login-footer {
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            font-size: 10px;
            justify-content: center;
            text-align: center;
            padding: 15px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $(function() {
                if("{{ (session()->has('toasty') ? 'true' : 'false') }}" == "true") {
                    setToasty('status-toasty', "{{ session()->get('toasty') }}");
                    openToasty('status-toasty');

                    setTimeout(function() {
                        closeToasty('status-toasty');
                    }, 2000);
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="login-content">
        <div class="login-header">
            <div class="login-header-content">
                <img src="{{ asset('img/tcc_logo.png') }}" class="login-header-logo">
                <div class="login-header-title">{{ config('app.name') }}</div>
            </div>
        </div>
        <div class="login-body">
            <form action="{{ route('ios.post.login') }}" method="POST" style="width: 100%;">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" name="username" class="input-control" placeholder="Username or Student ID Number" required autofocus>
                </div>
                <div class="input-group">
                    <button class="button primary" style="width: 100%">LOGIN</button>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
    <div id="status-toasty" class="toasty"></div>
@endsection
