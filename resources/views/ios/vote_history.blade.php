@extends('layouts.mobile')

@section('resources')
    <script>
        var accountId = "{{ session()->get('ios_auth')['id'] }}";
        var candidatesSelected = [];
        var selectedCandidates = [];

        $(document).ready(function() {
            $('body').on('click', '#menu-button', function() {
                openSidedy('sidedy');

                return false;
            });

            $('body').on('click', '#sidedy', function() {
                closeSidedy('sidedy');
            });

            $('body').on('click', '#sidedy .sidedy-content', function(e) {
                e.stopPropagation();
            });
            
            $('body').on('click', '.tappable', function() {
                $('.tappable[data-position="' + $(this).attr('data-position') + '"]').css({
                    'border': '2px solid transparent'
                });

                if(selectedCandidates[$(this).attr('data-position')] != $(this).attr('data-id')) {
                    $(this).css({
                        'border': '2px solid #4c9261'
                    });

                    selectedCandidates[$(this).attr('data-position')] = $(this).attr('data-id');
                } else {
                    delete selectedCandidates[$(this).attr('data-position')];
                }

                console.log(selectedCandidates);

                return false;
            });

            $('body').on('click', '#submit-votes-button', function() {
                candidatesSelected = [];

                for(var key in selectedCandidates) {
                    candidatesSelected.push(selectedCandidates[key]);
                }

                openLoady();

                $.ajax({
                    url: '/api/json/data/submit_votes',
                    method: 'POST',
                    data: {
                        app_key: 'bf536f9c54b5e47d8e9e0a94c239008dbdd9831fc27c861f7049988b7267bde6',
                        account: accountId,
                        candidates: candidatesSelected
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        setToasty('status-toasty', response.message);
                        openToasty('status-toasty');

                        setTimeout(function() {
                            closeToasty('status-toasty');
                        }, 1000);

                        if(response.status === 'ok') {
                            setTimeout(function() {
                                window.location = "{{ route('ios.get.ranking') }}";
                            }, 1000);
                        } else {
                            closeLoady();
                        }
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <a href="#" id="menu-button" class="item"><span class="fas fa-bars"></span></a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar">
        <div class="container">
            <h2 class="text-center" style="margin-top: 0;">My Votes</h2>
            <div>These are the candidates you have voted for.</div>
            @if($votes->count() > 0)
                @foreach($votes as $vote)
                    <h3 style="margin-bottom: 5px;">{{ $vote->candidate_info->position_info->name }}</h3>
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ ($vote->candidate_info->candidacy_image != null ? asset('uploads/' . $vote->candidate_info->candidacy_image) : asset('img/' . ($vote->candidate_info->student_info->gender === 'Female' ? 'female.png' : 'male.png'))) }}">
                        </div>
                        <div class="card-header">
                            <div class="card-title" style="color: #4c9261;">{{ $vote->candidate_info->student_info->full_name() }}</div>
                            <div class="card-subtitle"><strong>{{ $vote->candidate_info->party_info->name }} Party</strong></div>
                        </div>
                        <div class="card-body">{{ $utilities->ordinal($vote->candidate_info->student_info->year_level) }} Year - {{ $vote->candidate_info->student_info->course }}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div id="sidedy" class="sidedy">
        <div class="sidedy-content">
            <ul class="sidedy-sidedybar">
                <li class="profiler">
                    <div class="image">
                        <img src="{{ (session()->get('ios_auth')['image'] != null ? session()->get('ios_auth')['image'] : (session()->get('ios_auth')['gender'] === 'Female' ? asset('img/female.png') : asset('img/male.png'))) }}">
                    </div>
                    <div class="title">{{ session()->get('ios_auth')['full_name'] }}</div>
                    <div class="subtitle">{{ session()->get('ios_auth')['type'] }}</div>
                </li>
                <li><a href="{{ route('ios.get.home') }}">Home</a></li>
                <li>
                    <a href="#" class="logout-button">Logout</a>
                    <form id="logout-form" action="{{ route('ios.post.logout') }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div id="status-toasty" class="toasty"></div>
    <div class="loady">
        <div class="loady-content text-center">
            <div>
                <span class="fas fa-circle-notch fa-spin"></span>
                <div>Please Wait...</div>
            </div>
        </div>
    </div>
@endsection
