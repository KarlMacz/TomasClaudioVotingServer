@extends('layouts.admin')

@section('resources')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.view-button', function() {

            });
        });
    </script>
@endsection

@section('content')
    <div class="body-content admin">
        <div class="sidebar">
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">MENU</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.index') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.get.election_results') }}">Election Results</a></li>
                <li><a href="{{ route('admin.get.voter_reset') }}">Voter Reset</a></li>
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
        <div class="content">
            <h1 class="prompt success text-center" style="margin-top: 0;">Add Candidate Information</h1>
            <div class="container wide">
                <form action="{{ route('admin.get.candidates_add') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column span-5">
                            <div class="input-group">
                                <input type="file" id="image-field" class="image-control" multiple>
                                <div class="image-preview">
                                    <div class="text-center"><strong>Choose an image</strong> or drag it here.</div>
                                </div>
                            </div>
                        </div>
                        <div class="column span-7">
                            <div class="input-group">
                                <label for="full-name-field">Full Name:</label>
                                <select name="" id="full-name-field" class="input-control">
                                    @each('partials.option_students', $students, 'student')
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
