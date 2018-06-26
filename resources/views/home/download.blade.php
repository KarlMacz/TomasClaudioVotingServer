@extends('layouts.mobile')

@section('content')
    @if($platform !== 'AndroidOS' && $platform !== 'iOS')
        <a href="{{ route('home.get.index') }}" class="bling-bling">&#8249; Go Back</a>
    @endif
    <div class="moblify">
        <div class="moblify-body">
            <div class="text-center">
                <img src="{{ asset('img/tcc_logo.png') }}" style="margin-top: -50px; height: 100px;">
                <div style="font-family: 'Satisfy'; font-size: 40px; margin-top: -5px; margin-bottom: 40px;">{{ config('app.name') }}</div>
                <h1>Download our Mobile Application</h1>
                @if($platform === 'AndroidOS')
                    <a href="" class="image-link"><img src="{{ asset('img/google_play_badge.svg') }}"></a>
                    <span><strong>OR</strong></span>
                    <a href="" class="image-link"><img src="{{ asset('img/apk_file_badge.png') }}"></a>
                @elseif($platform === 'iOS')
                    <a href="" class="image-link"><img src="{{ asset('img/app_store_badge.svg') }}"></a>
                @else
                    <h4>For Android</h4>
                    <a href="" class="image-link"><img src="{{ asset('img/google_play_badge.svg') }}"></a>
                    <span><strong>OR</strong></span>
                    <a href="" class="image-link"><img src="{{ asset('img/apk_file_badge.png') }}"></a>
                    <h4>For iOS</h4>
                    <a href="" class="image-link"><img src="{{ asset('img/app_store_badge.svg') }}"></a>
                @endif
            </div>
        </div>
        <div class="moblify-footer">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
@endsection
