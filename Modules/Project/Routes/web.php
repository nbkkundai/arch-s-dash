<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('projects')->middleware('auth','account_active')->group(function() {   
    Route::get('/all', [Modules\Project\Http\Controllers\ProjectController::class, 'index']);
    Route::post('/', [Modules\Project\Http\Controllers\ProjectController::class, 'store']);
    Route::get('/processes', [Modules\Project\Http\Controllers\ProcessController::class, 'index']);
    Route::get('/processes/create', [Modules\Project\Http\Controllers\ProcessController::class, 'create']);
    Route::get('/client-projects', [Modules\Project\Http\Controllers\ProjectController::class, 'clientProjects']);
    Route::get('/create', [Modules\Project\Http\Controllers\ProjectController::class, 'create']);
    
    Route::get('/{project:id}', [Modules\Project\Http\Controllers\ProjectController::class, 'show']);
    Route::get('/processes/{process:id}', [Modules\Project\Http\Controllers\ProcessController::class, 'showProcess']);
    Route::delete('/{project:id}', [Modules\Project\Http\Controllers\ProjectController::class, 'destroy']);
    Route::delete('/processes/{processable:id}', [Modules\Project\Http\Controllers\ProjectController::class, 'destroyProcess']);
    Route::get('/{project:id}/processes/{processable:id}', [Modules\Project\Http\Controllers\ProcessController::class, 'show']);
    Route::get('/{project:id}/edit', [Modules\Project\Http\Controllers\ProjectController::class, 'edit']);
    Route::post('/{project:id}/processes/{processable:id}/questions/{process_question:id}/response', [Modules\Project\Http\Controllers\ProcessQuestionResponseController::class, 'store']);
});