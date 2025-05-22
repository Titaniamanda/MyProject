@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body">
            <h3 class="fw-bold text-center text-primary mb-4">
                <i class="bi bi-list-columns-reverse me-2"></i>Daftar Transaksi Barang
            </h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('transaksi.create') }}" class="btn btn-gradient-blue px-4 py-2 rounded-pill shadow-sm">
                    Tambah Transaksi
                </a>
            </div>

            <div class="table-responsive">
                <table id="transaksiTable" class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $index => $transaksi)
                        <tr class="bg-white">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $transaksi->nama_barang }}</td>
                            <td>{{ $transaksi->jenis }}</td>
                            <td>{{ $transaksi->jumlah }}</td>
                            <td>Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                            <td class="text-center">
                                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-outline-warning btn-sm rounded-circle me-1" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    body {
        background-color: #f0f4f8;
        font-family: 'Segoe UI', sans-serif;
    }

    .btn-gradient-blue {
        background: linear-gradient(to right, #4f46e5, #3b82f6);
        color: #fff;
        border: none;
    }

    .btn-gradient-blue:hover {
        background: linear-gradient(to right, #4338ca, #2563eb);
        color: #fff;
    }

    .table thead th {
        font-size: 14px;
        font-weight: 600;
        padding: 16px;
        border: none;
    }

    .table tbody td {
        font-size: 14px;
        padding: 14px;
    }

    .table tbody tr:hover {
        background-color: #eef2f7;
    }

    .btn-outline-warning:hover {
        background-color: #f59e0b;
        color: #fff;
    }

    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: #fff;
    }

    .btn-sm:hover {
        transform: scale(1.05);
        transition: 0.2s ease-in-out;
    }

    @media (max-width: 576px) {
        .btn {
            font-size: 12px;
        }

        .table {
            font-size: 13px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#transaksiTable').DataTable({
            language: {
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                search: "Cari:",
                paginate: {
                    next: "›",
                    previous: "‹"
                }
            },
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [],
        });
    });
</script>
@endpush

