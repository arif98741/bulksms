<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Backend Routes For Managing all core functionalities
 */
Route::group([
    'as' => 'backend.',
    'namespace' => 'Backend',
    'middleware' => 'auth', //backend middleware . user must have to be logged in before using system

], static function () {

    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('/user', 'UserController')->except(['show']);
    Route::get('/user/view-provider/{id}', 'UserController@viewProvider')->name('user.view-provider');
    Route::post('/user/change-approve-status/{id}', 'UserController@changeApproveStatus')->name('user.change-approve-status');

    Route::group(['namespace' => 'Log'], static function () {
        Route::resource('user-access-log', 'AccessLogController')->only(['index', 'destroy']);
        Route::resource('user-activity-log', 'ActivityLogController')->only(['index']);
    });
});

Route::get('logoutlink', static function () {
    Auth::logout();
    return redirect('login');
});

