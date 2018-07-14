@extends('layouts.master')

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">{{ config('app.name') }}</div>
            </div>
            <div class="right">
                <div class="dropdown">
                    <a href="#" class="item">Menu</a>
                    <ul class="dropdown-menu shadow">
                        <li>
                            <a href="#" class="logout-button">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="body-content admin fixed-navbar">
        <div class="sidebar">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis ut fuga molestiae laboriosam pariatur nam, sint possimus nulla exercitationem, illum, voluptates dicta ipsam, inventore eveniet illo maiores expedita reiciendis quibusdam.
        </div>
    </div>
@endsection
