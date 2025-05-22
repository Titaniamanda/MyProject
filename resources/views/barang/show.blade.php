@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Barang: {{ $barang->nama_barang }}</h3>

    <table class="table table-bordered">
        <tr>
            <th>Kode Barang</th>
            <td>{{ $barang->kode_barang }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $barang->kategori }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $barang->jumlah }} {{ $barang->satuan}}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if ($barang->status_stok === 'Habis')
                    <span class="badge bg-danger">Habis</span>
                @elseif ($barang->status_stok === 'Menipis')
                    <span class="badge bg-warning text-dark">Menipis</span>
                @else
                    <span class="badge bg-success">Cukup</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Foto Barang</th>
            <td>
                @if($barang->foto)
                    <img src="{{ asset('image/' . $barang->foto) }}" alt="Foto Barang" style="max-height: 200px;">
                @else
                    <span>Tidak ada foto</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
