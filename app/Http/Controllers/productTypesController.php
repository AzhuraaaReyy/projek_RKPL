<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class productTypesController extends Controller
{
    //
    public function index()
    {
        $productType = ProductType::orderBy('name')->get();
        return view('inputProduksiRoti', compact('productType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'estimated_production_time' => 'required|numeric',
        ]);
        ProductType::create([
            'name' => $request->name,
            'description' => $request->description,
            'estimated_production_time' => $request->estimated_production_time,
            'is_active' => false,
        ]);
        return redirect()->route('productType')->with('success', 'Berhasil menambahkan Data');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'estimated_production_time' => 'required|numeric',
        ]);

        $productType = ProductType::find($id);
        $productType->update([
            'name' => $request->name,
            'description' => $request->description,
            'estimated_production_time' => $request->estimated_production_time,
        ]);
        return redirect()->route('productType')->with('success', 'Data berhasil di Update');
    }

    public function destroy($id)
    {
        try {
            $productType = ProductType::findOrFail($id);
            $productType->delete();
            return redirect()->route('productType')->with('success', 'Data Berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('productType')->with('error', 'Data gagal dihapus');
        }
    }

    public function show($id)
    {
        $productType = ProductType::find($id);
        return view('', compact('productType'));
    }
}
