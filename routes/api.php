<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

include 'child/api/auth.php';

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('profile', [AuthController::class, 'updateProfile']);
});
