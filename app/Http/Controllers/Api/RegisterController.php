<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users'],
            'user_photo' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required'],
        ]);

        if($request->file('user_photo')){
            $fileName = $request->username . '-' . Str::random(15) . '.jpg';
            $validatedData['user_photo'] = $request->file('user_photo')->storeAs('user-photos', $fileName, 'public');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mendaftarkan ' . $request->name,
        ]);
    }
}
