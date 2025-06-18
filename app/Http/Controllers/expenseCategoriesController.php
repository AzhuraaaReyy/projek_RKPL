<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategories;
use Illuminate\Http\Request;

class expenseCategoriesController extends Controller
{
    //
    public function index()
    {
        $expensesCategories = ExpenseCategories::orderBy('name')->get();
        return view('form.create_categoriesPengeluaran', compact('expensesCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        ExpenseCategories::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,

        ]);
        return redirect()->route('pengeluaran')->with('Success', 'Data berhasil Ditambahkan');
    }
    public function karyawanstorecategories(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        ExpenseCategories::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,

        ]);
        return redirect()->route('karyawan.pengeluaran')->with('Success', 'Data berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        $expensesCategories = ExpenseCategories::find($id);
        $expensesCategories->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('expensesCategories')->with('Success', 'Data berhsail di update');
    }

    public function destroy($id)
    {
        try {
            $expensesCategories = ExpenseCategories::findOrFail($id);
            $expensesCategories->delete();
            return redirect()->route('expensesCategories')->with('success', 'Data Berhasil di hapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('expensesCategories')->with('error', 'Data gagal dihapus');
        }
    }

    public function show($id)
    {
        $expensesCategories = ExpenseCategories::findOrFail($id);
        return view('', compact('expensesCategories'));
    }

    //karyawan

     public function karyawancategories()
    {
        $expensesCategories = ExpenseCategories::orderBy('name')->get();
        return view('karyawan.form.create_categoriesPengeluaran', compact('expensesCategories'));
    }
}
