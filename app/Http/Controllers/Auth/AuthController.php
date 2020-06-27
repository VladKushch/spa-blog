<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        try {
            return response(['user' => User::create($credentials)], 201);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response(['message' => 'Data is incorrect!'], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!auth()->attempt($credentials)) {
            return response(['message' => 'Data is incorrect!'], 400);
        }

        $user = User::where('email', $credentials['email'])->first();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response(['message' => 'You successfully logged out.'], 200);
    }

    public function loggedIn (Request $request)
    {
        if (auth()->check()) {
            return response(['message' => 'User is logged in.'], 200);
        }
    }
}
