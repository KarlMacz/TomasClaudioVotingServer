<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Accounts;

class ApiController extends Controller
{
    public function auth(Request $request)
    {
        $account = Accounts::where('username', $request->input('username'))->first();

        if($account) {
            $data = [
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
            $data = [
                'status' => 'failed',
                'message' => 'Invalid username or student id number.'
            ];
        }

        return response()->json($data);
    }
}
