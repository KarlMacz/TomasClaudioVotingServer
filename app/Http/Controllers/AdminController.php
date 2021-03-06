<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use App\Accounts;
use App\Candidates;
use App\Notifications;
use App\Parties;
use App\Positions;
use App\Settings;
use App\Students;
use App\Votes;

use Artisan;
use DB;
use PDF;

class AdminController extends Controller
{
    use Utilities;

    /*
    * GET Requests
    */
    public function index()
    {
        $votedStudentsCount = Accounts::where('type', 'Student')->where('has_voted', true)->count();
        $students = Accounts::where('type', 'Student')->get();
        $positions = Positions::all();
        $electionUntil = Settings::where('name', 'election_until')->first();
        $isResultsReleased = Settings::where('name', 'is_results_released')->first();
        
        return view('admin.index', [
            'voted_students_count' => $votedStudentsCount,
            'students' => $students,
            'positions' => $positions,
            'election_until' => $electionUntil->value,
            'is_results_released' => $isResultsReleased->value
        ]);
    }

    public function electionResults()
    {
        $positions = Positions::all();

        return view('admin.results', [
            'positions' => $positions
        ]);
    }

    public function voterReset()
    {
        return view('admin.voter_reset');
    }

    public function settings()
    {
        $sets = [];
        $settings = Settings::all();

        foreach($settings as $setting) {
            $sets[$setting->name] = $setting->value;
        }

        return view('admin.settings', [
            'settings' => $sets
        ]);
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

    public function tallyReport()
    {
        $candidates = Candidates::all();

        return view('admin.reports_tally', [
            'candidates' => $candidates
        ]);
    }

    public function printTallyReport()
    {
        $positions = Positions::all();
        $highestVotes = [];

        if($positions->count() > 0) {
            foreach($positions as $position) {
                $tiedWinners[$position->name] = false;

                if($position->candidates->count() > 0) {
                    $highest = 0;

                    foreach($position->candidates as $candidate) {
                        if($candidate->votes->count() > $highest) {
                            $tiedWinners[$position->name] = false;
                            $highest = $candidate->votes->count();
                        } else if($candidate->votes->count() == $highest) {
                            $tiedWinners[$position->name] = true;
                        }
                    }

                    $highestVoteCounts[$position->name] = $highest;
                }
            }
        }

        $pdf = PDF::loadView('pdf.report_tally', [
            'positions' => $positions,
            'highest_vote_counts' => $highestVoteCounts,
            'tied_winners' => $tiedWinners
        ]);

        return $pdf->stream('TCC Worthy Votes - Tally Report.pdf');
    }

    public function summaryReport()
    {
        $searchFor = Input::get('search_for', '');
        
        if($searchFor !== '') {
            $students = Students::whereHas('account_info', function($query) {
                    $query->where('type', 'Student');
                })
                ->where('first_name', 'like', '%' . $searchFor . '%')
                ->orWhere('middle_name', 'like', '%' . $searchFor . '%')
                ->orWhere('last_name', 'like', '%' . $searchFor . '%')
                ->orWhere(DB::raw('concat(first_name, " ", middle_name, " ", last_name)'), 'like', '%' . $searchFor . '%')
                ->orWhere(DB::raw('concat(first_name, " ", last_name)'), 'like', '%' . $searchFor . '%')
                ->paginate(100);
        } else {
            $students = Students::whereHas('account_info', function($query) {
                $query->where('type', 'Student');
            })->paginate(100);
        }

        return view('admin.reports_summary', [
            'students' => $students
        ]);
    }

    public function printSummaryReport()
    {
        $students = Students::whereHas('account_info', function($query) {
                $query->where('type', 'Student')
                    ->where('has_voted', true);
            })
            ->orderBy('year_level', 'asc')
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();

        $pdf = PDF::loadView('pdf.report_summary', [
            'students' => $students
        ]);

        return $pdf->stream('TCC Worthy Votes - Summary Report.pdf');
    }

    public function groupedSummaryReport()
    {
        $groupedCourses = Students::select('course')->groupBy('course')->get();
        $groupedYearLevels = Students::select('year_level')->groupBy('year_level')->get();
        $students = Accounts::where('type', 'Student')->where('has_voted', true)->get();

        return view('admin.reports_grouped_summary', [
            'grouped_courses' => $groupedCourses,
            'grouped_year_levels' => $groupedYearLevels,
            'students' => $students,
            'utilities' => $this
        ]);
    }

    public function printGroupedSummaryReport()
    {
        $groupedCourses = Students::select('course')->groupBy('course')->get();
        $groupedYearLevels = Students::select('year_level')->groupBy('year_level')->get();
        $students = Accounts::where('type', 'Student')->where('has_voted', true)->get();

        $pdf = PDF::loadView('pdf.report_grouped_summary', [
            'grouped_courses' => $groupedCourses,
            'grouped_year_levels' => $groupedYearLevels,
            'students' => $students,
            'utilities' => $this
        ]);

        return $pdf->stream('TCC Worthy Votes - Grouped Summary Report.pdf');
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
        
        if($request->has('image')) {
            $image = $request->file('image');

            $image->move('uploads', $image->getClientOriginalName());

            $candidate->position_id = $request->input('position');
            $candidate->party_id = $request->input('party');
            $candidate->candidacy_image = $image->getClientOriginalName();
        } else {
            $candidate->position_id = $request->input('position');
            $candidate->party_id = $request->input('party');
            $candidate->candidacy_image = null;
        }

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
        $party->platform = $request->input('platform', null);

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
            $student->year_level = $request->input('year_level');

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

    public function storeSettings(Request $request)
    {
        Settings::updateOrCreate([
            'name' => 'is_election_started'
        ], [
            'value' => $request->input('status', 0)
        ]);

        Settings::updateOrCreate([
            'name' => 'election_until'
        ], [
            'value' => date('Y-m-d H:i:s', strtotime($request->input('date') . ' ' . $request->input('time')))
        ]);

        session()->flash('prompt', [
            'status' => 'ok',
            'message' => 'Setting has been recorded.'
        ]);

        return redirect()->back();
    }

    public function resetSystem(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('accounts')->truncate();
        DB::table('administrators')->truncate();
        DB::table('candidates')->truncate();
        DB::table('migrations')->truncate();
        DB::table('notifications')->truncate();
        DB::table('parties')->truncate();
        DB::table('positions')->truncate();
        DB::table('settings')->truncate();
        DB::table('students')->truncate();
        DB::table('votes')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $exitCode = Artisan::call('db:seed');

        if($exitCode === 0) {
            session()->invalidate();

            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'System reset successful. Due to this action, you have been forced to logout of the system.'
            ]);

            return redirect()->route('login');
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to execute system reset. Please refresh the page and try again.'
            ]);

            return redirect()->back();
        }
    }

    public function resultsNotification(Request $request)
    {
        $setting = Settings::where('name', 'is_results_released')->first();

        $setting->value = $request->input('status', 0);

        if($setting->save()) {
            $notifications = new Notifications();

            $notifications->subject = 'The results are out!';
            $notifications->message = 'Election results are now released. You may now view the newly elected officers.';

            $notifications->save();

            session()->flash('prompt', [
                'status' => 'ok',
                'message' => 'Election results are now released.'
            ]);
        } else {
            session()->flash('prompt', [
                'status' => 'error',
                'message' => 'Failed to release election results.'
            ]);
        }

        return redirect()->back();
    }
}
