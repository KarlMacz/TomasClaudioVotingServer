@extends('layouts.admin')

@section('resources')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.view-button', function() {
            });

            $('body').on('click', '.delete-button', function() {
                $('#delete-form #delete-id').val($(this).attr('data-id'));

                $('#delete-form').submit();

                return false;
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
                <li><a href="{{ route('admin.get.settings') }}" class="active">System Settings</a></li>
            </ul>
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">DATA MANAGEMENT</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.candidates') }}">Candidates</a></li>
                <li><a href="{{ route('admin.get.parties') }}">Parties</a></li>
                <li><a href="{{ route('admin.get.positions') }}">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <div class="admin-navbar-title">System Settings</div>
            </div>
            @include('partials.flash')
            <div class="container wide">
                <form action="{{ route('admin.post.settings_store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="column span-12">
                            <div class="input-group no-margin">
                                <label for="election-status-field">Election Status:</label>
                            </div>
                            <div class="row">
                                <div class="column span-2">
                                    <div class="input-group text-center">
                                        <label class="switch rounded">
                                            <input type="checkbox" id="election-status-field" name="status" value="1"{{ ($settings['is_election_started'] ? ' checked' : '') }}>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="column span-10">
                                    <div class="prompt no-margin">The server is currently <strong>{{ ($settings['is_election_started'] ? 'running' : 'stopped') }}</strong>.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column span-6">
                            <div class="input-group">
                                <label for="election-date-field">Election until Date:</label>
                                <input type="date" name="date" id="election-date-field" class="input-control" value="{{ date('Y-m-d', strtotime($settings['election_until'])) }}" required>
                            </div>
                        </div>
                        <div class="column span-6">
                            <div class="input-group">
                                <label for="election-time-field">Election until Time:</label>
                                <input type="time" name="time" id="election-time-field" class="input-control" value="{{ date('H:i:s', strtotime($settings['election_until'])) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column span-12">
                            <div class="input-group text-right">
                                <button type="submit" class="button primary"><span class="fas fa-check"></span> Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
