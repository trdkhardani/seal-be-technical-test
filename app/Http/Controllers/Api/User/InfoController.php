<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        $userId = Auth()->user()->user_id;
        $user = User::findOrFail($userId);

        return response()->json([
            'status' => 'success',
            'user_data' => [
                'user_id' => $user->user_id,
                'position' => $user->position->position_name,
                'role' => $user->user_role,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'photo' => url('/storage/' . $user->user_photo),
            ],
        ]);
    }
}
