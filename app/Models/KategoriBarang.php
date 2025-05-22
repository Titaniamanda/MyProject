<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBarang extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['nama_kategori', 'deskripsi'];

    /**
     * Relasi: Satu kategori memiliki banyak barang
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }

    /**
     * Tambahan accessor (jika ingin)
     * Contoh: huruf kapital otomatis untuk nama_kategori
     */
    public function getNamaKategoriAttribute($value)
    {
        return ucwords($value);
    }
}
