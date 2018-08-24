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
                <a href="{{ route('admin.get.reports_summary') }}" class="tab-item">Report 2</a>
                <a href="{{ route('admin.get.reports_grouped_summary') }}" class="tab-item active">Report 3</a>
            </div>
            <div class="tab-content">
                <h2 class="no-margin">Summary of students who already voted (By Year Level & Course)</h2>
                <hr>
                <div class="text-right" style="margin-bottom: 15px;">
                    <a href="{{ route('admin.get.reports_print_grouped_summary') }}" target="_blank" class="button primary">Print Report</a>
                </div>
                @if($grouped_year_levels->count() > 0)
                    @foreach($grouped_year_levels as $year_level)
                        <?php
                            $total = 0;
                        ?>
                        <table class="table bordered striped">
                            <thead>
                                <tr>
                                    <th colspan="2">{{ $utilities->ordinal($year_level->year_level) }} Year</th>
                                </tr>
                                <tr>
                                    <th width="50%">Courses</th>
                                    <th>No. of students who already voted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($grouped_courses->count() > 0)
                                    @foreach($grouped_courses as $course)
                                        <tr>
                                            <td class="text-center">{{ $course->course }}</td>
                                            <td class="text-center">
                                                <?php
                                                    $ctr = 0;
                                                ?>
                                                @if($students->count() > 0)
                                                    @foreach($students as $student)
                                                        @if($student->user_info->year_level === $year_level->year_level && $student->user_info->course === $course->course)
                                                            <?php
                                                                $ctr += 1;
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                {{ $ctr }}
                                            </td>
                                        </tr>
                                        <?php
                                            $total += $ctr;
                                        ?>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right">Total:</th>
                                    <th class="text-center">{{ $total }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
