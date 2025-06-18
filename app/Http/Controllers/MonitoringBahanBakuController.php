<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use Barryvdh\DomPDF\Facade\Pdf;

class MonitoringBahanBakuController extends Controller
{
    public function index()
    {

        $allBahanBaku = BahanBaku::all();
        $bahanBakus = BahanBaku::paginate(10); //ambil semua bahan baku
        $countinput = BahanBaku::whereDate('created_at', now()->toDateString())->count();
        $baranginput = BahanBaku::count();
        $hargainput = BahanBaku::sum('harga');
        $jumlahAktif = $allBahanBaku->filter(function ($item) {
            return $item->status === 'Aktif';
        })->count();
        return view('inputProduksiBahanBaku', compact('bahanBakus', 'countinput', 'baranginput', 'hargainput', 'jumlahAktif')); //arahkan ke view
    }
    public function karyawanbahanBaku()
    {

        $allBahanBaku = BahanBaku::all();
        $bahanBakus = BahanBaku::paginate(10); //ambil semua bahan baku
        $countinput = BahanBaku::whereDate('created_at', now()->toDateString())->count();
        $baranginput = BahanBaku::count();
        $hargainput = BahanBaku::sum('harga');
        $jumlahAktif = $allBahanBaku->filter(function ($item) {
            return $item->status === 'Aktif';
        })->count();
        return view('karyawan.inputProduksiBahanBaku', compact('bahanBakus', 'countinput', 'baranginput', 'hargainput', 'jumlahAktif')); //arahkan ke view
    }

    public function formBahanBaku()
    {
        // Ambil semua data bahan baku
        $bahan = BahanBaku::orderBy('nama')->get();

        // Kirim ke view monitoring/stok.blade.php
        return view('form.create_bahanBaku', compact('bahan'));
    }
    public function formkaryawanBahanBaku()
    {
        // Ambil semua data bahan baku
        $bahan = BahanBaku::orderBy('nama')->get();

        // Kirim ke view monitoring/stok.blade.php
        return view('karyawan.form.create_bahanBaku', compact('bahan'));
    }

    public function addbahan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'stok' => 'required|numeric',
            'satuan' => 'required|string',
            'minimum_stok' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_kedaluwarsa' => 'required|date',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
        BahanBaku::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'minimum_stok' => $request->minimum_stok,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('inputbahan')->with('success', 'Data berhasil di tambahkan');
    }
    public function Karyawanaddbahan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'stok' => 'required|numeric',
            'satuan' => 'required|string',
            'minimum_stok' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_kedaluwarsa' => 'required|date',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
        BahanBaku::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'minimum_stok' => $request->minimum_stok,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('karyawan.inputbahan')->with('success', 'Data berhasil di tambahkan');
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'stok' => 'required|numeric',
            'satuan' => 'required|string',
            'minimum_stok' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_kedaluwarsa' => 'required|date',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $bahanBakus = BahanBaku::find($id);
        $bahanBakus->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'minimum_stok' => $request->minimum_stok,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('bahanBakus')->with('success', 'Data berhasil di update');
    }
    public function destroy($id)
    {
        try {
            $bahanBakus = BahanBaku::find($id);

            if (!$bahanBakus) {
                return response()->json(['message' => 'Data Tidak Ditemukan'], 404);
            }

            // Hapus relasi stok movements jika ada
            $bahanBakus->stokMovements()->delete();

            $bahanBakus->delete();

            return response()->json(['message' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            \Log::error("Gagal hapus data: " . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data'], 500);
        }
    }


    public function show($id)
    {
        $data = BahanBaku::with('stokMovements.creator')->findOrFail($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }


    public function filterBybahanBaku(Request $request)
    {
        $bahanBakus = BahanBaku::query()
            ->when($request->kategori, fn($q) => $q->where('kategori', $request->kategori))
            ->when($request->tanggal_dari, fn($q) =>
            $q->whereDate('created_at', '>=', $request->tanggal_dari))
            ->when($request->tanggal_sampai, fn($q) =>
            $q->whereDate('created_at', '<=', $request->tanggal_sampai))
            ->when($request->search, fn($q) =>
            $q->where('nama', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(10);

        $allBahanBaku = BahanBaku::all();
        $countinput = BahanBaku::whereDate('created_at', now()->toDateString())->count();
        $baranginput = BahanBaku::count();
        $hargainput = BahanBaku::sum('harga');
        $jumlahAktif = $allBahanBaku->filter(function ($item) {
            return $item->status === 'Aktif';
        })->count();
        return view('inputProduksiBahanBaku', compact('bahanBakus', 'countinput', 'baranginput', 'hargainput', 'jumlahAktif'));
    }
    public function filterBybahanBakukaryawan(Request $request)
    {
        $bahanBakus = BahanBaku::query()
            ->when($request->kategori, fn($q) => $q->where('kategori', $request->kategori))
            ->when($request->tanggal_dari, fn($q) =>
            $q->whereDate('created_at', '>=', $request->tanggal_dari))
            ->when($request->tanggal_sampai, fn($q) =>
            $q->whereDate('created_at', '<=', $request->tanggal_sampai))
            ->when($request->search, fn($q) =>
            $q->where('nama', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(10);
        $allBahanBaku = BahanBaku::all();
        $countinput = BahanBaku::whereDate('created_at', now()->toDateString())->count();
        $baranginput = BahanBaku::count();
        $hargainput = BahanBaku::sum('harga');
        $jumlahAktif = $allBahanBaku->filter(function ($item) {
            return $item->status === 'Aktif';
        })->count();
        return view('karyawan.inputProduksiBahanBaku', compact('bahanBakus', 'countinput', 'baranginput', 'hargainput', 'jumlahAktif'));
    }

    public function downlod_pdf()
    {
        $bahanBakus = BahanBaku::latest()->get();
        $pdf = PDF::loadView('pdf.bahanBaku_pdf', compact(
            'bahanBakus',
        ));

        return $pdf->download('laporan_bahanBaku.pdf');
    }
}
