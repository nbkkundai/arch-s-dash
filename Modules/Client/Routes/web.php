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

Route::prefix('client')->middleware('auth','account_active')->group(function() {
    Route::get('/', 'ClientController@index');

    Route::resource('clients', Modules\Client\Http\Controllers\ClientController::class);
    Route::resource('client-notes', Modules\Client\Http\Controllers\ClientNoteController::class);

    Route::get('groups/{group:slug}/download', [Modules\Client\Http\Controllers\GroupController::class, 'downloadMembersList']);
    Route::get('groups/{group:slug}/loan/create', [Modules\Loan\Http\Controllers\LoanController::class, 'create']);
    
    Route::resource('groups', Modules\Client\Http\Controllers\GroupController::class);
});
