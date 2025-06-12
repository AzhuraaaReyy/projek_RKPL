<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\ProductType;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\SaleItem;

class SalesTableController extends Controller
{
    //
    public function index()
    {
        $sale = Sale::all();
        $customers = Customers::all();
        $producType = ProductType::select('id', 'name', 'description') // atau tambahkan harga default jika ada
            ->with('saleItem') // atau ambil dari relasi terkait
            ->get();

        return view('penjualan', compact('sale', 'customers', 'producType'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'product_type_id' => 'required|array', // ← array untuk banyak item
            'product_type_id.*' => 'exists:product_types,id',
            'product_name' => 'required|array',
            'product_name.*' => 'string',
            'quantity' => 'required|array',
            'quantity.*' => 'numeric|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'numeric|min:0',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'notes' => 'required|string',
        ]);

        // 🔢 Hitung total_amount dari semua item
        $totalAmount = 0;
        foreach ($request->quantity as $i => $qty) {
            $subtotal = $qty * $request->unit_price[$i];
            $totalAmount += $subtotal;
        }

        // 🧾 Buat Sale
        $sale = Sale::create([
            'sale_date' => $request->sale_date,
            'customer_id' => $request->customer_id,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);

        // 🧾 Simpan semua item ke SaleItem
        foreach ($request->product_type_id as $i => $productTypeId) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_type_id' => $productTypeId,
                'product_name' => $request->product_name[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'subtotal' => $request->quantity[$i] * $request->unit_price[$i],
            ]);
        }

        // ✔️ Update status aktif customer
        $customer = $sale->customer;
        if ($customer) {
            $customer->is_active = true;
            $customer->last_purchase_date = now();
            $customer->save();
        }

        return redirect()->route('sale')->with('success', 'Penjualan berhasil dicatat.');
    }


    public function filterBy(Request $request)
    {
        $sale = Sale::query()
            ->when($request->sale_date, fn($q) => $q->whereDate('sale_date', $request->sale_date))
            ->when($request->customer_name, function ($q) use ($request) {
                $q->whereHas('customers', function ($q2) use ($request) {
                    $q2->where('name', 'like', '%' . $request->customer_name . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('penjualan', compact('sale'));
    }

    public function updateStatusPembayaran($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->payment_status = 'paid';
        $sale->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui menjadi lunas.');
    }

    //karyawan
    public function karyawanpenjualan()
    {
        $sales = Sale::with(['customer', 'creator', 'saleItems.productType'])->latest()->paginate(10);
        $customers = Customers::all();

        $producType = ProductType::select('id', 'name', 'description') // atau tambahkan harga default jika ada
            ->with('saleItem') // atau ambil dari relasi terkait
            ->get();


        return view('karyawan.penjualan', compact('sales', 'customers', 'producType'));
    }


    public function karyawanstore(Request $request)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'product_type_id' => 'required|array', // ← array untuk banyak item
            'product_type_id.*' => 'exists:product_types,id',
            'product_name' => 'required|array',
            'product_name.*' => 'string',
            'quantity' => 'required|array',
            'quantity.*' => 'numeric|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'numeric|min:0',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'notes' => 'required|string',
        ]);

        // 🔢 Hitung total_amount dari semua item
        $totalAmount = 0;
        foreach ($request->quantity as $i => $qty) {
            $subtotal = $qty * $request->unit_price[$i];
            $totalAmount += $subtotal;
        }

        // 🧾 Buat Sale
        $sale = Sale::create([
            'sale_date' => $request->sale_date,
            'customer_id' => $request->customer_id,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);

        // 🧾 Simpan semua item ke SaleItem
        foreach ($request->product_type_id as $i => $productTypeId) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_type_id' => $productTypeId,
                'product_name' => $request->product_name[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'subtotal' => $request->quantity[$i] * $request->unit_price[$i],
            ]);
        }

        // ✔️ Update status aktif customer
        $customer = $sale->customer;
        if ($customer) {
            $customer->is_active = true;
            $customer->last_purchase_date = now();
            $customer->save();
        }

        return redirect()->route('karyawan.sale')->with('success', 'Penjualan berhasil dicatat.');
    }
}
