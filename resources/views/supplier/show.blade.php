@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Supplier</h1>

    <table class="table table-bordered">
        <tr>
            <th>Nama Supplier</th>
            <td>{{ $supplier->nama }}</td>
        </tr>
        <tr>
            <th>Email Supplier</th>
            <td>{{ $supplier->email ?? '-' }}</td>
        </tr>
        <tr>
            <th>Telepon Supplier</th>
            <td>{{ $supplier->telepon ?? '-' }}</td>
        </tr>
        <tr>
            <th>Alamat Supplier</th>
            <td>{{ $supplier->alamat ?? '-' }}</td>
        </tr>
    </table>

    <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
