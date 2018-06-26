<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Jenssegers\Agent\Agent;

use App\Accounts;
use App\Positions;

class HomeController extends Controller
{
    private $agent = null;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function index()
    {
        if($this->agent->isMobile()) {
            return redirect()->route('home.get.download');
        }

        $data['voted_students_count'] = Accounts::where('type', 'Student')->where('has_voted', true)->count();
        $data['students'] = Accounts::where('type', 'Student')->get();
        $data['positions'] = Positions::all();

        return view('home.index', $data);
    }

    public function electionResults()
    {
        if($this->agent->isMobile()) {
            return redirect()->route('home.get.download');
        }

        $data['positions'] = Positions::all();

        return view('home.results', $data);
    }

    public function download()
    {
        return view('home.download', [
            'platform' => $this->agent->platform()
        ]);
    }
}
