@extends('layouts.master')

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">Worth Votes</div>
            </div>
            <div class="right">
                <a href="{{ route('home.get.index') }}" class="item active">Home</a>
                <a href="{{ route('home.get.election_results') }}" class="item">Election Results</a>
                <a href="{{ route('home.get.download') }}" class="item">Download</a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar fixed-footer">
        <div class="container wide">
            <h1 class="prompt success text-center">Candidates</h1>
            @foreach($positions as $position)
                <h3>Running for {{ $position->name }}</h3>
                <div class="card-swiper"></div>
            @endforeach
        </div>
    </div>
    <div class="footer fixed">
        <div class="content">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
@endsection
