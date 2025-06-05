<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Http\Request;

class ProductionsController extends Controller
{
    //
    public function index()
    {
        $productions = Production::all();
        return view('inputProduksiRoti', compact('productions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|integer|exists:product_types,id',
            'quantity_produced' => 'required|numeric',
            'batch_number' => 'required|string',
            'production_cost' => 'required|numeric',
            'notes' => 'required|string',
            'status' => 'required|string',
        ]);
        Production::create([
            'production_date' => $request->production_date,
            'product_type_id' => $request->product_type_id,
            'quantity_produced' => $request->quantity_produced,
            'batch_number' => $request->batch_number,
            'production_cost' => $request->production_cost,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);
        return redirect()->route('productions')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|integer|exists:product_types,id',
            'quantity_produced' => 'required|numeric',
            'batch_number' => 'required|string',
            'production_cost' => 'required|numeric',
            'notes' => 'required|string',
            'status' => 'required|string',
        ]);

        $production = Production::find($id);
        $production->update([
            'production_date' => $request->production_date,
            'product_type_id' => $request->product_type_id,
            'quantity_produced' => $request->quantity_produced,
            'batch_number' => $request->batch_number,
            'production_cost' => $request->production_cost,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);
        return redirect()->route('productions')->with('success', 'Data berhasil di Update');
    }

    public function destroy($id)
    {
        try {
            $production = Production::findOrFail($id);
            $production->delete();
            return redirect()->route('production')->with('success', 'Data Berhasil di hapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('')->with('error', 'Data tidak dapat dihapus');
        }
    }

    public function show($id)
    {
        $production = Production::findOrFail($id);
        return view('', compact('productions'));
    }
}
