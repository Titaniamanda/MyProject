<nav class="navbar navbar-expand-lg fixed-top shadow-sm" style="background: linear-gradient(135deg, #3a78d8, #2a5bbd); height: 56px; z-index: 1020;">
  <div class="container-fluid px-3">
    <!-- Toggle sidebar -->
    <button id="sidebarToggle" class="btn btn-sm btn-outline-light d-md-none me-3 rounded" aria-label="Toggle sidebar" style="border-width: 1.5px; transition: background-color 0.3s ease;">
      <i class="bi bi-list fs-5"></i>
    </button>

    <!-- Brand -->
    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center fw-medium text-white" style="font-size: 1.2rem; letter-spacing: 0.05em;">
      <i class="bi bi-box-seam fs-4 me-2"></i>
      Inventori Barang
    </a>

    <!-- Right content -->
    <div class="d-flex align-items-center ms-auto gap-3">

      <!-- Notification -->
      <div class="dropdown">
        <button id="notificationDropdown" class="btn btn-link position-relative p-0 text-white" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications" style="font-size: 1.1rem;">
          <i class="bi bi-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 0.65rem; font-weight: 600;">
            3
            <span class="visually-hidden">unread notifications</span>
          </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="notificationDropdown" style="min-width: 260px;">
          <li class="dropdown-header fw-semibold">Notifikasi</li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Barang A hampir habis</a></li>
          <li><a class="dropdown-item" href="#">Barang B baru ditambahkan</a></li>
          <li><a class="dropdown-item" href="#">Update sistem tersedia</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-center text-primary fw-semibold" href="#">Lihat semua</a></li>
        </ul>
      </div>

      <!-- User menu -->
      <div class="dropdown">
        <button id="userDropdown" class="btn btn-link d-flex align-items-center gap-2 p-0 text-white" data-bs-toggle="dropdown" aria-expanded="false" aria-label="User menu" style="font-weight: 500; font-size: 0.9rem;">
          <i class="bi bi-person-circle fs-4"></i>
          <span class="text-truncate" style="max-width: 90px;">
            {{ auth()->user()->name ?? 'Pengguna' }}
          </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown" style="min-width: 180px;">
          <li><a class="dropdown-item" href="{{ route('profile') }}">Profil Saya</a></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
      </div>

    </div>
  </div>
</nav>
