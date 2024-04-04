<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'master-data'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('create', [UserController::class, 'create'])->name('users.create');
            Route::post('store', [UserController::class, 'store'])->name('users.store');
            Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('{user}/update', [UserController::class, 'update'])->name('users.update');
            Route::delete('{user}/delete', [UserController::class, 'delete'])->name('users.delete');
        });
    });
    include 'child/web/auth.php';
});

include 'child/web/guest.php';
