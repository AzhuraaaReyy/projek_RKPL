<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Production;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductionsController extends Controller
{
    //
    public function index()
    {
        $productions = Production::all();
        $productions = Production::with('productType.bahanBaku')->get();

        return view('inputProduksiRoti', compact('productions'));
    }
    public function formproduksi()
    {
        $productions = Production::all();
        $producType = ProductType::all();
        $bahanBakus = BahanBaku::all();
        return view('form.create_produksi', compact('productions', 'producType', 'bahanBakus'));
    }

    public function formproduk()
    {
        $productType = ProductType::orderBy('name')->get();
        $bahanBakus = BahanBaku::all();
        return view('form.create_produk', compact('productType', 'bahanBakus'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|integer|exists:product_types,id',
            'quantity_produced' => 'required|numeric',
            'batch_number' => 'required|string',
            'production_cost' => 'required|numeric',
            'notes' => 'nullable|string',
            'status' => 'required|string',
        ]);

        // Ambil tipe produk dan bahan baku terkait
        $productType = ProductType::with('bahanBaku')->findOrFail($request->product_type_id);
        $jumlahProduksi = $request->quantity_produced;

        // ✅ Validasi stok cukup
        foreach ($productType->bahanBaku as $bahanBaku) {
            $qtyPerUnit = $bahanBaku->pivot->quantity_per_unit;
            $stokDiperlukan = $qtyPerUnit * $jumlahProduksi;

            if ($bahanBaku->stok < $stokDiperlukan) {
                return redirect()->back()->withInput()->with('error', 'Stok bahan baku ' . $bahanBaku->nama . ' tidak mencukupi untuk produksi.');
            }
        }

        // Simpan data produksi
        $production = Production::create([
            'production_date' => $request->production_date,
            'product_type_id' => $request->product_type_id,
            'quantity_produced' => $request->quantity_produced,
            'batch_number' => $request->batch_number,
            'production_cost' => $request->production_cost,
            'notes' => $request->notes,
            'status' => $request->status,
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('productions')->with('success', 'Data produksi dan relasi bahan baku berhasil disimpan.');
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

    public function pivotStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'bahan_baku_id' => 'array',
            'quantity_per_unit' => 'array',
        ]);

        $productType = ProductType::create([
            'name' => $request->name,
            'description' => $request->description,
            'estimated_production_time' => $request->estimated_production_time
        ]);

        if ($request->filled('bahan_baku_id')) {
            foreach ($request->bahan_baku_id as $bahanBakuId) {
                $qty = $request->quantity_per_unit[$bahanBakuId] ?? 0;

                $productType->bahanBaku()->attach($bahanBakuId, [
                    'quantity_per_unit' => $qty,
                ]);
            }
        }

        return redirect()->route('productions')->with('success', 'Produk berhasil ditambahkan');
    }
}
