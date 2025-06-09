<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MonitoringBahanBakuController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
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

    Route::get('/bahanbaku', [MonitoringBahanBakuController::class, 'index'])->name('inputbahan');
    Route::get('/form-bahanbaku', [MonitoringBahanBakuController::class, 'formBahanBaku'])->name('bahan');
    Route::post('/bahanbaku', [MonitoringBahanBakuController::class, 'addbahan'])->name('bahanBakus');

    Route::get('/produksiRoti', [ProductionsController::class, 'index'])->name('productions');
    Route::get('/form-produksi', [ProductionsController::class, 'formproduksi'])->name('form.produksi');
    Route::Post('/produksiRoti', [ProductionsController::class, 'store'])->name('store.produksi');
    Route::Post('/tambahproduksi', [ProductionsController::class, 'pivotStore'])->name('store.tambah');
    Route::get('/form-produk', [ProductionsController::class, 'formproduk']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('production.stats');
    Route::get('/api/production-stats', [DashboardController::class, 'getProductionStats']);
    Route::get('/customer', [CustomersController::class, 'index'])->name('customers');
    Route::get('/pengeluaran', [expenseCategoriesController::class, 'index']);

    Route::get('/penjualan', [SalesTableController::class, 'index']);
    Route::post('/penjualan', [SalesTableController::class, 'store'])->name('sale');


    Route::get('/riwayatBahanBaku', [stokMovementsController::class, 'index']);

    Route::get('/customer', [CustomersController::class, 'index']);
    Route::get('/form-customers', [CustomersController::class, 'form_customers'])->name('customers');
    Route::post('/customer', [CustomersController::class, 'addCustomer'])->name('customers');
});
