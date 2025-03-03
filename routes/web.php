<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;

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
    return redirect('/login');
});

Auth::routes(['register' => true]);

Route::get('/change-password', [ChangePasswordController::class,'changePassword'])->middleware('auth','account_active');
Route::post('/change-password', [ChangePasswordController::class,'updatePassword'])->middleware('auth','account_active');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth','account_active')->name('home');

Route::prefix('/dashboard')->middleware('auth','account_active')->group(function(){
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminDashboard']);
    Route::get('/client', [App\Http\Controllers\HomeController::class, 'clientDashboard']);

});

// user routes
Route::get('/users/deactivated', function() { abort(403,'Account deactivated');})->middleware(['auth']);

Route::prefix('users')->middleware(['auth','account_active'])->group(function(){
    Route::get("/", [UsersController::class, 'index'])->name('users');
    Route::put("/{user:slug}/update", [UsersController::class, 'update']);
    Route::put("/{user:slug}/resert-password", [UsersController::class, 'adminResetPassword']);
    Route::get("/{user:slug}/edit", [UsersController::class, 'edit']);
    Route::get("/create", [UsersController::class, 'create']);
    Route::post("/", [UsersController::class, 'store']);
    Route::put("/{user:slug}/toggle-activation", [UsersController::class, 'toggleActivation']);
    Route::get("/{user:slug}", [UsersController::class, 'show']);
});
