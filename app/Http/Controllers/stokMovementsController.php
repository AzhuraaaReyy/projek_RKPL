<?php

namespace App\Http\Controllers;

use App\Models\StokMovements;
use Illuminate\Http\Request;
use App\Models\BahanBaku;

class stokMovementsController extends Controller
{
    //
    public function index()
    {
        $stokMovements = StokMovements::with('bahanBaku')->paginate(10);
        $bahanBakus = BahanBaku::select('id', 'nama')->get();
        return view('riwayatProduksiBahanBaku', compact('stokMovements', 'bahanBakus'));
    }
    public function karyawanstokMovements()
    {
        $stokMovements = StokMovements::with('bahanBaku')->paginate(10);
        $bahanBakus = BahanBaku::select('id', 'nama')->get();
        return view('karyawan.riwayatProduksiBahanBaku', compact('stokMovements', 'bahanBakus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahan_baku_id' => 'required|integer|exists:bahan_bakus,id',
            'movement_type' => 'required|string',
            'quantity' => 'required|numeric',
            'remaining_stock' => 'required|numeric',
            'reference_type' => 'required|string',
            'notes' => 'required|string',
            'movement_date' => 'required|date',

        ]);
        StokMovements::create([
            'bahan_baku_id' => $request->bahan_baku_id,
            'movement_type' => $request->movement_type,
            'quantity' => $request->quantity,
            'remaining_stock' => $request->remaining_stock,
            'reference_type' => $request->reference_type,
            'notes' => $request->notes,
            'movement_date' => $request->movement_date,
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('stokMovements')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bahan_baku_id' => 'required|integer|exists:bahan_bakus,id',
            'movement_type' => 'required|string',
            'quantity' => 'required|numeric',
            'remaining_stock' => 'required|numeric',
            'reference_type' => 'required|string',
            'notes' => 'required|string',
            'movement_date' => 'required|date',

        ]);

        $stokMovements = StokMovements::find($id);
        $stokMovements->update([
            'bahan_baku_id' => $request->bahan_baku_id,
            'movement_type' => $request->movement_type,
            'quantity' => $request->quantity,
            'remaining_stock' => $request->remaining_stock,
            'reference_type' => $request->reference_type,
            'notes' => $request->notes,
            'movement_date' => $request->movement_date,

        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        try {
            $stokMovement = StokMovements::find($id);

            if (!$stokMovement) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            $stokMovement->delete();

            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            \Log::error("Gagal menghapus stok movement ID $id: " . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }



    public function show($id)
    {
        $data = StokMovements::with('bahanBaku')->find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    public function filterBystok(Request $request)
    {
        $stokMovements = StokMovements::with('bahanBaku')
            ->when($request->filled('movement_type'), function ($q) use ($request) {
                $q->where('movement_type', $request->movement_type);
            })
            ->when($request->filled('movement_date'), function ($q) use ($request) {
                $q->whereDate('movement_date', $request->movement_date); // hanya cocokkan tanggal persis
            })
            ->when($request->filled('bahan_baku_id'), function ($q) use ($request) {
                $q->where('bahan_baku_id', $request->bahan_baku_id);
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        $bahanBakus = BahanBaku::select('id', 'nama')->get();

        return view('riwayatProduksiBahanBaku', compact('stokMovements', 'bahanBakus'));
    }
    public function filterBykaryawanstok(Request $request)
    {
        $stokMovements = StokMovements::with('bahanBaku')
            ->when($request->filled('movement_type'), function ($q) use ($request) {
                $q->where('movement_type', $request->movement_type);
            })
            ->when($request->filled('movement_date'), function ($q) use ($request) {
                $q->whereDate('movement_date', $request->movement_date); // hanya cocokkan tanggal persis
            })
            ->when($request->filled('bahan_baku_id'), function ($q) use ($request) {
                $q->where('bahan_baku_id', $request->bahan_baku_id);
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        $bahanBakus = BahanBaku::select('id', 'nama')->get();

        return view('karyawan.riwayatProduksiBahanBaku', compact('stokMovements', 'bahanBakus'));
    }
}
