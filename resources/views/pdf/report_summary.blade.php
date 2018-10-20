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
        <div><strong>Summary of Students</strong></div>
        <div><strong><?php echo date('F d, Y'); ?></strong></div>
    </div>
    <table class="table bordered striped">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="25%">Name</th>
                <th>College</th>
                <th>Course</th>
                <th width="10%">Year Level</th>
            </tr>
        </thead>
        <tbody>
            @if($students->count() > 0)
                @foreach($students as $student)
                    <tr>
                        <td class="text-center">{{ $student->id }}</td>
                        <td>{{ $student->full_name() }}</td>
                        <td>{{ $student->college }}</td>
                        <td>{{ $student->course }}</td>
                        <td class="text-center">{{ $student->year_level }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No results found.</td>
                </tr>
            @endif
        </tbody>
    </table>
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
