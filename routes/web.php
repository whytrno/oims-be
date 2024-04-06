<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum', RoleMiddleware::class . ':1,3']], function () {
    Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'master-data'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('detail/{user_id}', [UserController::class, 'detail'])->name('users.detail');
            Route::get('create', [UserController::class, 'create'])->name('users.create');
            Route::post('store', [UserController::class, 'store'])->name('users.store');
            Route::get('edit/{user_id}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('update/{user_id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('delete/{user_id}', [UserController::class, 'delete'])->name('users.delete');
            Route::get('export', [UserController::class, 'export'])->name('users.export');
        });
    });
    include 'child/web/auth.php';
});

include 'child/web/guest.php';
