@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4 text-primary fw-bold text-center">Daftar Supplier</h1>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 gap-3">
        <a href="{{ route('supplier.create') }}" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm"
           onmouseover="this.classList.add('shadow-lg')" onmouseout="this.classList.remove('shadow-lg')"
           style="transition: box-shadow 0.3s, transform 0.3s;">
            Tambah Supplier
        </a>

        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show mb-0 shadow-sm rounded" role="alert" style="max-width: 350px;">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="table-responsive shadow-sm rounded border">
        <table class="table table-striped table-hover align-middle mb-0" style="min-width: 700px;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" class="text-center" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($supplier as $s)
                    <tr
                        onmouseover="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1.02)'; this.style.transition='all 0.3s ease';"
                        onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';"
                        style="transition: all 0.3s ease;"
                    >
                        <td class="fw-semibold">{{ $s->nama }}</td>
                        <td>{{ $s->email ?? '-' }}</td>
                        <td>{{ $s->telepon ?? '-' }}</td>
                        <td>{{ $s->alamat ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('supplier.show', $s->id) }}" class="btn btn-info btn-sm me-1 rounded-pill px-3 shadow-sm"
                               onmouseover="this.classList.add('shadow-lg'); this.style.transform='scale(1.1)';"
                               onmouseout="this.classList.remove('shadow-lg'); this.style.transform='scale(1)';"
                               style="transition: all 0.3s ease;" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('supplier.edit', $s->id) }}" class="btn btn-warning btn-sm me-1 rounded-pill px-3 shadow-sm"
                               onmouseover="this.classList.add('shadow-lg'); this.style.transform='scale(1.1)';"
                               onmouseout="this.classList.remove('shadow-lg'); this.style.transform='scale(1)';"
                               style="transition: all 0.3s ease;" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data supplier ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm" title="Hapus"
                                    onmouseover="this.classList.add('shadow-lg'); this.style.transform='scale(1.1)';"
                                    onmouseout="this.classList.remove('shadow-lg'); this.style.transform='scale(1)';"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="table-warning">
                        <td colspan="5" class="text-center fst-italic text-muted">Data supplier kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $supplier->links() }}
    </div>
</div>
@endsection
