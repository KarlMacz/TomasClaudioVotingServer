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
                        <h1>Vision</h1>
                        <p class="text-justify">Tomas Claudio Colleges aspires to be a community-based institution of learning dedicated to academic excellence, employing democratic and ideal leadership to deliver educational services geared towards the attainment of quality life among its clientele.</p>
                        <h1>Mission</h1>
                        <p class="text-justify">Tomas Claudio Colleges will;</p>
                        <ul>
                            <li>Provide opportunities for professional growth and development of entrepreneurial skills and competencies.</li>
                            <li>Pursue its commitment to academic excellence through the development and inculcation of “Claudian” values such as personal discipline and love of God.</li>
                            <li>To promite community service-oriented graduates.</li>
                        </ul>
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
