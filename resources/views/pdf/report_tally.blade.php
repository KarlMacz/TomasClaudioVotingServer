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
        <div><strong>Tally of Candidates Total Votes</strong></div>
        <div><strong><?php echo date('F d, Y'); ?></strong></div>
    </div>
    <table class="table bordered striped">
        <tbody>
            @if($positions->count() > 0)
                @foreach($positions as $index => $position)
                    <tr style="background-color: #4c9261; color: white;">
                        <td colspan="3" class="text-center"><strong>For {{ $position->name }}</strong></td>
                    </tr>
                    <tr style="background-color: #80bb93; color: white;">
                        <td class="text-center"><strong>Candidate Name</strong></td>
                        <td class="text-center"><strong>Total No. of Votes</strong></td>
                        <td class="text-center"><strong>Result</strong></td>
                    </tr>
                    @if($position->candidates->count() > 0)
                        @foreach($position->candidates as $candidate)
                            <tr>
                                <td class="text-center">{{ $candidate->student_info->full_name() }}</td>
                                <td class="text-center">{{ $candidate->votes->count() }}</td>
                                <td class="text-center">{{ ($candidate->votes->count() > 0 && $candidate->votes->count() === $highest_vote_counts[$position->name] ? ($tied_winners[$position->name] ? 'Tie' : 'Winner') : '') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No results found.</td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td class="text-center">No results found.</td>
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
