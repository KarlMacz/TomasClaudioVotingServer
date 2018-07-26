@extends('layouts.master')

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <a href="{{ route('home.get.index') }}" class="item">Home</a>
                <a href="{{ route('home.get.election_results') }}" class="item active">Election Results</a>
                <a href="{{ route('login') }}" class="item">Login</a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar fixed-footer">
        <div class="container wide">
            <h1 class="prompt success text-center">Candidates</h1>
            @foreach($positions as $position)
                <h2 class="text-center">Running for {{ $position->name }}</h2>
                <div class="card-grid">
                    @if($position->candidates->count() > 0)
                        @each('partials.card_candidates', $position->candidates, 'candidate')
                    @else
                        <div class="prompt">No candidates running for this position.</div>
                    @endif
                </div>
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
