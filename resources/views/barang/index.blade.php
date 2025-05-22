@extends('layouts.app')

@section('content')
    <style>
        .card-modern {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        .card-header-modern {
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            color: white;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 1.2rem 1.5rem;
        }

        .btn-custom-add {
            border: 2px solid #ffffff;
            background-color: transparent;
            color: #ffffff;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            transition: 0.3s ease;
        }

        .btn-custom-add:hover {
            background-color: #ffffff;
            color: #2563eb;
        }

        .table-modern th {
            background-color: #f1f5f9;
            font-size: 0.9rem;
            color: #1f2937;
        }

        .table-modern td {
            vertical-align: middle;
            font-size: 0.88rem;
        }

        .table-modern tr:hover {
            background-color: #f8fafc;
        }

        .badge-status {
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 999px;
            font-weight: 600;
        }

        .btn-icon-sm {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }

        @media (max-width: 768px) {
            .btn-custom-add {
                font-size: 0.85rem;
                padding: 5px 12px;
            }
        }
    </style>

    <div class="container py-4">
        <div class="card card-modern mb-4">
            <div class="card-header-modern d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0">Daftar Barang</h4>
                <a href="{{ route('barang.create') }}" class="btn btn-custom-add mt-2 mt-md-0">
                    Tambah Barang
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('barang.index') }}" method="GET" class="row g-2 mb-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Cari barang..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="perPage" class="form-select" onchange="this.form.submit()">
                            @foreach ([5, 10, 25, 50] as $jumlah)
                                <option value="{{ $jumlah }}" {{ request('perPage') == $jumlah ? 'selected' : '' }}>
                                    {{ $jumlah }} data
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-modern table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $index => $barang)
                                <tr>
                                    <td>{{ $barangs->firstItem() + $index }}</td>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>
                                        @if ($barang->foto)
                                            <img src="{{ asset('image/' . $barang->foto) }}" width="50" height="50"
                                                class="rounded shadow-sm" style="object-fit: cover;"
                                                alt="foto {{ $barang->nama_barang }}">
                                        @else
                                            <span class="text-muted fst-italic">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->kategori }}</td>
                                    <td>{{ $barang->jumlah }}</td>
                                    <td>{{ $barang->satuan }}</td>
                                    <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($barang->status_stok) {
                                                'Habis' => 'bg-danger text-white',
                                                'Menipis' => 'bg-warning text-dark',
                                                default => 'bg-success text-white',
                                            };
                                        @endphp
                                        <span class="badge-status {{ $statusClass }}">{{ $barang->status_stok }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                                            <a href="{{ route('barang.show', $barang) }}"
                                                class="btn btn-outline-info btn-icon-sm" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('barang.edit', $barang) }}"
                                                class="btn btn-outline-warning btn-icon-sm" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('barang.destroy', $barang) }}" method="POST"
                                                onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-icon-sm"
                                                    title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-muted">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $barangs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
