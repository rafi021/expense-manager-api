<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(AuthenticationRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials, true)){
            $user = Auth::user();

            $response = [
                'status_code' => 200,
                'status' => 'success',
                'data' => [
                    'token' => $user->createToken('ibrahim')->plainTextToken,
                    'name' => $user->name
                ],
                'message' => 'Login Successfull!'
            ];

            return response()->json($response, 200);
        }else{
            $response = [
                'status_code' => 401,
                'status' => 'error',
                'data' => null,
                'message' => 'Unautorized!'
            ];
            return response()->json($response, 401);
        }
    }
}
