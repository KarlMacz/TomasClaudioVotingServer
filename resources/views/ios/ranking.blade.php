@extends('layouts.mobile')

@section('resources')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#menu-button', function() {
                openSidedy('sidedy');

                return false;
            });

            $('body').on('click', '#sidedy', function() {
                closeSidedy('sidedy');
            });

            $('body').on('click', '#sidedy .sidedy-content', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <a href="#" id="menu-button" class="item"><span class="fas fa-bars"></span></a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar">
        <div class="container">
            <h2 class="text-center" style="margin-top: 0;">Ranking</h2>
            @if($positions->count() > 0)
                @foreach($positions as $position)
                    <?php
                        $cc = 0;
                    ?>
                    <h3 style="margin-bottom: 5px;">Running for {{ $position->name }}</h3>
                    @if($position->candidates->count() > 0)
                        <div class="minty">
                            @if($is_results_released == 1)
                                <?php
                                    $candidates = $position->candidates->sortByDesc(function($c) {
                                        return $c->votes->count();
                                    });
                                ?>
                                @foreach($candidates as $candidate)
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="{{ ($candidate->candidacy_image != null ? asset('uploads/' . $candidate->candidacy_image) : asset('img/' . ($candidate->student_info->gender === 'Female' ? 'female.png' : 'male.png'))) }}">
                                        </div>
                                        <div class="card-header">
                                            <div class="card-title" style="color: #4c9261;">{{ $candidate->student_info->full_name() }}</div>
                                            <div class="card-subtitle text-center"><strong>{{ $candidate->votes->count() . '%' }}</strong></div>
                                        </div>
                                        <div class="card-body text-center"><strong>{{ $utilities->ordinal($candidate->student_info->year_level) }} Year</strong><br>{{ $candidate->student_info->course }}</div>
                                    </div>
                                @endforeach
                            @else
                                <?php
                                    $candidates = $position->candidates->sortByDesc(function($c) {
                                        return $c->votes->count();
                                    });
                                ?>
                                @foreach($candidates as $candidate)
                                    <?php
                                        $cc++;
                                    ?>
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="{{ asset('img/questionable.png') }}">
                                        </div>
                                        <div class="card-header">
                                            <div class="card-title" style="color: #4c9261;">Candidate {{ $cc }}</div>
                                            <div class="card-subtitle text-center"><strong>{{ $candidate->votes->count() . '%' }}</strong></div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                @endforeach
            @endif
            <div style="margin-top: 10px;">
                <a href="{{ route('ios.get.home') }}" class="button primary" style="text-align: center; width: 100%;">Go back to Home</a>
            </div>
        </div>
    </div>
    <div id="sidedy" class="sidedy">
        <div class="sidedy-content">
            <ul class="sidedy-sidedybar">
                <li class="profiler">
                    <div class="image">
                        <img src="{{ (session()->get('ios_auth')['image'] != null ? session()->get('ios_auth')['image'] : (session()->get('ios_auth')['gender'] === 'Female' ? asset('img/female.png') : asset('img/male.png'))) }}">
                    </div>
                    <div class="title">{{ session()->get('ios_auth')['full_name'] }}</div>
                    <div class="subtitle">{{ session()->get('ios_auth')['type'] }}</div>
                </li>
                <li><a href="{{ route('ios.get.home') }}">Home</a></li>
                <li>
                    <a href="#" class="logout-button">Logout</a>
                    <form id="logout-form" action="{{ route('ios.post.logout') }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div id="status-toasty" class="toasty"></div>
@endsection
