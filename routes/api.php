<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

include 'child/api/auth.php';

Route::group(['middleware' => ['auth:sanctum', RoleMiddleware::class . ':2']], function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('profile', [AuthController::class, 'updateProfile']);
});
