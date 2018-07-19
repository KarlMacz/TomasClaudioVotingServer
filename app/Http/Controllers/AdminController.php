<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function electionResults()
    {
        return view('admin.results');
    }

    public function voterReset()
    {
        return view('admin.voter_reset');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function candidates()
    {
        return view('admin.candidates');
    }

    public function parties()
    {
        return view('admin.parties');
    }

    public function positions()
    {
        return view('admin.positions');
    }

    public function voters()
    {
        return view('admin.voters');
    }
}
