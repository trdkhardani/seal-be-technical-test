<?php

namespace App\Http\Controllers\Api\ProjectManager\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class CreateTaskController extends Controller
{
    public function createTask(Request $request)
    {
        $taskData = $request->validate([
            'project_id' => ['required'],
            'task_title' => ['required'],
            'task_description' => ['required'],
            'task_due_date' => ['required'],
            'task_status' => [],
        ]);

        $taskData['task_status'] = 'created';

        Task::create($taskData);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully created task ' . $request->task_title,
        ]);
    }
}
