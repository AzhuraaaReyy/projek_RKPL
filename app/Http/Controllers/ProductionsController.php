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

        $countCompleted = Production::where('status', 'completed')->count();
        $countPlanning = Production::where('status', 'planning')->count();
        $countCancelled = Production::where('status', 'cancelled')->count();

       

        return view('inputProduksiRoti', compact('productions', 'countCompleted', 'countPlanning', 'countCancelled'));
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
            'status' => 'in_progress',
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('productions')->with('success', 'Data produksi dan relasi bahan baku berhasil disimpan.');
    }


    public function update(Request $request, $id)
    {
        $action = $request->input('action');

        $production = Production::findOrFail($id);

        // Kalau hanya ingin update status
        if (in_array($action, ['completed', 'cancelled'])) {
            $production->update(['status' => $action]);
            return redirect()->route('productions')->with('success', 'Status produksi berhasil diperbarui.');
        }

        // Kalau update data lengkap (misalnya dari form edit)
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|integer|exists:product_types,id',
            'quantity_produced' => 'required|numeric',
            'batch_number' => 'required|string',
            'production_cost' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $production->update([
            'production_date' => $request->production_date,
            'product_type_id' => $request->product_type_id,
            'quantity_produced' => $request->quantity_produced,
            'batch_number' => $request->batch_number,
            'production_cost' => $request->production_cost,
            'notes' => $request->notes,
        ]);

        return redirect()->route('productions')->with('success', 'Data produksi berhasil diperbarui.');
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



    //untuk karyawan
    public function karyawanproduksi()
    {
        $productions = Production::all();
        $productions = Production::with('productType.bahanBaku')->get();

        return view('karyawan.inputProduksiRoti', compact('productions'));
    }

    public function karyawanformproduk()
    {
        $productType = ProductType::orderBy('name')->get();
        $bahanBakus = BahanBaku::all();
        return view('karyawan.form.create_produk', compact('productType', 'bahanBakus'));
    }

    public function karyawanformproduksi()
    {
        $productions = Production::all();
        $producType = ProductType::all();
        $bahanBakus = BahanBaku::all();
        return view('karyawan.form.create_produksi', compact('productions', 'producType', 'bahanBakus'));
    }

    public function pivotStorekaryawan(Request $request)
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

        return redirect()->route('karyawan.produksi')->with('success', 'Produk berhasil ditambahkan');
    }

    public function karyawanstore(Request $request)
    {
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|integer|exists:product_types,id',
            'quantity_produced' => 'required|numeric',
            'batch_number' => 'required|string',
            'production_cost' => 'required|numeric',
            'notes' => 'nullable|string',

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
            'status' => 'in_progress',
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('karyawan.produksi')->with('success', 'Data produksi dan relasi bahan baku berhasil disimpan.');
    }

    public function filterByproduksi(Request $request)
    {
        $productionHistories = Production::with(['productType'])
            ->when($request->product_type_id, function ($q) use ($request) {
                $q->where('product_type_id', $request->product_type_id);
            })
            ->when($request->tanggal_dari, function ($q) use ($request) {
                $q->whereDate('production_date', '>=', $request->tanggal_dari);
            })
            ->when($request->tanggal_sampai, function ($q) use ($request) {
                $q->whereDate('production_date', '<=', $request->tanggal_sampai);
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status); // ✅ INI YANG KURANG
            })
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('productType', function ($q2) use ($request) {
                    $q2->where('name', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $productTypes = ProductType::all();

        return view('riwayatProduksiRoti', compact('productionHistories', 'productTypes'));
    }
}
