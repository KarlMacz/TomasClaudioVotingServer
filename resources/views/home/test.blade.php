@extends('layouts.master')

@section('content')
    <h1 style="padding: 0 15px;">Unsorted Candidates</h1>
    @foreach($unsorted_candidates as $candidate)
        <div style="padding: 15px;">
            <h2 style="margin: 5px 0;">{{ $candidate->votes->count() . ' vote' . ($candidate->votes->count() === 1 ? '' : 's') }}</h2>
            <div><strong>{{ $candidate->id }}</strong> {{ $candidate->student_info->full_name() }}</div>
        </div>
    @endforeach
    <h1 style="padding: 0 15px;">Sorted Candidates (Ascending Order)</h1>
    @foreach($sorted_candidates_asc as $candidate)
        <div style="padding: 15px;">
            <h2 style="margin: 5px 0;">{{ $candidate->votes->count() . ' vote' . ($candidate->votes->count() === 1 ? '' : 's') }}</h2>
            <div><strong>{{ $candidate->id }}</strong> {{ $candidate->student_info->full_name() }}</div>
        </div>
    @endforeach
    <h1 style="padding: 0 15px;">Sorted Candidates (Descending Order)</h1>
    @foreach($sorted_candidates_desc as $candidate)
        <div style="padding: 15px;">
            <h2 style="margin: 5px 0;">{{ $candidate->votes->count() . ' vote' . ($candidate->votes->count() === 1 ? '' : 's') }}</h2>
            <div><strong>{{ $candidate->id }}</strong> {{ $candidate->student_info->full_name() }}</div>
        </div>
    @endforeach
@endsection
