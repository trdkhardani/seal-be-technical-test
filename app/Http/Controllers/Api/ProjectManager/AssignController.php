<?php

namespace App\Http\Controllers\Api\ProjectManager;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function assignPosition(Request $request, $userId)
    {
        $user = User::find($userId);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $assignPos = $request->only('position_id', 'user_role');
        $position = Position::findOrFail($request->position_id);

        $user->update($assignPos);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil melakukan assign posisi untuk ' . $user->name,
            'assigned_to' => [
                'position' => $position->position_name,
                'role' => $request->user_role
            ],
        ]);
    }
}
