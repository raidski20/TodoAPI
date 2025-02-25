<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {


    Route::name('task.')->controller(TaskController::class)->group(function () {
        Route::get('tasks', 'index')->name('index');
        Route::post('tasks', 'store')->name('store');
        Route::put('tasks/{id}', 'update')->name('update');
        Route::delete('tasks/{id}', 'destroy')->name('destroy');
    });

    Route::name('tag.')->controller(TagController::class)->group(function () {
        Route::get('tags', 'index')->name('index');
        Route::post('tags', 'store')->name('store');
        Route::put('tags/{id}', 'update')->name('update');
        Route::delete('tags/{id}', 'destroy')->name('destroy');
    });
});