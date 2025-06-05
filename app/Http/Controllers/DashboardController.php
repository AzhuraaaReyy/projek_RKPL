<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;
use App\Models\Production;

use App\Models\ProductTypes;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // Ambil total produksi hari ini
        $totalProduksiHariIni = Production::whereDate('created_at', now()->toDateString())
            ->sum('quantity_produced'); // sesuaikan nama kolom
        $totalbahanbaku = BahanBaku::whereNotNull('tanggal_masuk')->sum('stok');

        $totalPenjualan = Sale::whereDate('sale_date', now()->toDateString())->sum('total_amount');

        return view('dashboard', compact('totalProduksiHariIni', 'totalbahanbaku','totalPenjualan'));
    }
    public function getProductionStats(): JsonResponse
    {
        $productions = Production::with('productType')
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        $labels = $productions->map(function ($item) {
            $time = optional($item->created_at)->format('H:i');
            $name = optional($item->productType)->name ?? 'Produk';
            return "{$time} - {$name}";
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
