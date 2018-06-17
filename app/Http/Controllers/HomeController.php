<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function electionResults()
    {
        return view('home.results');
    }

    public function download()
    {
        return view('home.download');
    }
}
