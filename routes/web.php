<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MonitoringBahanBakuController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\expenseCategoriesController;
use App\Http\Controllers\expenseTableController;
use App\Http\Controllers\ProductionsController;
use App\Http\Controllers\productTypesController;
use App\Http\Controllers\SaleItemsController;
use App\Http\Controllers\SalesTableController;
use App\Http\Controllers\stokMovementsController;

// Tampilkan form login
Route::get('/', function () {
    return view('login-view');
});
Route::get('/riwayatProduksiRoti', function () {
    return view('riwayatProduksiRoti');
});
Route::get('/laporanstok', function () {
    return view('laporanStok');
});
Route::get('/laporanproduksi', function () {
    return view('laporanProduksi');
});
Route::get('/inputProduksiBahanBaku', function () {
    return view('inputProduksiBahanBaku');
});

// Proses login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/bahanbaku', [MonitoringBahanBakuController::class, 'index'])->name('bahanBakus');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/customer', [CustomersController::class, 'index'])->name('customers');
    Route::get('/pengeluaran', [expenseCategoriesController::class, 'index']);
    Route::get('/penjualan', [SalesTableController::class, 'index']);
    Route::get('/produksiRoti', [ProductionsController::class, 'index'])->name('productions');
    Route::get('/riwayatBahanBaku', [stokMovementsController::class, 'index']);
});
