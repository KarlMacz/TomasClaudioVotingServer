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
                <li><a href="{{ route('admin.get.positions') }}" class="active">Positions</a></li>
                <li><a href="{{ route('admin.get.voters') }}">Voters</a></li>
            </ul>
        </div>
        <div class="content navify">
            <div class="admin-navbar">
                <div class="admin-navbar-title">Positions</div>
            </div>
            @include('partials.flash')
            <div class="input-group text-right">
                <a href="{{ route('admin.get.positions_add') }}" class="button primary"><span class="fas fa-plus"></span> Add Position</a>
            </div>
            <table class="table bordered striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Name</th>
                        <th width="20%">Action(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @each('partials.table_positions', $positions, 'position')
                </tbody>
            </table>
            <div class="text-right">{{ $positions->links() }}</div>
        </div>
    </div>
    <form id="delete-form" action="{{ route('admin.post.positions_remove') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" id="delete-id" name="id" value="">
    </form>
@endsection
