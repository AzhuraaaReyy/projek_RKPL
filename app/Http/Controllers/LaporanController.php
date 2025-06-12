<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Expense;
use App\Models\Production;
use App\Models\Sale;
use App\Models\StokMovements;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\ProductType;

class LaporanController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Bahan Baku
        $bahanBakus = BahanBaku::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%')
                ->orWhere('kategori', 'like', '%' . $keyword . '%')
                ->orWhere('deskripsi', 'like', '%' . $keyword . '%');
        })->latest()->paginate(10);

        // Produksi
        $productions = Production::with('productType')->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('productType', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
                ->orWhere('notes', 'like', '%' . $keyword . '%');
        })->latest()->paginate(10);

        // Penjualan
        $sales = Sale::with(['customer', 'creator', 'saleItems.productType'])->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('customer', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
                ->orWhereHas('saleItems.productType', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
        })->latest()->paginate(10);

        // Pengeluaran
        $queryExpense = Expense::with(['category', 'creator'])->when($keyword, function ($query) use ($keyword) {
            $query->where('description', 'like', '%' . $keyword . '%')
                ->orWhereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
        })->latest();
        $filteredExpenses = $queryExpense->get();
        $totalAmount = $filteredExpenses->sum('amount');
        $expenses = $queryExpense->paginate(10);

        // Pergerakan Stok
        $stokMovements = StokMovements::with(['bahanBaku', 'creator'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('bahanBaku', function ($q) use ($keyword) {
                    $q->where('nama', 'like', '%' . $keyword . '%');
                });
            })->latest()->paginate(10);


        // Riwayat Produksi
        $productionHistories = Production::with(['productType', 'productType.bahanBaku', 'creator'])->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('productType', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
                ->orWhere('notes', 'like', '%' . $keyword . '%');
        })->orderBy('production_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Dropdown Tipe Produk
        $productTypes = ProductType::select('id', 'name')->where('is_active', true)->orderBy('name')->get();

        return view('laporan', compact(
            'bahanBakus',
            'productions',
            'sales',
            'expenses',
            'totalAmount',
            'stokMovements',
            'productionHistories',
            'productTypes',
            'keyword'
        ));
    }
    public function karyawanlaporan(Request $request)
    {
        $keyword = $request->input('keyword');

        // Bahan Baku
        $bahanBakus = BahanBaku::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%')
                ->orWhere('kategori', 'like', '%' . $keyword . '%')
                ->orWhere('deskripsi', 'like', '%' . $keyword . '%');
        })->latest()->paginate(10);

        // Produksi
        $productions = Production::with('productType')->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('productType', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
                ->orWhere('notes', 'like', '%' . $keyword . '%');
        })->latest()->paginate(10);

        // Penjualan
        $sales = Sale::with(['customer', 'creator', 'saleItems.productType'])->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('customer', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
                ->orWhereHas('saleItems.productType', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
        })->latest()->paginate(10);

        // Pengeluaran
        $queryExpense = Expense::with(['category', 'creator'])->when($keyword, function ($query) use ($keyword) {
            $query->where('description', 'like', '%' . $keyword . '%')
                ->orWhereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
        })->latest();
        $filteredExpenses = $queryExpense->get();
        $totalAmount = $filteredExpenses->sum('amount');
        $expenses = $queryExpense->paginate(10);

        // Pergerakan Stok
        $stokMovements = StokMovements::with(['bahanBaku', 'creator'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('bahanBaku', function ($q) use ($keyword) {
                    $q->where('nama', 'like', '%' . $keyword . '%');
                });
            })->latest()->paginate(10);


        // Riwayat Produksi
        $productionHistories = Production::with(['productType', 'productType.bahanBaku', 'creator'])->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('productType', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            })
                ->orWhere('notes', 'like', '%' . $keyword . '%');
        })->orderBy('production_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Dropdown Tipe Produk
        $productTypes = ProductType::select('id', 'name')->where('is_active', true)->orderBy('name')->get();

        return view('karyawan.laporan', compact(
            'bahanBakus',
            'productions',
            'sales',
            'expenses',
            'totalAmount',
            'stokMovements',
            'productionHistories',
            'productTypes',
            'keyword'
        ));
    }



    public function downloadPDF()
    {
        $bahanBakus = BahanBaku::latest()->get();
        $productions = Production::latest()->get();
        $sales = Sale::with(['customer', 'creator', 'saleItems.productType'])->latest()->get();
        $stokMovements = StokMovements::with(['bahanBaku', 'creator'])->latest()->get();

        $query = Expense::with(['category', 'creator'])->latest();
        $filteredExpenses = $query->get();
        $totalAmount = $filteredExpenses->sum('amount');
        $expenses = $query->get(); // tanpa pagination

        $query = Production::with(['productType', 'productType.bahanBaku', 'creator']);
        $productionHistories = $query->orderBy('production_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil semua tipe produk untuk dropdown filter
        $productTypes = ProductType::select('id', 'name')->where('is_active', true)->orderBy('name')->get();
        $pdf = PDF::loadView('pdf.laporan_pdf', compact(
            'bahanBakus',
            'productions',
            'sales',
            'expenses',
            'totalAmount',
            'stokMovements',
            'productionHistories'
        ));

        return $pdf->download('laporan_DataKeseluruhan.pdf');
    }
}
