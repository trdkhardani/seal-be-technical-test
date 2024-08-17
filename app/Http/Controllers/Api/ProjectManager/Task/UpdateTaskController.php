<?php

namespace App\Http\Controllers\Api\ProjectManager\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class UpdateTaskController extends Controller
{
    public function updateTask(Request $request, $taskId)
    {
        $task = Task::find($taskId);

        if (!$task) {
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found',
            ], 404);
        }

        $taskData = $request->validate([
            'task_title' => ['required'],
            'task_description' => ['required'],
            'task_due_date' => ['required'],
        ]);

        $task->update($taskData);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated task: ' . $request->task_title,
        ]);
    }
}
