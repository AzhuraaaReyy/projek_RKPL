<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class expenseTableController extends Controller
{
    //
    public function index()
    {
        $expenses = Expenses::orderBy('expense_category_id')->get();
        return view('pengeluaran', compact('expenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_category_id' => 'required|integer|exists:expense_categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
            'receipt_number' => 'required|',
            'notes' => 'required|',
        ]);
        Expenses::create([
            'expense_category_id' => $request->expense_category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'receipt_number' => $request->receipt_number,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);
        return redirect('')->route('expenses')->with('success', 'Data berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'expense_category_id' => 'required|integer|exists:expense_categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
            'receipt_number' => 'required|',
            'notes' => 'required|',
        ]);
        $expenses = Expenses::find($id);
        $expenses->update([
            'expense_category_id' => $request->expense_category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'receipt_number' => $request->receipt_number,
            'notes' => $request->notes,
        ]);
    }

    public function destroy($id)
    {
        try {
            $expenses = Expenses::findOrFail($id);
            $expenses->delete();
            return redirect()->route('expenses')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('')->with('error', 'Data gagal dihapus');
        }
    }

    public function show($id){
        $expenses = Expenses::findOrFail($id);
        return view('',compact('expenses'));
    }
}
