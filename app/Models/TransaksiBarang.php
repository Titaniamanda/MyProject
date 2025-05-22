<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    protected $table = 'transaksi_barangs';

    protected $fillable = [
        'nama_barang',
        'jenis',
        'jumlah',
        'harga_satuan',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];
}
