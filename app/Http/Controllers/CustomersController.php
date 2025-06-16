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
        // Load semua relasi yang diperlukan untuk menampilkan data lengkap
        $customers = Customers::with([
            'sale' => function ($query) {
                $query->with(['saleItems.productType'])->orderBy('sale_date', 'desc');
            }
        ])
            ->withCount('sale as total_transactions')
            ->withSum('sale as total_spent', 'total_amount')
            ->orderBy('name')
            ->get();

        // Tidak perlu loop lagi karena sudah menggunakan accessor di model
        // Accessor akan otomatis dipanggil saat mengakses $customer->favorite_products_list

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
        ]);

        return redirect()->route('sale')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified customer.
     */
    public function show($id)
    {
        $customer = Customers::with([
            'sale' => function ($query) {
                $query->with(['saleItems.productType'])->orderBy('sale_date', 'desc');
            }
        ])->findOrFail($id);

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
            'is_active' => $request->has('is_active') ? $request->is_active : 0,
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

        $customer->is_active = true;
        $customer->last_purchase_date = now();
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
            'total_revenue' => Customers::join('sales', 'customers.id', '=', 'sales.customer_id')->sum('total_amount'),
            'avg_customer_value' => Customers::join('sales', 'customers.id', '=', 'sales.customer_id')->avg('total_amount'),
        ];

        return response()->json($stats);
    }

    // KARYAWAN METHODS
    /**
     * Display customers for karyawan role
     */
    public function karyawanIndex()
    {
        $customers = Customers::with([
            'sale' => function ($query) {
                $query->with(['saleItems.productType'])->orderBy('sale_date', 'desc');
            }
        ])
            ->withCount('sale as total_transactions')
            ->withSum('sale as total_spent', 'total_amount')
            ->orderBy('name')
            ->get();

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

    public function editcustomer($id)
    {
        $customer = Customers::find($id);

        if (!$customer) {
            return redirect()->route('customers')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        return view('form.edit_customer', compact('customer'));
    }

    public function filterByCustomer(Request $request)
    {
        $query = Customers::query();

        // Cari berdasarkan keyword (nama, telepon, alamat, atau produk favorit)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%")
                    ->orWhere('address', 'like', "%$keyword%");
            });
        }

        // Filter berdasarkan status aktif/tidak
        if ($request->filled('filter')) {
            $query->where('is_active', $request->filter === 'active' ? true : false);
        }

        // Filter berdasarkan produk favorit
        if ($request->filled('filterProduct')) {
            $query->whereHas('sale.saleItems.productType', function ($q) use ($request) {
                $q->where('name', $request->filterProduct);
            });
        }

        // Filter berdasarkan total pembelian
        if ($request->filled('filterSpent')) {
            $query->withSum('sale as total_spent', 'total_amount');

            $query->havingRaw(match ($request->filterSpent) {
                'high' => 'total_spent > 1000000',
                'medium' => 'total_spent BETWEEN 500000 AND 1000000',
                'low' => 'total_spent < 500000',
                default => '1=1',
            });
        }

        $customers = $query
            ->with([
                'sale' => fn($q) => $q->with('saleItems.productType')->orderBy('sale_date', 'desc')
            ])
            ->withCount('sale as total_transactions')
            ->orderBy('name')
            ->get();

        return view('manajemen_customer', compact('customers'));
    }
}
