<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LabelController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {


    Route::name('task.')->controller(TaskController::class)->group(function () {
        Route::get('tasks', 'index')->name('index');
        Route::post('tasks', 'store')->name('store');
        Route::put('tasks/{id}', 'update')->name('update');
        Route::delete('tasks/{id}', 'destroy')->name('destroy');
    });

    Route::name('label.')->controller(LabelController::class)->group(function () {
        Route::get('labels', 'index')->name('index');
        Route::post('labels', 'store')->name('store');
        Route::put('labels/{id}', 'update')->name('update');
        Route::delete('labels/{id}', 'destroy')->name('destroy');
    });
});