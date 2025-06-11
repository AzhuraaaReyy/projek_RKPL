<?php

namespace App\Http\Controllers;

use App\Models\StokMovements;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class stokMovementsController extends Controller
{
    public function index(Request $request)
    {
        // Base query dengan relasi
        $query = StokMovements::with(['bahanBaku', 'creator']);

        // Filter berdasarkan tanggal mulai
        if ($request->filled('start_date')) {
            $query->whereDate('movement_date', '>=', $request->start_date);
        }

        // Filter berdasarkan tanggal akhir
        if ($request->filled('end_date')) {
            $query->whereDate('movement_date', '<=', $request->end_date);
        }

        // Filter berdasarkan jenis pergerakan
        if ($request->filled('movement_type')) {
            $query->where('movement_type', $request->movement_type);
        }

        // Filter berdasarkan bahan baku
        if ($request->filled('bahan_baku_id')) {
            $query->where('bahan_baku_id', $request->bahan_baku_id);
        }

        // Urutkan berdasarkan tanggal terbaru
        $stokMovements = $query->orderBy('movement_date', 'desc')
                              ->orderBy('created_at', 'desc')
                              ->get();

        // Ambil semua bahan baku untuk dropdown filter
        $bahanBakuList = BahanBaku::select('id', 'nama')->orderBy('nama')->get();

        return view('riwayatProduksiBahanBaku', compact('stokMovements', 'bahanBakuList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahan_baku_id' => 'required|integer|exists:bahan_bakus,id',
            'movement_type' => 'required|string|in:in,out,adjustment',
            'quantity' => 'required|numeric|min:0',
            'remaining_stock' => 'required|numeric|min:0',
            'reference_type' => 'required|string|max:255',
            'reference_id' => 'nullable|integer',
            'notes' => 'required|string|max:1000',
            'movement_date' => 'required|date',
        ]);

        try {
            StokMovements::create([
                'bahan_baku_id' => $request->bahan_baku_id,
                'movement_type' => $request->movement_type,
                'quantity' => $request->quantity,
                'remaining_stock' => $request->remaining_stock,
                'reference_type' => $request->reference_type,
                'reference_id' => $request->reference_id,
                'notes' => $request->notes,
                'movement_date' => $request->movement_date,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return redirect()->route('stokMovements.index')->with('success', 'Data pergerakan stok berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $stokMovement = StokMovements::with(['bahanBaku', 'creator'])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $stokMovement->id,
                    'movement_date' => $stokMovement->movement_date->format('d M Y'),
                    'movement_time' => $stokMovement->created_at->format('H:i:s'),
                    'bahan_baku' => $stokMovement->bahanBaku->nama ?? 'N/A',
                    'movement_type' => $stokMovement->movement_type,
                    'quantity' => number_format($stokMovement->quantity, 2),
                    'remaining_stock' => number_format($stokMovement->remaining_stock, 2),
                    'reference_type' => $stokMovement->reference_type,
                    'notes' => $stokMovement->notes,
                    'creator' => $stokMovement->creator->name ?? 'System',
                    'satuan' => $stokMovement->bahanBaku->satuan ?? 'kg'
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
            $stokMovement = StokMovements::with(['bahanBaku'])->findOrFail($id);
            $bahanBakuList = BahanBaku::select('id', 'nama')->orderBy('nama')->get();
            
            return view('editStokMovement', compact('stokMovement', 'bahanBakuList'));
        } catch (\Exception $e) {
            return redirect()->route('stokMovements.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bahan_baku_id' => 'required|integer|exists:bahan_bakus,id',
            'movement_type' => 'required|string|in:in,out,adjustment',
            'quantity' => 'required|numeric|min:0',
            'remaining_stock' => 'required|numeric|min:0',
            'reference_type' => 'required|string|max:255',
            'reference_id' => 'nullable|integer',
            'notes' => 'required|string|max:1000',
            'movement_date' => 'required|date',
        ]);

        try {
            $stokMovement = StokMovements::findOrFail($id);
            
            $stokMovement->update([
                'bahan_baku_id' => $request->bahan_baku_id,
                'movement_type' => $request->movement_type,
                'quantity' => $request->quantity,
                'remaining_stock' => $request->remaining_stock,
                'reference_type' => $request->reference_type,
                'reference_id' => $request->reference_id,
                'notes' => $request->notes,
                'movement_date' => $request->movement_date,
            ]);

            return redirect()->route('stokMovements.index')->with('success', 'Data pergerakan stok berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $stokMovement = StokMovements::findOrFail($id);
            $bahanBakuNama = $stokMovement->bahanBaku->nama ?? 'Unknown';
            
            $stokMovement->delete();

            return redirect()->route('stokMovements.index')->with('success', "Data pergerakan stok '{$bahanBakuNama}' berhasil dihapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('stokMovements.index')->with('error', 'Data tidak dapat dihapus karena masih digunakan');
        } catch (\Exception $e) {
            return redirect()->route('stokMovements.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Method untuk export data (opsional)
    public function export(Request $request)
    {
        // Query sama seperti di index
        $query = StokMovements::with(['bahanBaku', 'creator']);

        if ($request->filled('start_date')) {
            $query->whereDate('movement_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('movement_date', '<=', $request->end_date);
        }

        if ($request->filled('movement_type')) {
            $query->where('movement_type', $request->movement_type);
        }

        if ($request->filled('bahan_baku_id')) {
            $query->where('bahan_baku_id', $request->bahan_baku_id);
        }

        $stokMovements = $query->orderBy('movement_date', 'desc')->get();

        // Return sebagai CSV atau Excel
        // Implementasi export sesuai kebutuhan
        return response()->json([
            'message' => 'Export functionality dapat diimplementasikan sesuai kebutuhan',
            'total_records' => $stokMovements->count()
        ]);
    }

    // Method untuk statistik dashboard (opsional)
    public function getStats()
    {
        try {
            $today = now()->toDateString();
            $thisMonth = now()->format('Y-m');

            $stats = [
                'total_movements' => StokMovements::count(),
                'movements_today' => StokMovements::whereDate('movement_date', $today)->count(),
                'movements_this_month' => StokMovements::whereMonth('movement_date', now()->month)
                                                     ->whereYear('movement_date', now()->year)
                                                     ->count(),
                'stock_in_today' => StokMovements::where('movement_type', 'in')
                                                 ->whereDate('movement_date', $today)
                                                 ->sum('quantity'),
                'stock_out_today' => StokMovements::where('movement_type', 'out')
                                                  ->whereDate('movement_date', $today)
                                                  ->sum('quantity'),
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
}