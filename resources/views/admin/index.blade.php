@extends('layouts.admin')

@section('resources')
    <script>
        $(document).ready(function() {
            $('body').on('change', '#results-field', function() {
                $(this).attr('readonly', true);
                $('#results-form').submit();
            });
        });
    </script>
@endsection

@section('content')
    <div class="body-content admin">
        <div class="sidebar">
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">MENU</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.index') }}" class="active">Dashboard</a></li>
                <li><a href="{{ route('admin.get.election_results') }}">Election Results</a></li>
                <li><a href="{{ route('admin.get.settings') }}">System Settings</a></li>
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
                <div class="admin-navbar-title">Dashboard</div>
            </div>
            <div class="container wide">
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
                <div class="row">
                    <div class="column span-6 offset-6">
                        <div class="input-group no-margin">
                            <label for="results-field">Release Election Results:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="column span-2 offset-6">
                        <form id="results-form" action="{{ route('admin.post.notifications_results') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group text-center">
                                <label class="switch rounded">
                                    <input type="checkbox" id="results-field" name="status" value="1"{{ ($is_results_released ? ' checked' : '') }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="column span-4">
                        <div><strong>Note:</strong> Releasing election results on mobile devices will notify app users through their phone and e-mail.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
