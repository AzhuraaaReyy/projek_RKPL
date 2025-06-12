<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategories;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class expenseTableController extends Controller
{
    //
    public function index(Request $request)
    {
        // Buat query builder terlebih dahulu
        $query = Expense::with(['category', 'creator'])->latest();

        // Filter jika ada input
        if ($request->filled('expense_date')) {
            $query->whereDate('expense_date', $request->expense_date);
        }

        if ($request->filled('expense_category_id')) {
            $query->where('expense_category_id', $request->expense_category_id);
        }

        // Salin query sebelum dipaginate untuk PDF
        $filteredExpenses = $query->get(); // gunakan ini untuk PDF
        $totalAmount = $filteredExpenses->sum('amount');

        // Jika diminta download PDF
        if ($request->has('download') && $request->download == 'pdf') {
            $pdf = Pdf::loadView('pdf.pengeluaran_pdf', [
                'expenses' => $filteredExpenses,
                'totalAmount' => $totalAmount,
            ]);
            return $pdf->download('laporan_pengeluaran.pdf');
        }

        // Paginate setelah data disalin untuk PDF
        $expenses = $query->paginate(10);
        $categories = ExpenseCategories::all();

        return view('pengeluaran', compact('expenses', 'categories', 'totalAmount'));
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

            'notes' => 'required|',
        ]);
        Expense::create([
            'expense_category_id' => $request->expense_category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,

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

            'notes' => 'required|',
        ]);
        $expenses = Expense::find($id);
        $expenses->update([
            'expense_category_id' => $request->expense_category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,

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
        $query = Expense::query()
            ->when($request->expense_date, fn($q) => $q->whereDate('expense_date', $request->expense_date))
            ->when($request->expense_category_id, fn($q) => $q->where('expense_category_id', $request->expense_category_id))
            ->with('category') // eager load relasi
            ->latest();


        $expenses = $query->paginate(10);
        $totalAmount = $query->sum('amount');
        $categories = \App\Models\ExpenseCategories::where('is_active', true)->get();

        return view('pengeluaran', compact('expenses', 'categories', 'totalAmount'));
    }



    //untuk karyawan
    public function karyawanpengeluaran(Request $request)
    {
        // Buat query builder terlebih dahulu
        $query = Expense::with(['category', 'creator'])->latest();

        // Filter jika ada input
        if ($request->filled('expense_date')) {
            $query->whereDate('expense_date', $request->expense_date);
        }

        if ($request->filled('expense_category_id')) {
            $query->where('expense_category_id', $request->expense_category_id);
        }

        // Salin query sebelum dipaginate untuk PDF
        $filteredExpenses = $query->get(); // gunakan ini untuk PDF
        $totalAmount = $filteredExpenses->sum('amount');

        // Jika diminta download PDF
        if ($request->has('download') && $request->download == 'pdf') {
            $pdf = Pdf::loadView('pdf.pengeluaran_pdf', [
                'expenses' => $filteredExpenses,
                'totalAmount' => $totalAmount,
            ]);
            return $pdf->download('laporan_pengeluaran.pdf');
        }

        // Paginate setelah data disalin untuk PDF
        $expenses = $query->paginate(10);
        $categories = ExpenseCategories::all();

        return view('karyawan.pengeluaran', compact('expenses', 'categories', 'totalAmount'));
    }
}
