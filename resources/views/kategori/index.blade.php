@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow rounded-4">
        <div class="card-body">
            <h3 class="text-center fw-bold text-primary mb-4">Daftar Kategori Barang</h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('kategori.create') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                    Tambah Kategori
                </a>
            </div>

            <div class="table-responsive rounded-3 shadow-sm">
                <table id="kategoriTable" class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $item)
                        <tr>
                            <td class="text-center"></td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->deskripsi ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-circle me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data kategori.</td>
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
        background-color: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        background-color: #ffffff;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .table thead th {
        font-size: 14px;
        font-weight: 600;
        border: none;
        padding: 14px;
    }

    .table tbody td {
        font-size: 14px;
        padding: 14px;
    }

    .table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .btn-sm:hover {
        transform: scale(1.07);
        transition: 0.2s;
    }

    .btn-outline-warning:hover {
        background-color: #f59e0b;
        color: #fff;
    }

    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: #fff;
    }

    @media (max-width: 576px) {
        .btn {
            font-size: 13px;
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
        $('#kategoriTable').DataTable({
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
            columnDefs: [{
                targets: 0,
                searchable: false,
                orderable: false,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                }
            }],
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [],
            dom: '<"row mb-3"<"col-sm-6"l><"col-sm-6 text-end"f>>rt<"row mt-3"<"col-sm-6"i><"col-sm-6 text-end"p>>'
        });
    });
</script>
@endpush
