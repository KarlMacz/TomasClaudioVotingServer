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
                <a href="{{ route('login') }}" class="item">Login</a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar fixed-footer">
        <div class="container wide">
            <h1 class="prompt success text-center">Voter Statistics</h1>
            <div class="row">
                <div class="column">
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
                <div class="column">
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
