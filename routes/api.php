<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\Api\LoginController::class, 'register'])->name('register');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Api\LoginController::class, 'logout'])->name('logout');


    Route::get('user', function () {
        return \Illuminate\Support\Facades\Auth::user();
    })->name('user');

    Route::get('all-users', [\App\Http\Controllers\Api\UserController::class, 'allUsers'])->name('all.users');


});

Route::controller(\App\Http\Controllers\Api\ProductController::class)->group(function (){
    Route::get('/product', 'index')->name('index');
    Route::post('/product', 'store')->name('store');
    Route::put('/product/{id}', 'update')->name('update');
    Route::delete('/product/{id}', 'destroy')->name('destroy');
});
