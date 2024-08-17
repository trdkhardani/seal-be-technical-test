<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->has('task_status')) {
            $query->where('task_status', $request->task_status);
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $tasks = $query->paginate(3);

        foreach ($tasks as $task) {
            $taskDueDate = date("j F Y H:i:s", strtotime($task->task_due_date));

            $taskData[] = [
                'task_title' => $task->task_title,
                'project' => $task->project->project_title,
                'assigned_user' => $task->user->name,
                'task_description' => $task->task_description,
                'task_due_date' => $taskDueDate,
                'status' => $task->task_status,
            ];
        }

        if ($tasks->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Found task(s)',
            'task_data' => $taskData,
            'pagination' => [
                'current_page' => $tasks->currentPage(),
                'next_page' => $tasks->nextPageUrl(),
                'prev_page' => $tasks->previousPageUrl(),
            ],
        ]);
    }

    public function userTasks()
    {
        $userId = Auth()->user()->user_id;
        $query = Task::query()->where('user_id', $userId);

        $tasks = $query->paginate(3);

        foreach ($tasks as $task) {
            $taskDueDate = date("j F Y H:i:s", strtotime($task->task_due_date));

            $taskData[] = [
                'task_title' => $task->task_title,
                'project' => $task->project->project_title,
                'task_description' => $task->task_description,
                'task_due_date' => $taskDueDate,
                'status' => $task->task_status,
                'task_note' => $task->task_note,
            ];
        }

        return response()->json([
            'status' => 'success',
            'task_data' => $taskData,
            'pagination' => [
                'current_page' => $tasks->currentPage(),
                'next_page' => $tasks->nextPageUrl(),
                'prev_page' => $tasks->previousPageUrl(),
            ],
        ]);
    }

    public function taskDetail($taskId)
    {
        $task = Task::find($taskId);

        if(!$task){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found',
            ], 404);
        }

        $taskDueDate = date("j F Y H:i:s", strtotime($task->task_due_date));
        return response()->json([
            'task_title' => $task->task_title,
            'project' => $task->project->project_title,
            'assigned_user' => $task->user->name,
            'task_description' => $task->task_description,
            'task_due_date' => $taskDueDate,
            'status' => $task->task_status,
        ]);
    }
}
