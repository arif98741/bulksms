<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loggout', function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/login');
});

