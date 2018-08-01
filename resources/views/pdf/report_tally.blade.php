@extends('layouts.pdf')

@section('content')
    <div class="text-center">
        <h1 style="margin-bottom: 0;">TCC Worthy Votes</h1>
        <h3 style="margin-top: 0;">Tally Report</h3>
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
                                <td class="text-center">{{ ($candidate->votes->count() > 0 && $candidate->votes->count() === $highest_vote_counts[$position->name] ? 'Winner' : '') }}</td>
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
@endsection
