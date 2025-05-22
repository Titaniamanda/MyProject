@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 520px;">
    <div class="bg-white rounded-4 shadow-sm p-4 px-4 px-md-5">
        <h4 class="mb-4 text-center text-primary fw-semibold">Tambah Barang</h4>

        @if($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm mb-3 small" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li><i class="bi bi-exclamation-circle-fill me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            @php
                $fields = [
                    ['name'=>'kode_barang', 'label'=>'Kode Barang', 'type'=>'text', 'placeholder'=>'Masukkan kode barang'],
                    ['name'=>'nama_barang', 'label'=>'Nama Barang', 'type'=>'text', 'placeholder'=>'Masukkan nama barang'],
                    ['name'=>'kategori', 'label'=>'Kategori', 'type'=>'text', 'placeholder'=>'Contoh: Elektronik, Makanan'],
                    ['name'=>'jumlah', 'label'=>'Jumlah', 'type'=>'number', 'placeholder'=>'0', 'min'=>1],
                    ['name'=>'satuan', 'label'=>'Satuan', 'type'=>'text', 'placeholder'=>'Contoh: pcs, kg, liter'],
                    ['name'=>'harga', 'label'=>'Harga (Rp)', 'type'=>'number', 'placeholder'=>'0.00', 'step'=>'0.01', 'min'=>0],
                ];
            @endphp

            @foreach($fields as $field)
            <div class="mb-3">
                <label for="{{ $field['name'] }}" class="form-label fw-medium text-secondary small">
                    {{ $field['label'] }} <span class="text-danger">*</span>
                </label>
                <input
                    type="{{ $field['type'] }}"
                    name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}"
                    class="form-control rounded-3 form-control-sm @error($field['name']) is-invalid @enderror"
                    placeholder="{{ $field['placeholder'] }}"
                    value="{{ old($field['name']) }}"
                    required
                    @isset($field['min']) min="{{ $field['min'] }}" @endisset
                    @isset($field['step']) step="{{ $field['step'] }}" @endisset
                >
                @error($field['name'])
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>
            @endforeach

            <div class="mb-4">
                <label for="foto" class="form-label fw-medium text-secondary small">Foto Barang</label>
                <input type="file" name="foto" class="form-control form-control-sm rounded-3 @error('foto') is-invalid @enderror" id="foto" accept="image/*">
                <small class="text-muted d-block mt-1">Ukuran maks. 2MB. Format: JPG, PNG, JPEG.</small>
                @error('foto')
                    <div class="invalid-feedback small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold py-2 rounded-3 shadow-sm" style="font-size: 0.95rem;">
                Simpan
            </button>
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary w-100 fw-semibold py-2 rounded-3 mt-3 shadow-sm" style="font-size: 0.95rem;">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
