<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductionHistoryController extends Controller
{
    public function index(Request $request)
    {
        // Base query dengan relasi sesuai model existing
        $query = Production::with(['productType', 'productType.bahanBaku', 'creator']);

        // Filter berdasarkan tanggal mulai
        if ($request->filled('start_date')) {
            $query->whereDate('production_date', '>=', $request->start_date);
        }

        // Filter berdasarkan tanggal akhir
        if ($request->filled('end_date')) {
            $query->whereDate('production_date', '<=', $request->end_date);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tipe produk
        if ($request->filled('product_type_id')) {
            $query->where('product_type_id', $request->product_type_id);
        }

        // Urutkan berdasarkan tanggal produksi terbaru
        $productionHistories = $query->orderBy('production_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);



        // Ambil semua tipe produk untuk dropdown filter
        $productTypes = ProductType::select('id', 'name')->where('is_active', true)->orderBy('name')->get();
        $countCompleted = Production::where('status', 'completed')->count();
        $countPlanning = Production::where('status', 'planning')->count();
        $countCancelled = Production::where('status', 'cancelled')->count();

        return view('riwayatProduksiRoti', compact('productionHistories', 'productTypes', 'countCompleted', 'countPlanning', 'countCancelled'));
    }

    public function show($id)
    {
        try {
            $production = Production::with(['productType', 'productType.bahanBaku', 'creator'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $production->id,
                    'product_name' => $production->productType->name ?? 'N/A',
                    'batch_number' => $production->batch_number,
                    'quantity_produced' => $production->quantity_produced,
                    'production_date' => $production->production_date->format('d M Y'),
                    'production_cost' => 'Rp ' . number_format($production->production_cost, 0, ',', '.'),
                    'status' => $production->status,
                    'status_class' => $production->status_class,
                    'notes' => $production->notes ?? '-',
                    'creator' => $production->creator->name ?? 'System',
                    'created_at' => $production->created_at->format('d M Y H:i:s'),
                    'estimated_time' => $production->productType->waktu_produksi_format ?? '-',
                    'ingredients' => $production->productType->bahanBaku->map(function ($bahan) use ($production) {
                        return [
                            'name' => $bahan->nama,
                            'quantity' => $bahan->pivot->quantity_per_unit * $production->quantity_produced,
                            'unit' => $bahan->satuan ?? 'kg'
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function edit($id)
    {
        try {
            $production = Production::with(['productType'])->findOrFail($id);
            $productTypes = ProductType::select('id', 'name')->where('is_active', true)->orderBy('name')->get();

            return view('editProductionHistory', compact('production', 'productTypes'));
        } catch (\Exception $e) {
            return redirect()->route('productionHistory.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_type_id' => 'required|integer|exists:product_types,id',
            'quantity_produced' => 'required|integer|min:1',
            'batch_number' => 'required|string|max:50',
            'production_date' => 'required|date',
            'production_cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|string|in:planning,completed,cancelled'
        ]);

        try {
            $production = Production::findOrFail($id);

            $production->update([
                'product_type_id' => $request->product_type_id,
                'quantity_produced' => $request->quantity_produced,
                'batch_number' => $request->batch_number,
                'production_date' => $request->production_date,
                'production_cost' => $request->production_cost,
                'notes' => $request->notes,
                'status' => $request->status,
            ]);

            return redirect()->route('productionHistory.index')->with('success', 'Data riwayat produksi berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $production = Production::findOrFail($id);
            $productName = $production->productType->name ?? 'Unknown';

            $production->delete();

            return redirect()->route('productionHistory.index')->with('success', "Data riwayat produksi '{$productName}' berhasil dihapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('productionHistory.index')->with('error', 'Data tidak dapat dihapus karena masih digunakan');
        } catch (\Exception $e) {
            return redirect()->route('productionHistory.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Method untuk export data
    public function export(Request $request)
    {
        // Query sama seperti di index
        $query = Production::with(['productType', 'productType.bahanBaku', 'creator']);

        if ($request->filled('start_date')) {
            $query->whereDate('production_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('production_date', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('product_type_id')) {
            $query->where('product_type_id', $request->product_type_id);
        }

        $productionHistories = $query->orderBy('production_date', 'desc')->get();

        // Return sebagai CSV atau Excel
        return response()->json([
            'message' => 'Export functionality dapat diimplementasikan sesuai kebutuhan',
            'total_records' => $productionHistories->count(),
            'data' => $productionHistories->map(function ($production) {
                return [
                    'product_name' => $production->productType->name ?? 'N/A',
                    'batch_number' => $production->batch_number,
                    'quantity_produced' => $production->quantity_produced,
                    'production_date' => $production->production_date->format('Y-m-d'),
                    'production_cost' => $production->production_cost,
                    'status' => $production->status,
                    'notes' => $production->notes,
                    'creator' => $production->creator->name ?? 'System'
                ];
            })
        ]);
    }

    // Method untuk statistik dashboard
    public function getStats()
    {
        try {
            $today = now()->toDateString();
            $thisMonth = now()->format('Y-m');

            $stats = [
                'total_productions' => Production::count(),
                'productions_today' => Production::whereDate('production_date', $today)->count(),
                'productions_this_month' => Production::whereMonth('production_date', now()->month)
                    ->whereYear('production_date', now()->year)
                    ->count(),
                'completed_today' => Production::where('status', 'completed')
                    ->whereDate('production_date', $today)
                    ->count(),
                'planning_count' => Production::where('status', 'planning')->count(),
                'cancelled_count' => Production::where('status', 'cancelled')->count(),
                'total_quantity_today' => Production::whereDate('production_date', $today)
                    ->sum('quantity_produced'),
                'total_cost_today' => Production::whereDate('production_date', $today)
                    ->sum('production_cost'),
                'avg_cost_per_unit' => Production::whereDate('production_date', $today)
                    ->selectRaw('AVG(production_cost / quantity_produced) as avg_cost')
                    ->first()->avg_cost ?? 0,
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik'
            ], 500);
        }
    }

    // Method untuk mendapatkan data produksi berdasarkan periode
    public function getProductionByPeriod(Request $request)
    {
        $request->validate([
            'period' => 'required|string|in:daily,weekly,monthly',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        try {
            $period = $request->period;
            $startDate = $request->start_date ? Carbon::parse($request->start_date) : now()->subDays(30);
            $endDate = $request->end_date ? Carbon::parse($request->end_date) : now();

            $query = Production::whereBetween('production_date', [$startDate, $endDate]);

            switch ($period) {
                case 'daily':
                    $data = $query->selectRaw('DATE(production_date) as date, SUM(quantity_produced) as total_quantity, COUNT(*) as total_productions')
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();
                    break;

                case 'weekly':
                    $data = $query->selectRaw('YEARWEEK(production_date) as week, SUM(quantity_produced) as total_quantity, COUNT(*) as total_productions')
                        ->groupBy('week')
                        ->orderBy('week')
                        ->get();
                    break;

                case 'monthly':
                    $data = $query->selectRaw('YEAR(production_date) as year, MONTH(production_date) as month, SUM(quantity_produced) as total_quantity, COUNT(*) as total_productions')
                        ->groupBy('year', 'month')
                        ->orderBy('year')
                        ->orderBy('month')
                        ->get();
                    break;
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data produksi'
            ], 500);
        }
    }

    // Method untuk mendapatkan top products
    public function getTopProducts($limit = 10)
    {
        try {
            $topProducts = Production::with('productType')
                ->selectRaw('product_type_id, SUM(quantity_produced) as total_quantity, COUNT(*) as total_batches')
                ->groupBy('product_type_id')
                ->orderBy('total_quantity', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $topProducts->map(function ($item) {
                    return [
                        'product_name' => $item->productType->name ?? 'N/A',
                        'total_quantity' => $item->total_quantity,
                        'total_batches' => $item->total_batches
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data produk terpopuler'
            ], 500);
        }
    }

    // Method untuk update status batch
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:planning,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        try {
            $production = Production::findOrFail($id);

            $production->update([
                'status' => $request->status,
                'notes' => $request->notes ? $production->notes . "\n" . $request->notes : $production->notes
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status produksi berhasil diperbarui',
                'data' => [
                    'id' => $production->id,
                    'status' => $production->status,
                    'status_class' => $production->status_class
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }
}
