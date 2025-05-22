<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       // Ambil nilai search dan perPage dari query string
    $search = $request->input('search');
    $perPage = $request->input('perPage', 10); // default 10 jika tidak diisi

    // Query barang
    $barangs = \App\Models\Barang::when($search, function ($query, $search) {
            $query->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $search . '%')
                  ->orWhere('kategori', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage)
        ->withQueryString(); // agar query search & perPage tetap ada saat pagination

    return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

// Ambil data kecuali foto dulu
        $barang= $request->except('foto');

        // Handle foto jika ada
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // ✅ Inisialisasi manager versi 3 dengan GdDriver
            $manager = new ImageManager(new GdDriver());

            // ✅ Resize dan simpan
            $img = $manager->read($image->getRealPath());
            $img->resize(300, 400)->save(public_path('image/' . $filename));

            $barang['foto'] = $filename;
        }


    // Simpan data anggota ke database
    Barang::create($barang);

    // Redirect dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data= $request->only(['kode_barang', 'nama_barang', 'kategori', 'jumlah', 'harga', 'satuan']);

        if ($request->hasFile('foto')) {
        // Hapus foto lama
        if ($barang->foto && file_exists(public_path('image/' . $barang->foto))) {
            unlink(public_path('image/' . $barang->foto));
        }

        $image = $request->file('foto');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('image/' . $filename);

        // Gunakan ImageManager (Intervention v3)
        $manager = new ImageManager(new GdDriver());
        $img = $manager->read($image->getRealPath());
        $img->resize(300, 400)->save($path);

        $data['foto'] = $filename;
    }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data anggota berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // Hapus foto barang jika ada sebelum hapus data
        if ($barang->foto && \Storage::exists('public/foto_barang/' . $barang->foto)) {
            \Storage::delete('public/foto_barang/' . $barang->foto);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
