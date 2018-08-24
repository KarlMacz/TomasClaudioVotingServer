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
                <li><a href="{{ route('admin.get.candidates') }}">Candidates</a></li>
                <li><a href="{{ route('admin.get.parties') }}">Parties</a></li>
                <li><a href="{{ route('admin.get.positions') }}">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <div class="admin-navbar-title">Reports</div>
            </div>
            <div class="tab">
                <a href="{{ route('admin.get.reports_tally') }}" class="tab-item">Report 1</a>
                <a href="{{ route('admin.get.reports_summary') }}" class="tab-item active">Report 2</a>
                <a href="{{ route('admin.get.reports_grouped_summary') }}" class="tab-item">Report 3</a>
            </div>
            <div class="tab-content">
                <h2 class="no-margin">Summary of students who already voted</h2>
                <hr>
                <div class="row">
                    <div class="column span-4">
                        <form action="{{ route('admin.get.reports_summary') }}" method="GET">
                            <div class="input-group">
                                <label for="search-field">Search for:</label>
                                <input type="text" name="search_for" id="search-field" class="input-control" autofocus>
                            </div>
                        </form>
                    </div>
                    <div class="column span-8">
                        <div class="text-right" style="margin-bottom: 15px;">
                            <a href="{{ route('admin.get.reports_print_summary') }}" target="_blank" class="button primary">Print Report</a>
                        </div>
                    </div>
                </div>
                <table class="table bordered striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Name</th>
                            <th>College</th>
                            <th>Course</th>
                            <th width="10%">Year Level</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($students->count() > 0)
                            @each('partials.reports_summary', $students, 'student')
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No results found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="text-right">{{ $students->links() }}</div>
            </div>
        </div>
    </div>
@endsection
