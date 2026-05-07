<?php

use App\Http\Controllers\Api\KaryawanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Endpoint: /api/karyawan [cite: 11]
Route::apiResource('karyawan', KaryawanController::class);

Route::post('login', [AuthController::class, 'login']);

// Bungkus route karyawan dengan middleware auth:api agar aman
Route::middleware('auth:api')->group(function () {
    Route::apiResource('karyawan', KaryawanController::class);
});
