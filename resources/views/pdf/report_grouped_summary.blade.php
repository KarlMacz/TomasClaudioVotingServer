@extends('layouts.pdf')

@section('content')
    <div style="margin-bottom: 15px;">
        <div style="display: inline-block; vertical-align: middle; padding: 0 15px;">
            <img src="img/tcc_logo.png" style="height: 80px;">
        </div>
        <div style="display: inline-block; vertical-align: middle;">
            <h1 style="color: #4c9261; margin: 0;">Tomas Claudio Colleges</h1>
            <h3 style="color: #4c9261; font-weight: normal; margin: 0;">Taghangin, Morong, Rizal</h3>
        </div>
    </div>
    <div class="text-center" style="font-size: 18px; margin: 15px 0;">
        <div>SUPREME STUDENT COUNCIL OF LEADERS</div>
        <div><strong>Summary of Students by Year Level & Course</strong></div>
        <div><strong><?php echo date('F d, Y'); ?></strong></div>
    </div>
    @if($grouped_year_levels->count() > 0)
        @foreach($grouped_year_levels as $year_level)
            <?php
                $total = 0;
            ?>
            <table class="table bordered striped">
                <thead>
                    <tr style="background-color: #4c9261; color: white;">
                        <th class="text-center" colspan="2">{{ $utilities->ordinal($year_level->year_level) }} Year</th>
                    </tr>
                    <tr style="background-color: #80bb93; color: white;">
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
    <div style="margin-top: 25px;">Signed by:</div>
    <div class="signatory">
        <div class="signatory-info">
            <strong>Ms. Carmina Eguia</strong>
            <br>
            <span>Head of Student Affairs</span>
        </div>
    </div>
    <div class="signatories">
        <div class="signatory">
            <div class="signatory-info">
                <strong>Mr. Rodolfo San Felipe</strong>
                <br>
                <span>Tomas Claudio Colleges President</span>
            </div>
        </div>
        <div class="signatory">
            <div class="signatory-info">
                <strong>Mr. Edmund Francisco</strong>
                <br>
                <span>Tomas Claudio Colleges Vice President</span>
            </div>
        </div>
    </div>
@endsection
