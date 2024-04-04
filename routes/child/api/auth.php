<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [RoleController::class, 'index']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
