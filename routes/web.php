<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanWebController;

Route::get('/karyawan', [KaryawanWebController::class, 'index'])->name('karyawan.index');
Route::get('/karyawan/pdf', [KaryawanWebController::class, 'exportPdf'])->name('karyawan.pdf');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
