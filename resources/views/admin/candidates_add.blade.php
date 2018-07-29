@extends('layouts.admin')

@section('content')
    <div class="body-content admin">
        <div class="sidebar">
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">MENU</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.index') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.get.election_results') }}">Election Results</a></li>
                <li><a href="{{ route('admin.get.settings') }}">System Settings</a></li>
            </ul>
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">DATA MANAGEMENT</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.candidates') }}" class="active">Candidates</a></li>
                <li><a href="{{ route('admin.get.parties') }}">Parties</a></li>
                <li><a href="{{ route('admin.get.positions') }}">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <a href="{{ route('admin.get.candidates') }}" class="admin-navbar-button"><span class="fas fa-chevron-left"></span></a>
                <div class="admin-navbar-title">Add Candidate Information</div>
            </div>
            @include('partials.flash')
            <div class="container wide">
                <form action="{{ route('admin.post.candidates_store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="column span-5">
                            <div class="input-group">
                                <input type="file" name="image" id="image-field" class="image-control">
                                <div class="image-preview">
                                    <div class="text-center"><strong>Choose an image</strong> or drag it here.</div>
                                </div>
                            </div>
                        </div>
                        <div class="column span-7">
                            <div class="input-group">
                                <label for="full-name-field">Full Name:</label>
                                <select name="student" id="full-name-field" class="input-control" required autofocus>
                                    <option value="" selected disabled>Select an option...</option>
                                    @each('partials.option_non_candidate_students', $students, 'student')
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="party-field">Party:</label>
                                <select name="party" id="party-field" class="input-control" required>
                                    <option value="" selected disabled>Select an option...</option>
                                    @each('partials.option_parties', $parties, 'party')
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="position-field">Position:</label>
                                <select name="position" id="position-field" class="input-control" required>
                                    <option value="" selected disabled>Select an option...</option>
                                    @each('partials.option_positions', $positions, 'position')
                                </select>
                            </div>
                            <div class="input-group text-right">
                                <button type="submit" class="button primary"><span class="fas fa-plus"></span> Add Information</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
