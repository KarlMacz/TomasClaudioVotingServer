@extends('layouts.mobile')

@section('content')
    <div class="moblify">
        <div class="moblify-body">
            <div class="text-center">
                <img src="{{ asset('img/tcc_logo.png') }}" style="margin-top: -50px; height: 75px;">
                <div style="font-family: 'Satisfy'; font-size: 40px; margin-top: -5px; margin-bottom: 40px;">{{ config('app.name') }}</div>
                @if($platform === 'AndroidOS')
                    <h2>Get it on Google Play Store</h2>
                    <a href="" class="image-link"><img src="{{ asset('img/google_play_badge.svg') }}"></a>
                    <h2>You may also install the app through this APK File</h2>
                    <a href="" class="image-link"><img src="{{ asset('img/apk_file_badge.png') }}"></a>
                @elseif($platform === 'iOS')
                    <h2>Download on the App Store</h2>
                    <!-- <a href="" class="image-link"><img src="{{ asset('img/app_store_badge.svg') }}"></a> -->
                    <a href="" class="button">Download</a>
                    <button class="button">Download</button>
                    <button>Download</button>
                @endif
            </div>
        </div>
        <div class="moblify-footer">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
@endsection
