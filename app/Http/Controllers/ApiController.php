<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function auth(Request $request)
    {
        if() {
            $resp = [
                'status' => 'ok',
                'message' => 'Login successful.',
                'data' => []
            ];
        } else {
            $resp = [
                'status' => 'failed',
                'message' => 'Invalid username and/or password.'
            ];
        }
        return response()->json($resp);
    }
}
