<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Leader\AssignTaskController;
use App\Http\Controllers\Api\Project\ProjectListController;
use App\Http\Controllers\Api\ProjectManager\AssignController;
use App\Http\Controllers\Api\ProjectManager\CreateProjectController;
use App\Http\Controllers\Api\ProjectManager\DeleteProjectController;
use App\Http\Controllers\Api\ProjectManager\Task\CreateTaskController;
use App\Http\Controllers\Api\ProjectManager\Task\DeleteTaskController;
use App\Http\Controllers\Api\ProjectManager\Task\UpdateTaskController;
use App\Http\Controllers\Api\ProjectManager\UpdateProjectController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\Task\TaskListController;
use App\Http\Controllers\Api\User\InfoController;
use App\Http\Controllers\Api\User\UpdateController;
use App\Http\Middleware\IsLeader;
use App\Http\Middleware\IsProjectManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisterController::class, 'register']);

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(IsProjectManager::class)->group(function () {
        Route::controller(AssignController::class)->group(function () {
            Route::patch('/assign-position/{user_id}', 'assignPosition');
            Route::patch('/assign-task/{task_id}', 'assignTask');
        });
        Route::post('/add-project', [CreateProjectController::class, 'createProject']);
        Route::put('/edit-project/{project_id}', [UpdateProjectController::class, 'updateProject']);
        Route::delete('/delete-project/{project_id}', [DeleteProjectController::class, 'deleteProject']);

        Route::put('/edit-task/{task_id}', [UpdateTaskController::class, 'updateTask']);
        Route::delete('/delete-task/{task_id}', [DeleteTaskController::class, 'deleteTask']);
    });

    Route::middleware(IsLeader::class)->group(function () {
        Route::post('/add-task', [CreateTaskController::class, 'createTask']);
        Route::patch('/assign-task-leader/{task_id}', [AssignTaskController::class, 'assignTask']);
    });

    Route::get('/user-info', [InfoController::class, 'index']);
    Route::put('/edit-user', [UpdateController::class, 'updateUser']);

    Route::controller(ProjectListController::class)->group(function () {
        Route::get('/projects', 'index');
        Route::get('/project/{project_id}', 'projectDetail');
    });

    Route::controller(TaskListController::class)->group(function () {
        Route::get('/tasks', 'index');
        Route::get('user-tasks', 'userTasks');
        Route::get('/task/{task_id}', 'taskDetail');
    });
});
