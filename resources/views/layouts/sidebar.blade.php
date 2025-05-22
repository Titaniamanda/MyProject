<nav id="sidebar" class="shadow-sm">
    <ul class="nav flex-column px-3">

        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>

        <!-- Barang group menu -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center {{ Request::routeIs('barang.*') || Request::routeIs('kategori.*') ? '' : 'collapsed' }}"
               data-bs-toggle="collapse"
               href="#barangSubmenu"
               role="button"
               aria-expanded="{{ Request::routeIs('barang.*') || Request::routeIs('kategori.*') ? 'true' : 'false' }}"
               aria-controls="barangSubmenu">
                <i class="bi bi-box me-2"></i> Barang
                <i class="bi bi-chevron-down ms-auto small"></i>
            </a>
            <div class="collapse {{ Request::routeIs('barang.*') || Request::routeIs('kategori.*') ? 'show' : '' }}" id="barangSubmenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a href="{{ route('barang.index') }}" class="nav-link {{ Request::routeIs('barang.*') ? 'active' : '' }}">
                            <i class="bi bi-circle me-2"></i> Data Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link {{ Request::routeIs('kategori.*') ? 'active' : '' }}">
                            <i class="bi bi-circle me-2"></i> Kategori
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Transaksi menu -->
        <li class="nav-item mb-2">
            <a href="{{ route('transaksi.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('transaksi.*') ? 'active' : '' }}">
                <i class="bi bi-currency-exchange me-2"></i> Transaksi
            </a>
        </li>

        <!-- Supplier menu -->
        <li class="nav-item mb-2">
            <a href="{{ route('supplier.index') }}" class="nav-link d-flex align-items-center {{ Request::routeIs('supplier.*') ? 'active' : '' }}">
                <i class="bi bi-truck me-2"></i> Supplier
            </a>
        </li>

    </ul>
</nav>
