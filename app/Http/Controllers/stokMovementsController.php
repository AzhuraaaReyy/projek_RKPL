<?php

namespace App\Http\Controllers;

use App\Models\StokMovements;
use Illuminate\Http\Request;

class stokMovementsController extends Controller
{
    //
    public function index()
    {
        $stokMovements = StokMovements::all();
        return view('riwayatProduksiBahanBaku', compact('stokMovements'));
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
        return redirect()->route('stokMovements')->with('success', 'Data berhasil di update');
    }

    public function destroy($id)
    {
        try {
            $stokMovements = StokMovements::findOrFail($id);
            $stokMovements->delete();

            return redirect()->route('stokMovements')->with('success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('stokMovements')->with('error', 'Data gagal Dihapus');
        }
    }

    public function show($id)
    {
        $stokMovements = StokMovements::findOrFail($id);
        return view('', compact('stokMovements'));
    }
}
