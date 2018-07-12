@extends('layouts.mobile')

@section('content')
    <div class="moblify">
        <div class="moblify-body">
            <div class="text-center">
                <img src="{{ asset('img/tcc_logo.png') }}" style="margin-top: -50px; height: 100px;">
                <div style="font-family: 'Satisfy'; font-size: 40px; margin-top: -5px; margin-bottom: 40px;">{{ config('app.name') }}</div>
                <div class="card" style="width: 300px;">
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <label for="">Username:</label>
                                <input type="text" name="username" class="input-control" required autofocus>
                            </div>
                            <div class="input-group text-right">
                                <button class="button">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
                <h3>Sign In</h3>
            </div>
        </div>
        <div class="moblify-footer">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
@endsection
