<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventori Barang - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* Reset dasar */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar */
        nav.navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 56px;
            line-height: 56px;
            background: linear-gradient(135deg, #3a78d8, #2a5bbd);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1030;
            padding: 0 1rem;
        }

        nav.navbar a.navbar-brand {
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        nav.navbar a.navbar-brand:hover {
            color: #e1e9f8;
            text-decoration: none;
        }

        /* Sidebar */
        #sidebar {
            position: fixed;
            top: 56px; /* di bawah navbar */
            left: 0;
            width: 220px;
            height: calc(100vh - 56px);
            background-color: #1e293b;
            color: #cbd5e1;
            padding-top: 1rem;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1020; /* dibawah navbar */
            border-right: 1px solid #334155;
        }

        #sidebar .nav-link {
            display: flex;
            align-items: center;
            font-size: 15px;
            font-weight: 500;
            color: #cbd5e1;
            padding: 10px 15px;
            border-radius: 8px;
            gap: 0.75rem;
            transition: all 0.3s ease;
            user-select: none;
        }

        #sidebar .nav-link i {
            font-size: 18px;
        }

        #sidebar .nav-link.active,
        #sidebar .nav-link:hover {
            background-color: #334155;
            color: #ffffff;
            transform: translateX(5px);
            text-decoration: none;
        }

        /* Sidebar hidden state for desktop */
        #sidebar.hidden {
            transform: translateX(-100%);
        }

        /* Sidebar hidden state for mobile (default hidden) */
        @media (max-width: 767.98px) {
            #sidebar {
                transform: translateX(-100%);
                z-index: 1040;
            }
            #sidebar.show {
                transform: translateX(0);
            }
        }

        /* Konten utama */
        main#content {
            margin-top: 56px; /* di bawah navbar */
            margin-left: 220px; /* sesuai lebar sidebar */
            padding: 1.5rem;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 56px);
        }

        main#content.full-width {
            margin-left: 0;
        }

        @media (max-width: 767.98px) {
            main#content {
                margin-left: 0;
            }
            main#content.full-width {
                margin-left: 0;
            }
        }

        /* Tombol toggle sidebar */
        #sidebarToggle {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.4rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.2rem 0.5rem;
            user-select: none;
            transition: color 0.3s ease;
        }
        #sidebarToggle:hover,
        #sidebarToggle:focus {
            color: #cbd5e1;
            outline: none;
        }
    </style>
</head>
<body>

    {{-- Navbar dan Sidebar hanya muncul jika sudah login --}}
    @auth
        @include('layouts.navbar')

        @include('layouts.sidebar')
    @endauth

    {{-- Konten utama --}}
    <main id="content" class="@guest full-width @endguest">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn?.addEventListener('click', () => {
            if(window.innerWidth < 768) {
                // Mobile: slide sidebar
                sidebar.classList.toggle('show');
            } else {
                // Desktop: hide sidebar + expand konten
                sidebar.classList.toggle('hidden');
                content.classList.toggle('full-width');
            }
        });

        // Klik di konten menutup sidebar di mobile
        content?.addEventListener('click', () => {
            if(window.innerWidth < 768 && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        // Optional: close sidebar on window resize >768 to prevent stuck sidebar open
        window.addEventListener('resize', () => {
            if(window.innerWidth >= 768) {
                sidebar.classList.remove('show');
            } else {
                sidebar.classList.remove('hidden');
                content.classList.remove('full-width');
            }
        });

        
    </script>

</body>
</html>
