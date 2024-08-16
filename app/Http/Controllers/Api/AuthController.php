<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau Password salah'
            ], 401);
        }

        $user = User::where('username', $request->username)->first();
        $username = Auth::user()->username;
        $token = $user->createToken($username, []);

        return response()->json([
            'status' => 'success',
            'message' => 'Halo, ' . $user->name,
            'token' => $token->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out'
        ]);
    }
}
