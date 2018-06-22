@extends('layouts.master')

@section('content')
    <nav class="navbar fixed-top shadow">
        <div class="content">
            <div class="left">
                <div class="item title">Worth Votes</div>
            </div>
            <div class="right">
                <a href="{{ route('home.get.index') }}" class="item">Home</a>
                <a href="{{ route('home.get.election_results') }}" class="item active">Election Results</a>
                <a href="{{ route('home.get.download') }}" class="item">Download</a>
            </div>
        </div>
    </nav>
    <div class="body-content fixed-navbar fixed-footer">
        <div class="container wide">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam dolor minus numquam nam tenetur nihil ipsum quas voluptates amet dolorem expedita dicta et libero, architecto soluta qui minima aliquam magni?</p>
        </div>
    </div>
    <div class="footer fixed">
        <div class="content">
            <div>Copyright © 2018 Supreme Student Council of Leaders.</div>
            <div>All Rights Reserved.</div>
        </div>
    </div>
@endsection
