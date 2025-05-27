<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Tampilkan form login
Route::get('/', function () {
    return view('login-view');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Proses login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (hanya bisa diakses jika sudah login)
/*Route::get('/dashboard', function () {
    return view('dashboard'); // pastikan view dashboard.blade.php tersedia
})->middleware('auth')->name('dashboard');
*/