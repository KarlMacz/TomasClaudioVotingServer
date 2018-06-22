<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Positions;

class HomeController extends Controller
{
    public function index()
    {
        $data['positions'] = Positions::all();

        return view('home.index', $data);
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
