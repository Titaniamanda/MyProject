@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang"
                   value="{{ old('nama_barang', $transaksi->nama_barang) }}" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select name="jenis" id="jenis" required class="form-select">
                <option value="masuk" {{ old('jenis', $transaksi->jenis) == 'masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="keluar" {{ old('jenis', $transaksi->jenis) == 'keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah"
                   value="{{ old('jumlah', $transaksi->jumlah) }}" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" step="0.01" name="harga_satuan" id="harga_satuan"
                   value="{{ old('harga_satuan', $transaksi->harga_satuan) }}" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                   value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi->format('Y-m-d')) }}" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
