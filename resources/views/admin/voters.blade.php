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
                <li><a href="{{ route('admin.get.settings') }}">System Settings</a></li>
            </ul>
            <div style="color: #aaa; font-size: 10px; font-weight: bold; padding: 0 10px; margin-top: 10px;">DATA MANAGEMENT</div>
            <ul class="sidebar-list">
                <li><a href="{{ route('admin.get.candidates') }}">Candidates</a></li>
                <li><a href="{{ route('admin.get.parties') }}">Parties</a></li>
                <li><a href="{{ route('admin.get.positions') }}">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}" class="active">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <div class="admin-navbar-title">Voters</div>
            </div>
            @include('partials.flash')
            <div class="input-group text-right">
                <a href="{{ route('admin.get.voters_add') }}" class="button primary"><span class="fas fa-plus"></span> Add Voter</a>
            </div>
            <table class="table bordered striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Name</th>
                        <th>Gender</th>
                        <th width="20%">College</th>
                        <th width="20%">Course</th>
                        <th width="15%">Action(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @each('partials.table_voters', $voters, 'voter')
                </tbody>
            </table>
            <div class="text-right">{{ $voters->links() }}</div>
        </div>
    </div>
    <form id="delete-form" action="{{ route('admin.post.candidates_remove') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" id="delete-id" name="id" value="">
    </form>
@endsection
