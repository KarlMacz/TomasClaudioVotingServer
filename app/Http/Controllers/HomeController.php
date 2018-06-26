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
            return view('home.dl', [
                'platform' => $this->agent->platform()
            ]);
        }

        $data['voted_students_count'] = Accounts::where('type', 'Student')->where('has_voted', true)->count();
        $data['students'] = Accounts::where('type', 'Student')->get();
        $data['positions'] = Positions::all();

        return view('home.index', $data);
    }

    public function electionResults()
    {
        if($this->agent->isMobile()) {
            return view('home.dl', [
                'platform' => $this->agent->platform()
            ]);
        }

        $data['positions'] = Positions::all();

        return view('home.results', $data);
    }

    public function download()
    {
        if($this->agent->isMobile()) {
            return view('home.dl', [
                'platform' => $this->agent->platform()
            ]);
        }

        return view('home.download');
    }
}
