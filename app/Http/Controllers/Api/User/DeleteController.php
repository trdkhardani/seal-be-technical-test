<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function deleteUser()
    {
        $userId = Auth()->user()->user_id;

        $user = User::find($userId);

        $unfinishedTask = Task::where('user_id', $userId)
        ->whereIn('task_status', ['assigned', 'in progress'])->get()->count(); // get user's unfinished tasks

        if ($unfinishedTask > 0) { // if user have unfinished task
            return response()->json([
                'status' => 'error',
                'message' => 'You have ' . $unfinishedTask . ' unfinished task(s)'
            ], 409);
        }

        Storage::disk('public')->delete($user->user_photo); // delete photo
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ]);
    }
}
