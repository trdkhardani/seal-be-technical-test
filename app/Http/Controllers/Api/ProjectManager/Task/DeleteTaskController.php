<?php

namespace App\Http\Controllers\Api\ProjectManager\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteTaskController extends Controller
{
    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        if(!$task){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task deleted successfully'
        ]);
    }
}
