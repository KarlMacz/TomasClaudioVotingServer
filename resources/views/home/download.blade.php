@extends('layouts.master')

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <a href="{{ route('home.get.index') }}" class="item">Home</a>
                <a href="{{ route('home.get.election_results') }}" class="item">Election Results</a>
                <a href="{{ route('home.get.download') }}" class="item active">Download</a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar fixed-footer">
        <div class="container wide">
            <div class="text-center" style="margin-top: 50px;">
                <h1>Download our Mobile Application</h1>
                <a href="" class="image-link"><img src="{{ asset('img/google_play_badge.svg') }}"></a>
                <a href="" class="image-link"><img src="{{ asset('img/app_store_badge.svg') }}"></a>
            </div>
        </div>
    </div>
    <div class="footer fixed">
        <div class="content">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
@endsection
