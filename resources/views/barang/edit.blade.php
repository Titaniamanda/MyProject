@extends('layouts.app')

@section('content')
    <h3>Edit Barang</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" id="kategori" value="{{ old('kategori', $barang->kategori) }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" required>
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" id="satuan" value="{{ old('unit', $barang->satuan) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" id="harga" step="0.01" value="{{ old('harga', $barang->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Barang</label>
            @if($barang->foto)
                <div class="mb-2">
                    <img src="{{ asset('image/' . $barang->foto) }}" alt="Foto Barang" style="max-height: 150px;">
                </div>
            @endif
            <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        </div>

        <button type="submit" class="btn btn-warning">Perbarui</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
