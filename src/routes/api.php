<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Api\LoginapiController;

Route::apiResource('blogs', BlogController::class);
Route::post('/login', [LoginapiController::class, 'login']);
Route::post('/refresh', [LoginapiController::class, 'refresh']);