<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectManager\AssignController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\User\InfoController;
use App\Http\Controllers\Api\User\UpdateController;
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
        });
    });
    Route::get('/user-info', [InfoController::class, 'index']);
    Route::put('/edit-user', [UpdateController::class, 'updateUser']);
});
