<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    //
    public function index()
    {
        $customers = Customers::orderBy('name')->get();

        return view('manajemen_customer', compact('customers'));
    }

    public function form_customers()
    {
        $customers = Customers::orderBy('name')->get();

        return view('form.create_customer', compact('customers'));
    }

    public function addCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',

        ]);
        Customers::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => false,
        ]);
        return redirect()->route('sale')->with('Success', 'Data Berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);
        $customer = Customers::find($id);
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect()->route('customers')->with('success', 'Data berhasil di update');
    }

    public function destroy($id)
    {
        try {
            $customers = Customers::findOrFail($id);
            $customers->delete();
            return redirect()->route('customers')->with('Success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('customers')->with('error', 'Data gagal dihapus');
        }
    }

    public function show($id)
    {
        $customers = Customers::find($id);
        return view('', compact('customers'));
    }
}
