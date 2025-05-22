<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Menambahkan kolom foto, kode_barang, dan unit ke dalam fillable
    protected $fillable = [
        'nama_barang',
        'kategori',
        'jumlah',
        'harga',
        'foto',         // path atau nama file foto barang
        'kode_barang',  // kode unik barang
        'satuan'          // satuan unit barang, misal pcs, kg, liter, dll
    ];

    // Akses status stok secara otomatis
    public function getStatusStokAttribute()
    {
        if ($this->jumlah <= 0) {
            return 'Habis';
        } elseif ($this->jumlah <= 5) {
            return 'Menipis';
        } else {
            return 'Cukup';
        }
    }
}
