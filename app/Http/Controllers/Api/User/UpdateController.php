<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function updateUser(Request $request)
    {
        $userId = Auth()->user()->user_id;
        $user = User::findOrFail($userId);

        $userData = $request->validate([
            'name' => ['required'],
            'username' => ['required'],
            'user_photo' => ['required', 'image', 'max:2048'],
            'email' => ['required'],
        ]);

        if ($request->file('user_photo')) {
            Storage::disk('public')->delete($user->user_photo); // delete old photo
            $fileName = $request->username . '-' . Str::random(15) . '.jpg';
            $userData['user_photo'] = $request->file('user_photo')->storeAs('user-photos', $fileName, 'public'); // add new photo
        }

        $user->update($userData);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated user: ' . $request->username,
        ]);
    }
}
