<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Candidates;
use App\Parties;
use App\Positions;

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
        $candidates = Candidates::paginate(2);

        return view('admin.candidates', [
            'candidates' => $candidates
        ]);
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

    public function viewCandidate(Request $request)
    {
        $candidate = Candidate::where('id', $request->input('id'));
    }

    public function addCandidate(Request $request)
    {
    }
}
