<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Accounts;
use App\Candidates;
use App\Notifications;
use App\Positions;
use App\Students;
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
            case 'submit_votes':
                $candidates = $request->input('candidates');
                $ctr = 0;

                Votes::where('account_id', $request->input('account'))->delete();

                foreach($candidates as $candidate) {
                    $vote = new Votes();

                    $vote->account_id = (int) $request->input('account');
                    $vote->candidate_id = (int) $candidate;
                    
                    if($vote->save()) {
                        $ctr++;
                    }
                }

                if($ctr > 0) {
                    $account = Accounts::where('id', $request->input('account'))->first();

                    $account->has_voted = true;

                    if($account->save()) {
                        $resp = [
                            'status' => 'ok',
                            'message' => 'Votes successfully submitted.'
                        ];
                    } else {
                        $resp = [
                            'status' => 'failed',
                            'message' => 'Failed to submit votes. Please logout and restart the app and try again.'
                        ];
                    }
                } else {
                    $resp = [
                        'status' => 'failed',
                        'message' => 'Failed to submit votes. Please logout and restart the app and try again.'
                    ];
                }

                break;
            case 'positions':
                $data = [];

                $positions = Positions::all();

                if($positions->count() > 0) {
                    foreach($positions as $position) {
                        $data[] = [
                            'id' => $position->id,
                            'name' => $position->name,
                        ];
                    }
                }

                $resp = [
                    'status' => 'ok',
                    'message' => 'Request successful.',
                    'data' => $data
                ];

                break;
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
                            'full_name' => $candidate->student_info->full_name(),
                            'gender' => $candidate->student_info->gender,
                            'candidacy_image' => ($candidate->candidacy_image != null ? ('uploads/' . $candidate->candidacy_image) : null),
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

                $candidates = Candidates::get()->sortByDesc(function($c) {
                    return $c->votes->count();
                });
                $students = Students::all();

                if($candidates->count() > 0) {
                    foreach($candidates as $candidate) {
                        $data[] = [
                            'id' => $candidate->id,
                            'first_name' => $candidate->student_info->first_name,
                            'middle_name' => $candidate->student_info->middle_name,
                            'last_name' => $candidate->student_info->last_name,
                            'full_name' => $candidate->student_info->full_name(),
                            'gender' => $candidate->student_info->gender,
                            'candidacy_image' => ($candidate->candidacy_image != null ? ('uploads/' . $candidate->candidacy_image) : null),
                            'position' => $candidate->position_info->name,
                            'party' => $candidate->party_info->name,
                            'number_of_votes' => $candidate->votes->count(),
                            'number_of_votes_percentage' => ((int) (($candidate->votes->count() / $students->count()) * 100)) . '%'
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
                            'full_name' => $vote->candidate->student_info->full_name(),
                            'gender' => $vote->candidate_info->student_info->gender,
                            'candidacy_image' => ($vote->candidate->candidacy_image != null ? ('uploads/' . $vote->candidate->candidacy_image) : null),
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
            case 'notified':
                $username = $request->input('username');

                $account = Accounts::where('username', $username)->increment('notifications_received');

                $resp = [
                    'status' => 'ok',
                    'message' => 'Request successful.'
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

    public function pushNotification(Request $request)
    {
        if(!$this->verifyApiKey($request->input('app_key'))) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized access.'
            ]);
        }

        $resp = [
            'status' => 'failed',
            'message' => ''
        ];
        $username = $request->input('username', null);

        if($username != null) {
            $account = Accounts::where('username', $username)->first();

            if($account) {
                $notifications = Notifications::where('id', '>', ($account->notifications_received))->get();

                if($notifications) {
                    Accounts::where('username', $username)->increment('notifications_received', $notifications->count());

                    $resp = [
                        'status' => 'ok',
                        'message' => $notifications->count() . ' notification(s) retrieved.',
                        'data' => $notifications
                    ];
                }
            }
        } else {
            $notifications = Notifications::orderBy('id', 'desc')->first();

            if($notifications) {
                $resp = [
                    'status' => 'ok',
                    'message' => $notifications->count() . ' notification(s) retrieved.',
                    'data' => $notifications
                ];
            }
        }

        return response()->json($resp);
    }
}
