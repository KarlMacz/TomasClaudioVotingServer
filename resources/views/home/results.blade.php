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
            <div class="jumpy shadow">
                <div class="jumpy-header">
                    <div class="jumpy-headpic">
                        <img src="{{ asset('img/38498637_2197895563830893_1139630977417478144_n.jpg') }}">
                        <div class="jumpy-headpic-text">
                            <img src="{{ asset('img/tcc_logo.png') }}" style="height: 150px; width: 150px;">
                            <div>Delivering responsive quality education and community involvement.</div>
                        </div>
                    </div>
                </div>
                <div class="jumpy-body">
                    <div class="jumpy-body-sidebar">
                        <div class="card">
                            <div class="card-body">
                                <div class="tag">
                                    <div class="tag-header">
                                        <div class="tag-label large">{{ $students->count() }}</div>
                                        <div class="tag-label">Total number of students</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tag">
                                    <div class="tag-header">
                                        <div class="tag-label large">{{ $voted_students_count }}</div>
                                        <div class="tag-label">Number of students who already voted</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jumpy-body-content">
                        <!-- asd -->
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
