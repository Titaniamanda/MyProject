<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;


class KategoriBarangController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $kategori = KategoriBarang::all();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Menyimpan kategori baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_barangs,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk kategori tertentu.
     */
   public function edit(KategoriBarang $kategori)
{
    return view('kategori.edit', ['kategori' => $kategori]);
}

public function update(Request $request, KategoriBarang $kategori)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255|unique:kategori_barangs,nama_kategori,' . $kategori->id,
        'deskripsi' => 'nullable|string',
    ]);

    $kategori->update([
        'nama_kategori' => $request->nama_kategori,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
}


    /**
     * Menghapus kategori dari database.
     */
    public function destroy(KategoriBarang $kategori)
{
    $kategori->delete();

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
}

}
