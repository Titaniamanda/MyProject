<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use Illuminate\Http\Request;

class TransaksiBarangController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiBarang::all();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        TransaksiBarang::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(TransaksiBarang $transaksi) // parameter wajib $transaksi
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, TransaksiBarang $transaksi) // parameter wajib $transaksi
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(TransaksiBarang $transaksi) // parameter wajib $transaksi
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
