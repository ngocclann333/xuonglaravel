<?php

use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('projects')->group(function () {
    Route::post('/', [ProjectController::class, 'create']);
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/{id}', [ProjectController::class, 'show']);
    Route::put('/{id}', [ProjectController::class, 'update']);
    Route::delete('/{id}', [ProjectController::class, 'destroy']);

    Route::prefix('{projectId}/tasks')->group(function () {
        Route::post('/', [TaskController::class, 'create']);
        Route::get('/', [TaskController::class, 'index']);
        Route::get('/{taskId}', [TaskController::class, 'show']);
        Route::put('/{taskId}', [TaskController::class, 'update']);
        Route::delete('/{taskId}', [TaskController::class, 'destroy']);
    });
});