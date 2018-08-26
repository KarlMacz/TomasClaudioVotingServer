@extends('layouts.mobile')

@section('resources')
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <script>
        var settings = [];

        $(document).ready(function() {
            $(function() {
                if("{{ (session()->has('toasty') ? 'true' : 'false') }}" == "true") {
                    setToasty('status-toasty', "{{ session()->get('toasty') }}");
                    openToasty('status-toasty');

                    setTimeout(function() {
                        closeToasty('status-toasty');
                    }, 2000);
                }

                $.ajax({
                    url: '/api/json/data/settings',
                    method: 'POST',
                    data: {
                        app_key: 'bf536f9c54b5e47d8e9e0a94c239008dbdd9831fc27c861f7049988b7267bde6'
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if(response.status === 'ok') {
                            for(var index in response.data) {
                                settings[response.data[index].name] = response.data[index].value;
                            }

                            var cdown = countdown(new Date(settings['election_until']), function(ts) {
                                    $('#countdown').text(('0' + ts.hours).slice(-2) + ':' + ('0' + ts.minutes).slice(-2) + ':' + ('0' + ts.seconds).slice(-2));

                                    if($('#countdown').text() === '00:00:00') {
                                        window.clearInterval(cdown);

                                        $('#countdown-container').html('<div class="card">\
                                                <div class="card-body">\
                                                    <div style="margin-top: 5px;">\
                                                        <div style="text-align: center;">VOTING IS NOW OVER.</div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            <a href="' + "{{ route('ios.get.ranking') }}" + '" class="card">\
                                                <div class="card-body">\
                                                    <div style="font-size: 30px; text-align: center;">Candidates Ranking</div>\
                                                    <div style="text-align: center;">Tap here to view ranking.</div>\
                                                </div>\
                                            </a>');
                                    }
                                },
                                countdown.HOURS|countdown.MINUTES|countdown.SECONDS);
                        }
                    }
                });
            });

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
            <div id="countdown-container">
                @if(date('Y-m-d H:i:s', strtotime($election_until)) < date('Y-m-d H:i:s'))
                    <div class="card">
                        <div class="card-body">
                            <div style="margin-top: 5px;">
                                <div style="text-align: center;">VOTING IS NOW OVER.</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div style="margin-top: 5px;">
                                <div style="font-size: 20px; text-align: center;">ELECTION ENDS IN:</div>
                                <div id="countdown" style="font-size: 50px; text-align: center;"></div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(session()->get('ios_auth')['has_voted'] != 1 && date('Y-m-d H:i:s', strtotime($election_until)) > date('Y-m-d H:i:s') && $is_election_started == 1)
                    <a href="{{ route('ios.get.vote') }}" class="card">
                        <div class="card-body">
                            <div style="font-size: 30px; text-align: center;">Vote Now</div>
                            <div style="text-align: center;">Tap here to start voting.</div>
                        </div>
                    </a>
                @endif
                @if(session()->get('ios_auth')['has_voted'] == 1 || date('Y-m-d H:i:s', strtotime($election_until)) < date('Y-m-d H:i:s'))
                    <a href="{{ route('ios.get.ranking') }}" class="card">
                        <div class="card-body">
                            <div style="font-size: 30px; text-align: center;">Candidates Ranking</div>
                            <div style="text-align: center;">Tap here to view ranking.</div>
                        </div>
                    </a>
                    <a href="{{ route('ios.get.my_vote_history') }}" class="card">
                        <div class="card-body">
                            <div style="font-size: 30px; text-align: center;">My Votes</div>
                            <div style="text-align: center;">Tap here to view all the candidates you voted for.</div>
                        </div>
                    </a>
                @endif
            </div>
            @if($parties->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <div style="font-size: 30px; text-align: center; margin-bottom: 15px;">Partylist Platforms</div>
                        @foreach($parties as $party)
                            <div class="card bordered">
                                <div class="card-header">
                                    <div class="card-title">{{ $party->name }} Party</div>
                                </div>
                                <div class="card-body">{{ ($party->platform !== null ? $party->platform : 'None') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
@endsection
