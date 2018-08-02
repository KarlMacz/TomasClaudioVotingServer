@extends('layouts.admin')

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
                @if(date('Y-m-d H:i:s', strtotime($election_until)) < date('Y-m-d H:i:s'))
                    <div class="row">
                        <div class="column span-4 offset-4">
                            <div style="margin-top: 10px;">
                                <form action="{{ route('admin.post.notifications_results') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="text-center">
                                        <button type="submit" class="button primary large">Release Election Results</button>
                                    </div>
                                </form>
                            </div>
                            <div class="text-center" style="margin-top: 10px;"><strong>Note:</strong> Releasing election results on mobile devices will notify app users through their phone and e-mail.</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
