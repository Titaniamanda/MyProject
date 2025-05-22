<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\TransaksiBarang;
use App\Models\Supplier;   // jangan lupa import model Supplier

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_barang = Barang::count();
        $jumlah_kategori = KategoriBarang::count();
        $jumlah_transaksi = TransaksiBarang::count();

        $stok_masuk = TransaksiBarang::where('jenis', 'masuk')->sum('jumlah');
        $stok_keluar = TransaksiBarang::where('jenis', 'keluar')->sum('jumlah');

        $supplier = Supplier::count();  // ambil data supplier

        return view('dashboard.index', compact(
            'jumlah_barang',
            'jumlah_kategori',
            'jumlah_transaksi',
            'stok_masuk',
            'stok_keluar',
            'supplier'  // kirim ke view
        ));
    }
}
