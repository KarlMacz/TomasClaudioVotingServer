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
                <li><a href="{{ route('admin.get.parties') }}" class="active">Parties</a></li>
                <li><a href="{{ route('admin.get.positions') }}">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <a href="{{ route('admin.get.parties') }}" class="admin-navbar-button"><span class="fas fa-chevron-left"></span></a>
                <div class="admin-navbar-title">Add Party Information</div>
            </div>
            @include('partials.flash')
            <div class="container wide">
                <form action="{{ route('admin.post.parties_store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <label for="name-field">Party Name:</label>
                        <input type="text" name="name" id="name-field" class="input-control" required autofocus>
                    </div>
                    <div class="input-group">
                        <label for="platform-field">Platform:</label>
                        <textarea name="platform" maxlength="5000" class="input-control no-resize" id="platform-field" rows="5"></textarea>
                    </div>
                    <div class="input-group text-right">
                        <button type="submit" class="button primary"><span class="fas fa-plus"></span> Add Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
