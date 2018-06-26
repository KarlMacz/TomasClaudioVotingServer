<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Accounts;

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
                    'image' => $account->image,
                    'first_name' => $account->user_info->first_name,
                    'middle_name' => $account->user_info->middle_name,
                    'last_name' => $account->user_info->last_name
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
}
