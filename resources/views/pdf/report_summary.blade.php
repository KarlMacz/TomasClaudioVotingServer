@extends('layouts.pdf')

@section('content')
    <div class="text-center">
        <h1 style="margin-bottom: 0;">TCC Worthy Votes</h1>
        <h3 style="margin-top: 0;">Summary Report</h3>
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
                @foreach($students as $account)
                    <tr>
                        <td class="text-center">{{ $account->id }}</td>
                        <td>{{ $account->full_name() }}</td>
                        <td>{{ $account->college }}</td>
                        <td>{{ $account->course }}</td>
                        <td class="text-center">{{ $account->year_level }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center">No results found.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
