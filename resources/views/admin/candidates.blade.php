@extends('layouts.master')

@section('content')
    <nav class="navbar shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <div class="dropdown">
                    <a href="#" class="item">Menu</a>
                    <ul class="dropdown-menu shadow">
                        <li>
                            <a href="#" class="logout-button">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
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
            <h1 class="prompt success text-center" style="margin-top: 0;">Candidates</h1>
            <div class="input-group text-right">
                <button class="button primary"><span class="fas fa-plus"></span> Add Candidate</button>
            </div>
            <table class="table bordered striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Name</th>
                        <th>Party</th>
                        <th>Position</th>
                        <th width="20%">Action(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @each('partials.table_candidates', $candidates, 'candidate')
                </tbody>
            </table>
            <div class="text-right">{{ $candidates->links() }}</div>
        </div>
    </div>
@endsection
