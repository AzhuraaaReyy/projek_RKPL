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
    Route::put('/bahanbaku/{id}', [MonitoringBahanBakuController::class, 'update'])->name('update.bahan');
    Route::delete('/bahanbaku/{id}', [MonitoringBahanBakuController::class, 'destroy'])->name('delete.bahan');

    Route::resource('/produksiRoti', ProductionsController::class);
    Route::get('/produksiRoti', [ProductionsController::class, 'index'])->name('productions');
    Route::get('/form-produksi', [ProductionsController::class, 'formproduksi'])->name('form.produksi');
    Route::Post('/produksiRoti', [ProductionsController::class, 'store'])->name('store.produksi');
    Route::Post('/tambahproduksi', [ProductionsController::class, 'pivotStore'])->name('store.tambah');
    Route::get('/form-produk', [ProductionsController::class, 'formproduk']);
    Route::patch('/produksiRoti/{id}', [ProductionsController::class, 'update'])->name('productions.update');
    Route::delete('/produksiRoti/{id}', [ProductionsController::class, 'destroy'])->name('productions.delete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('production.stats');
    Route::get('/api/production-stats', [DashboardController::class, 'getProductionStats']);

    Route::get('/pengeluaran', [expenseTableController::class, 'index'])->name(('pengeluaran'));
    Route::get('/formpengeluaran', [expenseTableController::class, 'form'])->name('formPengeluaran');
    Route::get('/pengeluaranByfilter', [expenseTableController::class, 'filterBy'])->name('filterBy');
    Route::post('/pengeluaran', [expenseTableController::class, 'store'])->name('expenses.store');
    Route::put('/pengeluaran/{id}', [expenseTableController::class, 'update'])->name('expenses.update');
    Route::delete('/pengeluaran/{id}', [expenseTableController::class, 'destroy'])->name('expenses.delete');

    Route::get('/categories-pengeluaran', [expenseCategoriesController::class, 'index'])->name(('index'));
    Route::post('/categories-pengeluaran', [expenseCategoriesController::class, 'store'])->name(('categories.store'));
    Route::put('/categories-pengeluaran/{id}', [expenseCategoriesController::class, 'update'])->name(('categories.update'));
    Route::delete('/categories-pengeluaran/{id}', [expenseCategoriesController::class, 'destroy'])->name(('categories.delete'));


    Route::get('/penjualan', [SalesTableController::class, 'index']);
    Route::post('/penjualan', [SalesTableController::class, 'store'])->name('sale');
    Route::put('/penjualan/{id}', [SalesTableController::class, 'update'])->name('sale.update');
    Route::delete('/penjualan/{id}', [SalesTableController::class, 'destroy'])->name('sale.delete');


    Route::get('/riwayatBahanBaku', [stokMovementsController::class, 'index']);

    Route::get('/customer', [CustomersController::class, 'index']);
    Route::get('/customer', [CustomersController::class, 'index'])->name('customers');
    Route::get('/form-customers', [CustomersController::class, 'form_customers'])->name('customers');
    Route::post('/customer', [CustomersController::class, 'addCustomer'])->name('customers');
    Route::put('/customer/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/customer/{id}', [CustomersController::class, 'destroy'])->name('customers.delete');
});
