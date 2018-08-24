@extends('layouts.pdf')

@section('content')
    <div class="text-center">
        <h1 style="margin-bottom: 0;">TCC Worthy Votes</h1>
        <h3 style="margin-top: 0;">Grouped Summary Report</h3>
    </div>
    @if($grouped_year_levels->count() > 0)
        @foreach($grouped_year_levels as $year_level)
            <?php
                $total = 0;
            ?>
            <table class="table bordered striped">
                <thead>
                    <tr>
                        <th class="text-center" colspan="2">{{ $utilities->ordinal($year_level->year_level) }} Year</th>
                    </tr>
                    <tr>
                        <th class="text-center" width="50%">Courses</th>
                        <th class="text-center">No. of students who already voted</th>
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
@endsection
