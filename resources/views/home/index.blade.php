@extends('layouts.master')

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
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
            <h1 class="prompt success text-center">Voter Statistics</h1>
            <div class="card-grid">
                <div class="card">
                    <div class="card-body">
                        <div class="tag">
                            <div class="tag-header">
                                <div class="tag-label large">{{ $voted_students_count }}</div>
                                <div class="tag-label small">Number of students who already voted</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tag">
                            <div class="tag-header">
                                <div class="tag-label large">{{ $students->count() }}</div>
                                <div class="tag-label small">Total number of students</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <h1 class="prompt info text-center">Candidates</h1>
            @foreach($positions as $position)
                <h2 class="text-center">Running for {{ $position->name }}</h2>
                <div class="card-grid">
                    @if($position->candidates->count() > 0)
                        @foreach($position->candidates as $candidate)
                            <div class="card">
                                <div class="card-image">
                                    <img src="{{ asset('img/test_image.png') }}">
                                </div>
                                <div class="card-header">
                                    <div class="card-title">{{ $candidate->student_info->full_name() }}</div>
                                    <div class="card-subtitle">{{ $candidate->party_info->name }} Party</div>
                                </div>
                            </div>
                        @endforeach
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
