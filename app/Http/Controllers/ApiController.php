<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Accounts;
use App\Candidates;
use App\Positions;
use App\Settings;
use App\Votes;

class ApiController extends Controller
{
    private function verifyApiKey($applicationKey)
    {
        if($applicationKey === 'bf536f9c54b5e47d8e9e0a94c239008dbdd9831fc27c861f7049988b7267bde6') {
            return true;
        }

        return false;
    }

    public function auth(Request $request)
    {
        if(!$this->verifyApiKey($request->input('app_key'))) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized access.'
            ]);
        }

        $resp = [];
        $account = Accounts::where('username', $request->input('username'))->first();

        if($account) {
            $resp = [
                'status' => 'ok',
                'message' => 'Login successful.',
                'data' => [
                    'username' => $account->username,
                    'type' => $account->type,
                    'has_voted' => $account->has_voted,
                    'image' => $account->image,
                    'first_name' => $account->user_info->first_name,
                    'middle_name' => $account->user_info->middle_name,
                    'last_name' => $account->user_info->last_name,
                    'gender' => $account->user_info->gender
                ]
            ];
        } else {
            $resp = [
                'status' => 'failed',
                'message' => 'Invalid username or student id number.'
            ];
        }

        return response()->json($resp);
    }

    public function data($what, Request $request)
    {
        if(!$this->verifyApiKey($request->input('app_key'))) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized access.'
            ]);
        }

        $resp = [];

        switch($what) {
            case 'candidates':
                $data = [];

                $candidates = Candidates::all();

                if($candidates->count() > 0) {
                    foreach($candidates as $candidate) {
                        $data[] = [
                            'id' => $candidate->id,
                            'first_name' => $candidate->student_info->first_name,
                            'middle_name' => $candidate->student_info->middle_name,
                            'last_name' => $candidate->student_info->last_name,
                            'gender' => $candidate->student_info->gender,
                            'candidacy_image' => $candidate->candidacy_image,
                            'college' => $candidate->student_info->college,
                            'course' => $candidate->student_info->course,
                            'position' => $candidate->position_info->name,
                            'party' => $candidate->party_info->name
                        ];
                    }
                }

                $resp = [
                    'status' => 'ok',
                    'message' => 'Request successful.',
                    'data' => $data
                ];

                break;
            case 'results':
                $data = [];

                $candidates = Candidates::all();

                if($candidates->count() > 0) {
                    foreach($candidates as $candidate) {
                        $data[] = [
                            'id' => $candidate->id,
                            'first_name' => $candidate->student_info->first_name,
                            'middle_name' => $candidate->student_info->middle_name,
                            'last_name' => $candidate->student_info->last_name,
                            'gender' => $candidate->student_info->gender,
                            'candidacy_image' => $candidate->candidacy_image,
                            'position' => $candidate->position_info->name,
                            'party' => $candidate->party_info->name,
                            'number_of_votes' => $candidate->votes->count()
                        ];
                    }
                }

                $resp = [
                    'status' => 'ok',
                    'message' => 'Request successful.',
                    'data' => $data
                ];

                break;
            case 'votes_history':
                $data = [];

                $username = $request->input('username');

                $account = Accounts::where('username', $username)->first();

                if($account->votes->count() > 0) {
                    foreach($account->votes as $vote) {
                        $data[] = [
                            'id' => $vote->candidate_info->id,
                            'first_name' => $vote->candidate_info->student_info->first_name,
                            'middle_name' => $vote->candidate_info->student_info->middle_name,
                            'last_name' => $vote->candidate_info->student_info->last_name,
                            'gender' => $vote->candidate_info->student_info->gender,
                            'candidacy_image' => $vote->candidate_info->candidacy_image,
                            'college' => $vote->candidate_info->student_info->college,
                            'course' => $vote->candidate_info->student_info->course,
                            'position' => $vote->candidate_info->position_info->name,
                            'party' => $vote->candidate_info->party_info->name
                        ];
                    }
                }

                $resp = [
                    'status' => 'ok',
                    'message' => 'Request successful.',
                    'data' => $data
                ];

                break;
            case 'settings':
                $data = Settings::all();

                $resp = [
                    'status' => 'ok',
                    'message' => 'Request successful.',
                    'data' => $data
                ];

                break;
            default:
                $resp = [
                    'status' => 'failed',
                    'message' => 'Unknown request.'
                ];

                break;
        }

        return response()->json($resp);
    }
}
