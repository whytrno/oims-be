<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'loginProcess']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'register']);
