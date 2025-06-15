<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;
use App\Models\Production;

use App\Models\ProductTypes;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use App\Models\ProductType;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $today = Carbon::today();

        $jumlahStokRendah = BahanBaku::whereColumn('stok', '<', 'minimum_stok')->count();
        $stokHabis = BahanBaku::where('stok', 0)->get();

        $produksi = \App\Models\Production::with('productType', 'creator')
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->first();

        $penjualan = Sale::with('productType', 'creator', 'saleItems', 'customer',)
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->first();
        $jumlahTransaksi = Sale::count();
        $bahan = BahanBaku::with('stokMovements')->latest()->first();

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $totalPenjualanBulanIni = Sale::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_amount');

        // Ambil total produksi hari ini
        $totalProduksiHariIni = Production::whereDate('created_at', now()->toDateString())
            ->sum('quantity_produced'); // sesuaikan nama kolom
        $totalbahanbaku = BahanBaku::whereNotNull('tanggal_masuk')->sum('stok');

        $totalPenjualan = Sale::whereDate('sale_date', now()->toDateString())->sum('total_amount');

        return view('dashboard', compact('totalProduksiHariIni', 'totalbahanbaku', 'totalPenjualan', 'today', 'produksi', 'bahan', 'jumlahStokRendah', 'stokHabis', 'penjualan', 'jumlahTransaksi', 'totalPenjualanBulanIni'));
    }

    public function dashboardkaryawan()
    {
        // Ambil total produksi hari ini
        $totalProduksi = Production::whereDate('created_at', now()->toDateString())
            ->sum('quantity_produced'); // sesuaikan nama kolom
        $totalbahan = BahanBaku::whereNotNull('tanggal_masuk')->sum('stok');

        $totalsale = Sale::whereDate('sale_date', now()->toDateString())->sum('total_amount');

        return view('karyawan.dashboard', compact('totalProduksi', 'totalbahan', 'totalsale'));
    }

    public function getProductionStats(): JsonResponse
    {
        $productions = Production::with('productType')
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get()
            ->reverse();

        $labels = $productions->map(function ($item) {
            $date = optional($item->created_at)->format('d M Y');
            $name = optional($item->productType)->name ?? 'Produk';
            return "{$date} - {$name}";
        })->values(); // pastikan jadi array numerik

        $actualData = $productions->pluck('quantity_produced')->values();

        $target = 200;
        // buat koleksi target dengan jumlah sama dengan jumlah data produksi
        $targetData = collect()->pad(count($productions), $target)->values();

        return response()->json([
            'labels' => $labels,
            'actual' => $actualData,
            'target' => $targetData,
        ]);
    }
}
