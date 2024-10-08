<?php

namespace App\Http\Controllers\Api\ProjectManager;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Task;
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

    public function assignTask(Request $request, $taskId)
    {
        $task = Task::find($taskId);

        if(!$task){ // if task is not found
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ], 404);
        }

        $assignToUser = $request->only('user_id', 'task_note');
        $assignToUser['task_status'] = 'assigned';

        $hasAlreadyAssigned = $task->user_id;

        if($hasAlreadyAssigned){ // if the task has already been assigned to another user
            return response()->json([
                'status' => 'error',
                'message' => 'Task ' . $task->task_title . ' has already been assigned to ' . $task->user->name
            ], 409);
        }

        $task->update($assignToUser);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully assigned task ' . $task->task_title . ' to ' . $task->user->name
        ]);
    }
}
