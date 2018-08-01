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
                <a href="{{ route('admin.get.reports_tally') }}" class="tab-item active">Report 1</a>
                <a href="{{ route('admin.get.reports_summary') }}" class="tab-item">Report 2</a>
            </div>
            <div class="tab-content">
                <div class="text-right" style="margin-bottom: 15px;">
                    <a href="{{ route('admin.get.reports_print_tally') }}" target="_blank" class="button primary">Print Report</a>
                </div>
                <table class="table bordered striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Name</th>
                            <th>Position</th>
                            <th>Party</th>
                            <th width="15%">Total No. of Votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($candidates->count() > 0)
                            @each('partials.reports_tally', $candidates, 'candidate', 'partials.no_results')
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No results found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
