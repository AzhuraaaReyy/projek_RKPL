<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;

class SaleItemsController extends Controller
{
    public function index()
    {
        $saleItems = SaleItem::all();
        return view('penjualan', compact('saleItems'));
    }
    public function store(Request $request)
    {
        // Validasi data dan buat sale + sale items (simplified)
        $request->validate([
            'sale_id' => 'required|integer|exists:sales,id',
            'product_type_id' => 'required',
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);
        $saleItem = SaleItem::create([
            'sale_id' => $request->sale_id,
            'product_type_id' => $request->product_type_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'subtotal' => $request->quantity * $request->unit_price,
        ]);

        // Kurangi stok bahan baku sesuai penjualan
        $saleItem->reduceRawMaterialStock();

        return response()->json(['message' => 'barang terjual dan stok bahan baku dikurangi'], 201);
    }
}
