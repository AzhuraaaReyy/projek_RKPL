<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        $customers = Customers::orderBy('name')->get();
        return view('manajemen_customer', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function form_customers()
    {
        return view('form.create_customer');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function addCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        Customers::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => false,
            // Initialize additional fields
            'total_items' => 0,
            'total_spent' => 0,
            'total_transactions' => 0,
            'favorite_products' => null,
            'purchase_history' => null,
            'last_purchase' => null,
            'avg_visit_frequency' => null,
        ]);

        return redirect()->route('sale')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified customer.
     */
    public function show($id)
    {
        $customer = Customers::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit($id)
    {
        $customer = Customers::findOrFail($id);
        return view('form.edit_customer', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'is_active' => 'sometimes|boolean',
        ]);

        $customer = Customers::findOrFail($id);

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->has('is_active') ? $request->is_active : $customer->is_active,
        ]);

        return redirect()->route('customers')->with('success', 'Data pelanggan berhasil diperbarui');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($id)
    {
        try {
            $customer = Customers::findOrFail($id);
            $customerName = $customer->name;
            $customer->delete();

            return redirect()->route('customers')->with('success', "Data pelanggan {$customerName} berhasil dihapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('customers')->with('error', 'Data gagal dihapus karena masih terdapat data terkait');
        } catch (\Exception $e) {
            return redirect()->route('customers')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    /**
     * Update customer purchase data
     */
    public function updatePurchaseData($customerId, $productData)
    {
        $customer = Customers::find($customerId);
        if (!$customer) return false;

        // Update total items and spent
        $customer->total_items += $productData['quantity'];
        $customer->total_spent += $productData['total_price'];
        $customer->total_transactions += 1;
        $customer->last_purchase = now();
        $customer->is_active = true;

        // Update favorite products
        $currentFavorites = $customer->favorite_products ?
            (is_array($customer->favorite_products) ? $customer->favorite_products : json_decode($customer->favorite_products, true)) : [];

        if (!in_array($productData['product_name'], $currentFavorites)) {
            $currentFavorites[] = $productData['product_name'];
            // Keep only top 5 favorites
            $customer->favorite_products = array_slice($currentFavorites, -5);
        }

        // Update purchase history
        $currentHistory = $customer->purchase_history ?
            (is_array($customer->purchase_history) ? $customer->purchase_history : json_decode($customer->purchase_history, true)) : [];

        $currentHistory[] = [
            'product_name' => $productData['product_name'],
            'category' => $productData['category'] ?? 'Roti',
            'quantity' => $productData['quantity'],
            'price' => $productData['unit_price'],
            'last_bought' => now()->toDateString(),
            'total' => $productData['total_price']
        ];

        // Keep only last 20 purchases
        $customer->purchase_history = array_slice($currentHistory, -20);

        $customer->save();
        return true;
    }

    /**
     * Get customer statistics
     */
    public function getCustomerStats()
    {
        $stats = [
            'total_customers' => Customers::count(),
            'active_customers' => Customers::where('is_active', true)->count(),
            'inactive_customers' => Customers::where('is_active', false)->count(),
            'new_customers' => Customers::where('created_at', '>=', now()->subDays(30))->count(),
            'total_revenue' => Customers::sum('total_spent'),
            'avg_customer_value' => Customers::avg('total_spent'),
        ];

        return response()->json($stats);
    }

    // KARYAWAN METHODS
    /**
     * Display customers for karyawan role
     */
    public function karyawanIndex()
    {
        $customers = Customers::orderBy('name')->get();
        return view('karyawan.manajemen_customer', compact('customers'));
    }

    /**
     * Show form for creating customer (karyawan)
     */
    public function karyawanformcustomers()
    {
        return view('karyawan.form.create_customer');
    }

    /**
     * Store customer data (karyawan)
     */
    public function karyawanaddCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        Customers::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => false,
            'total_items' => 0,
            'total_spent' => 0,
            'total_transactions' => 0,
            'favorite_products' => null,
            'purchase_history' => null,
            'last_purchase' => null,
            'avg_visit_frequency' => null,
        ]);

        return redirect()->route('karyawan.customers')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    /**
     * Show edit form for customer (karyawan)
     */
    public function karyawanEdit($id)
    {
        $customer = Customers::findOrFail($id);
        return view('karyawan.form.edit_customer', compact('customer'));
    }

    /**
     * Update customer (karyawan)
     */
    public function karyawanUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $customer = Customers::findOrFail($id);

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('karyawan.customers')->with('success', 'Data pelanggan berhasil diperbarui');
    }
}
