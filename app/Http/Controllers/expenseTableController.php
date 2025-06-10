<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategories;
use Illuminate\Http\Request;

class expenseTableController extends Controller
{
    //
    public function index()
    {
        $expenses = Expense::with('category')
            ->latest()
            ->paginate(10);

        $categories = ExpenseCategories::all(); // pastikan relasi eager loaded
        return view('pengeluaran', compact('expenses', 'categories'));
    }
    public function form()
    {
        $expenses = Expense::all();
        $expensesCategories = ExpenseCategories::all(); // pastikan relasi eager loaded
        return view('form.create_pengeluaran', compact('expenses', 'expensesCategories'));
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
        Expense::create([
            'expense_category_id' => $request->expense_category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'receipt_number' => $request->receipt_number,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('pengeluaran')->with('success', 'Data berhasil Ditambahkan');
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
        $expenses = Expense::find($id);
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
            $expenses = Expense::findOrFail($id);
            $expenses->delete();
            return redirect()->route('expenses')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('')->with('error', 'Data gagal dihapus');
        }
    }

    public function show($id)
    {
        $expenses = Expense::findOrFail($id);
        return view('', compact('expenses'));
    }

    public function filterBy(Request $request)
    {
        $expenses = Expense::query()
            ->when($request->expense_date, fn($q) => $q->whereDate('expense_date', $request->expense_date))
            ->when($request->expense_category_id, fn($q) => $q->where('expense_category_id', $request->expense_category_id))
            ->with('category') // eager load relasi
            ->latest()
            ->paginate(10);

        $categories = \App\Models\ExpenseCategories::where('is_active', true)->get();

        return view('pengeluaran', compact('expenses', 'categories'));
    }
}
