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

Route::prefix('/dev')->middleware('auth','account_active')->group(function() {
    Route::get('/', 'DevController@linkIndex');
    Route::get('/show-logs', 'DevController@showLogs');
    Route::get('/show-email-logs', 'DevController@showEmailLogs');
    Route::get('/test-logs', 'DevController@testLogs');
    Route::get('/show-php-info', 'DevController@phpinfo');
    Route::get('/roles-and-perms', 'DevController@rolesAndPerms');
    Route::get('/my-perms', 'DevController@myPerms');
});
