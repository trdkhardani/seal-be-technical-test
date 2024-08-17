<?php

namespace App\Http\Controllers\Api\Leader;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignTaskController extends Controller
{
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

        $leaderPos = Auth()->user()->position->position_id;
        $memberPos = User::findOrFail($request->user_id)->position_id;

        if($leaderPos !== $memberPos){ // if logged in Leader user is not in the same position as to-be assigned Member user's position
            return response()->json([
                'status' => 'error',
                'message' => 'User is not in the same position as you',
            ], 403);
        }

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
