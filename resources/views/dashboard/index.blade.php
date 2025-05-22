@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 2rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
    }

    .info-card {
        background: linear-gradient(135deg, #4a90e2, #357ABD);
        border-radius: 0.8rem;
        padding: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
        height: 120px;
    }

    .info-card.info-card-column {
        height: 180px;
        padding: 1.5rem;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
    }

    .info-icon {
        font-size: 1.6rem;
        color: white;
        flex-shrink: 0;
    }

    .info-title {
        font-size: 0.9rem;
        font-weight: 600;
        opacity: 0.9;
    }

    .info-value {
        font-size: 1.3rem;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .info-card {
            height: auto;
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="dashboard-title">Dashboard Inventaris Barang</div>

<div class="row g-4">
    <!-- Info Ringkas -->
    <div class="col-md-3 col-sm-6">
        <div class="info-card">
            <i class="bi bi-box-seam info-icon"></i>
            <div>
                <div class="info-title">Jumlah Barang</div>
                <div class="info-value">{{ $jumlah_barang }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="info-card">
            <i class="bi bi-tags info-icon"></i>
            <div>
                <div class="info-title">Jumlah Kategori</div>
                <div class="info-value">{{ $jumlah_kategori }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="info-card">
            <i class="bi bi-truck info-icon"></i>
            <div>
                <div class="info-title">Jumlah Supplier</div>
                <div class="info-value">{{ $supplier }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="info-card">
            <i class="bi bi-arrow-repeat info-icon"></i>
            <div>
                <div class="info-title">Total Transaksi</div>
                <div class="info-value">{{ $jumlah_transaksi }}</div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Stok -->
    <div class="col-md-12">
        <div class="info-card info-card-column" style="color:#fff;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-box-arrow-in-down info-icon"></i>
                <div class="info-title">Ringkasan Stok</div>
            </div>
            <div style="display: flex; justify-content: space-around; width: 100%; margin-top: 1rem;">
                <div>
                    <div class="info-title">Masuk</div>
                    <div class="info-value">{{ $stok_masuk }}</div>
                </div>
                <div>
                    <div class="info-title">Keluar</div>
                    <div class="info-value">{{ $stok_keluar }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
@endsection
