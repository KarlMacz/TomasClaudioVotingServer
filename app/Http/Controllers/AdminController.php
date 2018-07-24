<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Candidates;
use App\Parties;
use App\Positions;
use App\Students;

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
        $candidates = Candidates::paginate(10);

        return view('admin.candidates', [
            'candidates' => $candidates
        ]);
    }

    public function addCandidate()
    {
        $parties = Parties::all();
        $positions = Positions::all();
        $students = Students::all();

        return view('admin.candidates_add', [
            'parties' => $parties,
            'positions' => $positions,
            'students' => $students
        ]);
    }

    public function editCandidate($id)
    {
        $candidate = Candidates::where('id', $id)->first();
        $parties = Parties::all();
        $positions = Positions::all();

        return view('admin.candidates_edit', [
            'candidate' => $candidate,
            'parties' => $parties,
            'positions' => $positions
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
}
