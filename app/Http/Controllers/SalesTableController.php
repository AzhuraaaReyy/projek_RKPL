<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesTableController extends Controller
{
    //
    public function index()
    {
        $sale = Sale::all();
        return view('penjualan', compact('sale'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'customer_name' => 'required|string',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'notes' => 'required|string',

        ]);

        $sale = Sale::create([
            'sale_date' => $request->sale_date,
            'customer_id' => $request->customer_id,
            'customer_name' => $request->customer_name,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);

        // Update status aktif customer
        $customer = $sale->customer;
        if ($customer) {
            $customer->is_active = true;
            $customer->last_purchase_date = now();
            $customer->save();
        }

        return redirect()->route('sales')->with('success', 'Penjualan berhasil dicatat.');
    }
}
