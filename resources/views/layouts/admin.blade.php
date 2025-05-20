<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Planet Futsal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #f8fff8;
            display: flex;
            flex-direction: column;
        }

        .app-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #d0f0d0;
            flex-shrink: 0;
            padding-top: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .sidebar a {
            color: #2f5930;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: #a8d8a8;
            color: #1c3c20;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            overflow-y: auto;
            height: 100vh;
            width: 100%;
        }

        .snackbar {
            visibility: hidden;
            min-width: 250px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 8px;
            padding: 16px;
            position: fixed;
            z-index: 9999;
            right: 30px;
            bottom: 30px;
            font-size: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.5s ease;
        }

        .snackbar.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from { bottom: 0; opacity: 0; }
            to { bottom: 30px; opacity: 1; }
        }

        @keyframes fadeout {
            from { bottom: 30px; opacity: 1; }
            to { bottom: 0; opacity: 0; }
        }
    </style>
</head>
<body>

    <div class="app-container">
        <nav class="sidebar">
            <div class="px-3">
                <h5 class="mb-3">Admin Planet Futsal</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ request()->is('lapangan*') ? '' : '' }}">Lapangan</a>
                        <ul class="nav flex-column ps-3">
                            <li><a href="{{ route('lapangan.booked') }}" class="nav-link {{ request()->is('admin/lapangan/booked') ? 'active' : '' }}">Lapangan terpesan</a></li>
                            <li><a href="{{ route('lapangan.create') }}" class="nav-link {{ request()->is('admin/lapangan/create') ? 'active' : '' }}">Tambah Lapangan</a></li>
                            <li><a href="{{ route('lapangan.schedule') }}" class="nav-link {{ request()->is('admin/lapangan/schedule') ? 'active' : '' }}">Atur Jadwal Lapangan</a></li>
                            <li><a href="{{ route('lapangan.jadwal') }}" class="nav-link {{ request()->is('admin/lapangan/schedule/available') ? 'active' : '' }}">Pengaturan Lapangan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mt-3">
                        <a href="{{ route('laporan.keuangan') }}" class="nav-link {{ request()->is('admin/laporan/keuangan') ? 'active' : '' }}">Laporan Keuangan</a>
                    </li>
                    <li class="nav-item mt-3">
                        <a href="/qr/checkin" target="_blank">Check in</a>
                    </li>
                    <li class="nav-item mt-3">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link d-flex align-items-center gap-2 p-0" style="color: #dc3545;">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>

                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const snackbar = document.getElementById('snackbar');
            if (snackbar) {
                setTimeout(() => {
                    snackbar.classList.remove('show');
                }, 5000);
            }
        });
    </script>

</body>
</html>
