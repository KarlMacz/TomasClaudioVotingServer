<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Accounts;
use App\Candidates;
use App\Parties;
use App\Positions;
use App\Students;

class AdminController extends Controller
{
    /*
    * GET Requests
    */
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
        $parties = Parties::paginate(10);

        return view('admin.parties', [
            'parties' => $parties
        ]);
    }

    public function addParty()
    {
        return view('admin.parties_add');
    }

    public function editParty($id)
    {
        $party = Parties::where('id', $id)->first();

        return view('admin.parties_edit', [
            'party' => $party
        ]);
    }

    public function positions()
    {
        $positions = Positions::paginate(10);

        return view('admin.positions', [
            'positions' => $positions
        ]);
    }

    public function addPosition()
    {
        return view('admin.positions_add');
    }

    public function editPosition($id)
    {
        $position = Positions::where('id', $id)->first();

        return view('admin.positions_edit', [
            'position' => $position
        ]);
    }

    public function voters()
    {
        $voters = Students::paginate(100);

        return view('admin.voters', [
            'voters' => $voters
        ]);
    }

    public function addVoter()
    {
        return view('admin.voters_add');
    }

    public function editVoter($id)
    {
        $student = Students::where('id', $id)->first();

        return view('admin.voters_edit', [
            'voter' => $student
        ]);
    }

    /*
    * POST Requests
    */
    public function storeCandidate(Request $request)
    {
        $student = $request->input('student');

        $candidate = Candidates::firstOrNew([
            'student_id' => $student
        ]);

        $candidate->position_id = $request->input('position');
        $candidate->party_id = $request->input('party');

        if($candidate->save()) {
            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Candidate information has been recorded.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to record candidate information.'
            ]);
        }

        return redirect()->back();
    }

    public function removeCandidate(Request $request)
    {
        $count = Candidates::destroy($request->input('id'));

        if($count > 0) {
            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Candidate information has been removed.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to remove candidate information.'
            ]);
        }

        return redirect()->back();
    }

    public function storeParty(Request $request)
    {
        $id = $request->input('id');

        $party = Parties::firstOrNew([
            'id' => $id
        ]);

        $party->name = $request->input('name');

        if($party->save()) {
            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Party information has been recorded.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to record party information.'
            ]);
        }

        return redirect()->back();
    }

    public function removeParty(Request $request)
    {
        $count = Parties::destroy($request->input('id'));

        if($count > 0) {
            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Party has been removed.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to remove party.'
            ]);
        }

        return redirect()->back();
    }

    public function storePosition(Request $request)
    {
        $id = $request->input('id');

        $position = Positions::firstOrNew([
            'id' => $id
        ]);

        $position->name = $request->input('name');

        if($position->save()) {
            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Position has been recorded.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to record position.'
            ]);
        }

        return redirect()->back();
    }

    public function removePosition(Request $request)
    {
        $count = Positions::destroy($request->input('id'));

        if($count > 0) {
            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Position has been removed.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to remove position.'
            ]);
        }

        return redirect()->back();
    }

    public function storeVoter(Request $request)
    {
        $id = $request->input('id');
        $username = $request->input('username');
        $firstName = $request->input('first_name');
        $middleName = $request->input('middle_name', null);
        $lastName = $request->input('last_name');

        $account = Accounts::firstOrNew([
            'id' => $id
        ]);

        $account->username = $username;
        $account->type = 'Student';
        $account->email = $request->input('email');

        if($account->save()) {
            $student = Students::firstOrNew([
                'account_id' => $account->id
            ]);

            $student->account_id = $account->id;
            $student->first_name = $firstName;
            $student->middle_name = $middleName;
            $student->last_name = $lastName;
            $student->gender = $request->input('gender');
            $student->college = $request->input('college');
            $student->course = $request->input('course');

            $student->save();

            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Voter information has been recorded.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to record voter information.'
            ]);
        }

        return redirect()->back();
    }

    public function removeVoter(Request $request)
    {
        $id = $request->input('id');

        $student = Students::where('id', $id)->first();

        if($student) {
            $accountID = $student->account_id;
            $student2 = Students::where('id', $id)->delete();

            if($student2) {
                Accounts::where('id', $accountID)->delete();

                session()->flash('prompt', [
                    'status' => 'ok',
                    'message' => 'Voter information has been removed.'
                ]);
            } else {
                session()->flash('prompt', [
                    'status' => 'error',
                    'message' => 'Failed to remove voter information.'
                ]);
            }
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Unknown Voter. His/her information may have already been removed.'
            ]);
        }

        return redirect()->back();
    }
}
