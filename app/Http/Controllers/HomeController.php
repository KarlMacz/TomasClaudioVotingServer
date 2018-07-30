<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Jenssegers\Agent\Agent;

use App\Accounts;
use App\Positions;

class HomeController extends Controller
{
    private $agent = null;

    /*
    * GET Requests
    */
    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function index()
    {
        if($this->agent->isMobile()) {
            return redirect()->route('home.get.download');
        }

        $votedStudentsCount = Accounts::where('type', 'Student')->where('has_voted', true)->count();
        $students = Accounts::where('type', 'Student')->get();
        $positions = Positions::all();

        return view('home.index', [
            'voted_students_count' => $votedStudentsCount,
            'students' => $students,
            'positions' => $positions
        ]);
    }

    public function electionResults()
    {
        if($this->agent->isMobile()) {
            return redirect()->route('home.get.download');
        }

        $positions = Positions::all();

        return view('home.results', [
            'positions' => $positions
        ]);
    }

    public function download()
    {
        return view('home.download', [
            'platform' => $this->agent->platform()
        ]);
    }
}
