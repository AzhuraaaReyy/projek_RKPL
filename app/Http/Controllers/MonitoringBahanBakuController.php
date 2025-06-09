<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class MonitoringBahanBakuController extends Controller
{
    /**
     * Tampilkan halaman monitoring stok bahan baku.
     */
    public function index()
    {
        // Ambil semua data bahan baku
        $bahanBakus = BahanBaku::all();

        // Kirim ke view monitoring/stok.blade.php
        return view('inputProduksiBahanBaku', compact('bahanBakus'));
    }

    public function formBahanBaku()
    {
        // Ambil semua data bahan baku
        $bahan = BahanBaku::orderBy('nama')->get();

        // Kirim ke view monitoring/stok.blade.php
        return view('form.create_bahanBaku', compact('bahan'));
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
            $bahanBakus = BahanBaku::findOrFail($id);
            $bahanBakus->delete();

            return redirect()->route('bahanBakus')->with('Success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('bahanBakus')->with('error', 'Data tidak dapat dihapus');
        }
    }

    public function show($id)
    {
        $bahanBakus = BahanBaku::findOrFail($id);
        return view('monitoring.stok', compact('bahanBakus'));
    }
}
