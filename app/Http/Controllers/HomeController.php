<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Jenssegers\Agent\Agent;

use App\Accounts;
use App\Candidates;
use App\Positions;
use App\Settings;

class HomeController extends Controller
{
    private $agent = null;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    /*
    * GET Requests
    */
    public function test()
    {
        $unsortedCandidates = Candidates::all();
        $sortedCandidatesAsc = Candidates::get()->sortBy(function($c) {
            return $c->votes->count();
        });
        $sortedCandidatesDesc = Candidates::get()->sortByDesc(function($c) {
            return $c->votes->count();
        });

        return view('home.test', [
            'unsorted_candidates' => $unsortedCandidates,
            'sorted_candidates_asc' => $sortedCandidatesAsc,
            'sorted_candidates_desc' => $sortedCandidatesDesc
        ]);
    }

    public function index()
    {
        if($this->agent->isMobile()) {
            return redirect()->route('home.get.download');
        }

        $votedStudentsCount = Accounts::where('type', 'Student')->where('has_voted', true)->count();
        $students = Accounts::where('type', 'Student')->get();

        return view('home.index', [
            'voted_students_count' => $votedStudentsCount,
            'students' => $students
        ]);
    }

    public function electionResults()
    {
        if($this->agent->isMobile()) {
            return redirect()->route('home.get.download');
        }

        $votedStudentsCount = Accounts::where('type', 'Student')->where('has_voted', true)->count();
        $students = Accounts::where('type', 'Student')->get();
        $positions = Positions::all();

        return view('home.results', [
            'voted_students_count' => $votedStudentsCount,
            'students' => $students,
            'positions' => $positions
        ]);
    }

    public function download()
    {
        if($this->agent->is('iPhone')) {
            return redirect()->route('ios.get.login');
        }

        return view('home.download', [
            'platform' => $this->agent->platform()
        ]);
    }

    public function iosLogin()
    {
        if(session()->has('ios_auth')) {
            return redirect()->route('ios.get.home');
        }

        return view('ios.login');
    }

    public function iosHome()
    {
        if(!session()->has('ios_auth')) {
            return redirect()->route('ios.get.login');
        }

        $account = Accounts::where('username', session()->get('ios_auth')['username'])->where('type', 'Student')->first();

        if($account) {
            session()->put('ios_auth', [
                'id' => $account->id,
                'username' => $account->username,
                'type' => $account->type,
                'has_voted' => $account->has_voted,
                'image' => ($account->image != null ? ('uploads/' . $account->image) : null),
                'first_name' => $account->user_info->first_name,
                'middle_name' => $account->user_info->middle_name,
                'last_name' => $account->user_info->last_name,
                'full_name' => $account->user_info->full_name(),
                'gender' => $account->user_info->gender
            ]);
        }

        $isElectionStarted = Settings::where('name', 'is_election_started')->first();
        $electionUntil = Settings::where('name', 'election_until')->first();

        return view('ios.home', [
            'is_election_started' => $isElectionStarted->value,
            'election_until' => $electionUntil->value
        ]);
    }

    public function iosVote()
    {
        if(!session()->has('ios_auth')) {
            return redirect()->route('ios.get.login');
        }

        $positions = Positions::all();

        return view('ios.vote', [
            'positions' => $positions
        ]);
    }

    public function iosRanking()
    {
        if(!session()->has('ios_auth')) {
            return redirect()->route('ios.get.login');
        }

        $isResultsReleased = Settings::where('name', 'is_results_released')->first();
        $positions = Positions::all();
        $candidates = Candidates::get()->sortByDesc(function($c) {
            return $c->votes->count();
        });

        return view('ios.ranking', [
            'is_results_released' => $isResultsReleased->value,
            'positions' => $positions,
            'candidates' => $candidates
        ]);
    }

    /*
    * POST Requests
    */
    public function postIosLogin(Request $request)
    {
        $account = Accounts::where('username', $request->input('username'))->where('type', 'Student')->first();

        if($account) {
            session()->put('ios_auth', [
                'id' => $account->id,
                'username' => $account->username,
                'type' => $account->type,
                'has_voted' => $account->has_voted,
                'image' => ($account->image != null ? ('uploads/' . $account->image) : null),
                'first_name' => $account->user_info->first_name,
                'middle_name' => $account->user_info->middle_name,
                'last_name' => $account->user_info->last_name,
                'full_name' => $account->user_info->full_name(),
                'gender' => $account->user_info->gender
            ]);

            session()->flash('toasty', 'Login successful.');
        } else {
            session()->flash('toasty', 'Login failed.');
        }

        return redirect()->route('ios.get.home');
    }

    public function postIosLogout()
    {
        session()->flush();

        return redirect()->route('ios.get.login');
    }
}
