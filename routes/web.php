<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MonitoringBahanBakuController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\expenseCategoriesController;
use App\Http\Controllers\expenseTableController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProductionsController;
use App\Http\Controllers\productTypesController;
use App\Http\Controllers\SaleItemsController;
use App\Http\Controllers\SalesTableController;
use App\Http\Controllers\stokMovementsController;
use App\Http\Controllers\ProductionHistoryController;

// Tampilkan form login
Route::get('/', function () {
    return view('login-view');
});
Route::get('/main', function () {
    return view('main');
});
Route::get('/sidebar', function () {
    return view('sidebar');
});

Route::get('/laporanstok', function () {
    return view('laporanStok');
});

Route::get('/inputProduksiBahanBaku', function () {
    return view('inputProduksiBahanBaku');
});

// Proses login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/bahanbaku', [MonitoringBahanBakuController::class, 'index'])->name('inputbahan');
    Route::get('/form-bahanbaku', [MonitoringBahanBakuController::class, 'formBahanBaku'])->name('bahan');
    Route::get('/filterByBahanBaku', [MonitoringBahanBakuController::class, 'filterBybahanBaku'])->name('filter.bahan');
    Route::post('/bahanbaku', [MonitoringBahanBakuController::class, 'addbahan'])->name('bahanBakus');
    Route::put('/api/bahan-baku/{id}', [MonitoringBahanBakuController::class, 'update'])->name('update.bahan');
    Route::delete('/api/bahan-baku/{id}', [MonitoringBahanBakuController::class, 'destroy'])->name('delete.bahan');
    Route::get('/laporan-bahanbaku/download', [MonitoringBahanBakuController::class, 'downlod_pdf'])->name('laporanbahan.download');
    Route::get('/api/bahan-baku/{id}', [MonitoringBahanBakuController::class, 'show']);


    Route::put('/api/stokMovements/{id}', [stokMovementsController::class, 'update'])->name('update.stokmovements');
    Route::get('/api/stokMovements/{id}', [stokMovementsController::class, 'show']);
    Route::delete('/api/stokMovements/{id}', [stokMovementsController::class, 'destroy']);
    Route::get('/filterBystok', [stokMovementsController::class, 'filterBystok'])->name('filter.stok');
    Route::get('/stok', [stokMovementsController::class, 'index'])->name('stok.index');

    Route::put('/api/riwayatproduksi/{id}', [ProductionHistoryController::class, 'update'])->name('update.stokmovements');
    Route::get('/api/riwayatproduksi/{id}', [ProductionHistoryController::class, 'show']);
    Route::delete('/api/riwayatproduksi/{id}', [ProductionHistoryController::class, 'destroy']);

    Route::get('/produksiRoti', [ProductionsController::class, 'index'])->name('productions');
    Route::get('/form-produksi', [ProductionsController::class, 'formproduksi'])->name('form.produksi');
    Route::Post('/produksiRoti', [ProductionsController::class, 'store'])->name('store.produksi');
    Route::Post('/tambahproduksi', [ProductionsController::class, 'pivotStore'])->name('store.tambah');
    Route::get('/form-produk', [ProductionsController::class, 'formproduk']);
    Route::patch('/produksiRoti/{id}', [ProductionsController::class, 'update'])->name('productions.update');
    Route::delete('/produksiRoti/{id}', [ProductionsController::class, 'destroy'])->name('productions.delete');

    Route::get('/riwayatProduksiRoti', [ProductionHistoryController::class, 'index']);
    Route::get('/filterByProduksi', [ProductionsController::class, 'filterByproduksi'])->name('filterByproduksi');





    Route::get('/dashboard', [DashboardController::class, 'index'])->name('production.stats');
    Route::get('/api/production-stats', [DashboardController::class, 'getProductionStats']);


    Route::get('/pengeluaran', [expenseTableController::class, 'index'])->name(('pengeluaran'));
    Route::get('/formpengeluaran', [expenseTableController::class, 'form'])->name('formPengeluaran');
    Route::get('/pengeluaranByfilter', [expenseTableController::class, 'filterBy'])->name('filterBy');
    Route::post('/pengeluaran', [expenseTableController::class, 'store'])->name('expenses.store');
    Route::put('/api/pengeluaran/{id}', [expenseTableController::class, 'update'])->name('expenses.update');

    Route::get('/api/peng/{id}', [expenseTableController::class, 'show']);
    Route::delete('/api/pengeluaran/{id}', [expenseTableController::class, 'destroy']);

    Route::get('/categories-pengeluaran', [expenseCategoriesController::class, 'index'])->name(('index'));
    Route::post('/categories-pengeluaran', [expenseCategoriesController::class, 'store'])->name(('categories.store'));
    Route::put('/categories-pengeluaran/{id}', [expenseCategoriesController::class, 'update'])->name(('categories.update'));
    Route::delete('/categories-pengeluaran/{id}', [expenseCategoriesController::class, 'destroy'])->name(('categories.delete'));


    Route::get('/penjualan', [SalesTableController::class, 'index']);
    Route::post('/penjualan', [SalesTableController::class, 'store'])->name('sale');
    Route::put('/penjualan/{id}', [SalesTableController::class, 'update'])->name('sale.update');
    Route::delete('/penjualan/{id}', [SalesTableController::class, 'destroy'])->name('sale.delete');
    Route::put('/penjualan/{id}/status', [SalesTableController::class, 'updateStatusPembayaran'])->name('karyawan.update');


    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/download', [LaporanController::class, 'downloadPDF'])->name('download');


    Route::get('/riwayatBahanBaku', [stokMovementsController::class, 'index']);



    Route::get('/customer', [CustomersController::class, 'index']);
    Route::get('/customer', [CustomersController::class, 'index'])->name('customers');
    Route::get('/form-customers', [CustomersController::class, 'form_customers'])->name('customers');
    Route::post('/customer', [CustomersController::class, 'addCustomer'])->name('customers');
    Route::put('/customer/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/customer/{id}', [CustomersController::class, 'destroy'])->name('customers.delete');
    Route::get('/customer/{id}/edit', [CustomersController::class, 'editcustomer'])->name('customers.edit');
    Route::get('/customers/filter', [CustomersController::class, 'filterByCustomer'])->name('customers.filter');





    // API Routes untuk Production History
    Route::get('/api/production-history/stats', [ProductionHistoryController::class, 'getStats'])->name('productionHistory.stats');
    Route::get('/api/production-history/export', [ProductionHistoryController::class, 'export'])->name('productionHistory.export');
    Route::get('/api/production-history/by-period', [ProductionHistoryController::class, 'getProductionByPeriod'])->name('productionHistory.byPeriod');
    Route::get('/api/production-history/top-products/{limit?}', [ProductionHistoryController::class, 'getTopProducts'])->name('productionHistory.topProducts');
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    //dashboard
    Route::get('/dashboard-karyawan', [DashboardController::class, 'dashboardkaryawan'])->name('karyawan');
    Route::get('/api/production-karyawan', [DashboardController::class, 'getProductionStatskaryawan']);

    //bahanbaku
    Route::get('/karyawan-bahanbaku', [MonitoringBahanBakuController::class, 'karyawanbahanBaku'])->name('karyawan.inputbahan');
    Route::get('/karyawan-riwayatbahanbaku', [stokMovementsController::class, 'karyawanstokMovements'])->name('karyawan.riwayatbahan');
    Route::get('/filterByBahanBakukaryawan', [MonitoringBahanBakuController::class, 'filterBybahanBakukaryawan'])->name('filter.karyawan.bahan');
    Route::get('/karyawan-bahanbaku/download', [MonitoringBahanBakuController::class, 'downlod_pdf'])->name('karyawan.download');
    Route::get('/karyawan-formbahanbaku', [MonitoringBahanBakuController::class, 'formkaryawanBahanBaku'])->name('karyawan.formbahanbaku');
    Route::post('/karyawan-bahanbaku', [MonitoringBahanBakuController::class, 'Karyawanaddbahan'])->name('karyawan.bahanBakus');
    Route::get('/api/karyawan-baku/{id}', [MonitoringBahanBakuController::class, 'show']);
    Route::delete('/api/karyawan-baku/{id}', [MonitoringBahanBakuController::class, 'destroy']);
    Route::get('/filterBystokkaryawan', [stokMovementsController::class, 'filterBykaryawanstok'])->name('filter.stokkaryawan');
    Route::delete('/api/karyawan-stokMovements/{id}', [stokMovementsController::class, 'destroy']);

    //produksi
    Route::get('/karyawan-produksiRoti', [ProductionsController::class, 'karyawanproduksi'])->name('karyawan.produksi');
    Route::get('/karyawan-formproduksi', [ProductionsController::class, 'karyawanformproduksi'])->name('karyawan.formproduksi');
    Route::get('/karyawan-formproduk', [ProductionsController::class, 'karyawanformproduk'])->name('karyawan.formproduk');
    Route::Post('/karyawan-tambahproduksi', [ProductionsController::class, 'pivotStorekaryawan'])->name('karyawan.storetambah');
    Route::Post('/karyawan-produksiRoti', [ProductionsController::class, 'karyawanstore'])->name('karyawan.storeproduksi');
    Route::patch('/karyawan-produksiRoti/{id}', [ProductionsController::class, 'Karyawanupdate'])->name('karyawan.productions.update');



    Route::get('/karyawanriwayatProduksiRoti', [ProductionHistoryController::class, 'karyawanproduksihistory']);
    Route::get('/filterBykaryawanProduksi', [ProductionsController::class, 'filterBykaryawanproduksi'])->name('filterBykaryawanroduksi');




    //laporan
    Route::get('/karyawan-laporan', [LaporanController::class, 'karyawanlaporan'])->name('karyawan.laporan');
    Route::get('/karyawan-laporan/download', [LaporanController::class, 'downloadPDF'])->name('laporan.download');

    //pengeluaran
    Route::get('/karyawan-pengeluaran', [expenseTableController::class, 'karyawanpengeluaran'])->name(('karyawan.pengeluaran'));
    Route::get('/karyawanformpengeluaran', [expenseTableController::class, 'karyawanform'])->name('karyawan.formPengeluaran');
    Route::get('/karyawan-pengeluaranByfilter', [expenseTableController::class, 'filterBykaryawanpengeluaran'])->name('filterBykaryawan');
    Route::post('/karyawan-pengeluaran', [expenseTableController::class, 'karyawanpengeluaranstore'])->name('karyawan.pengeluaran.store');

    Route::get('/api/karpe/{id}', [expenseTableController::class, 'show']);
    Route::delete('/api/karyawan-pengeluaran/{id}', [expenseTableController::class, 'destroy']);



    Route::get('/karyawan-categoriespengeluaran', [expenseCategoriesController::class, 'karyawancategories'])->name(('karyawan.categories'));
    Route::post('/karyawan-categoriespengeluaran', [expenseCategoriesController::class, 'karyawanstorecategories'])->name(('karyawan.storecategories'));
    Route::put('/karyawan-categoriespengeluaran/{id}', [expenseCategoriesController::class, 'update'])->name(('karyawancategories.update'));
    Route::delete('/karyawan-categoriespengeluaran/{id}', [expenseCategoriesController::class, 'destroy'])->name(('karyawancategories.delete'));

    Route::get('/karyawan-penjualan', [SalesTableController::class, 'karyawanpenjualan']);
    Route::get('/karyawan-penjualan', [SalesTableController::class, 'karyawanpenjualan'])->name('karyawanpenjualan');
    Route::post('/karyawan-penjualan', [SalesTableController::class, 'karyawanstore'])->name('karyawan.sale');
    Route::put('/karyawan-penjualan/{id}/status', [SalesTableController::class, 'updateStatusPembayaran'])->name('karyawan.update-status');


    Route::get('/karyawan-customer', [CustomersController::class, 'index']);
    Route::get('/karyawan-customer', [CustomersController::class, 'karyawanIndex'])->name('karyawan.customers');
    Route::get('/karyawan-formcustomers', [CustomersController::class, 'karyawanformcustomers'])->name('karyawan.formcustomers');
    Route::post('/karyawan-customer', [CustomersController::class, 'karyawanaddCustomer'])->name('karyawan.addcustomers');
    Route::get('/karyawan/customers/filter', [CustomersController::class, 'filterBykaryawanCustomer'])->name('customers.karyawanfilter');
    Route::delete('/karyawan/customer/{id}', [CustomersController::class, 'karyawandestroy'])->name('customers.karyawandelete');
});
