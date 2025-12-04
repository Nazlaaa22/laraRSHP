@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Dokter')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f3f7ff;
        }

        /* Top bar */
        .topbar {
            background: linear-gradient(90deg, #7b2ff7, #5ac8fa); /* ungu → biru pastel */
            color: #fff;
        }

        .topbar-title {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .topbar-subtitle {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        .topbar-profile-btn {
            background: rgba(255, 255, 255, 0.14);
            border-radius: 999px;
            padding: 0.4rem 1rem;
            color: #fff;
            font-size: 0.9rem;
        }

        .topbar-profile-btn i {
            font-size: 1rem;
        }

        .nav-tabs.dokter-tabs {
            background: #fff;
            border-bottom: none;
            box-shadow: 0 8px 20px rgba(15, 35, 95, 0.08);
        }

        .dokter-tabs .nav-link {
            border: none;
            border-radius: 0;
            padding: 0.9rem 1.5rem;
            font-weight: 500;
            color: #6b7280;
        }

        .dokter-tabs .nav-link.active {
            color: #111827;
            border-bottom: 3px solid #7b2ff7;
            background: linear-gradient(to bottom, #ffffff, #f6f3ff);
        }

        .page-wrapper {
            max-width: 1000px;
            margin: 1.5rem auto 3rem;
        }

        .page-title {
            font-weight: 700;
            color: #111827;
        }

        .card-search {
            border-radius: 18px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.18rem rgba(123, 47, 247, 0.18);
            border-color: #7b2ff7;
        }

        .pasien-card {
            border-radius: 18px;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .pasien-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.13);
        }

        .status-badge {
            background: #ecfeff;
            color: #0f766e;
            font-size: 0.75rem;
            padding: 0.35rem 0.8rem;
        }

        .btn-primary-soft {
            background: linear-gradient(90deg, #7b2ff7, #5ac8fa);
            border: none;
            color: #fff;
            font-weight: 500;
        }

        .btn-primary-soft:hover {
            filter: brightness(0.95);
            color: #fff;
        }

        .text-muted-soft {
            color: #6b7280;
        }
    </style>

    @stack('styles')
</head>
<body>


{{-- TOPBAR --}}
<nav class="navbar topbar py-3">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center gap-3">
            <div>
                <div class="topbar-title">Dashboard Dokter RSHP</div>
                <div class="topbar-subtitle">Rumah Sakit Hewan Pendidikan</div>
            </div>
        </div>

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle"></i>
                <span class="fw-semibold">
                    {{ Auth::user()->nama ?? 'drh.Irwan' }}
                </span>
            </div>
    </div>
</nav>

{{-- TAB MENU --}}
<ul class="nav nav-tabs dokter-tabs px-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dokter.pasien') ? 'active' : '' }}"
           href="{{ route('dokter.pasien') }}">
            Data Pasien
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dokter.rekam.*') ? 'active' : '' }}"
           href="{{ route('dokter.rekam.index') }}">
            Rekam Medis
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dokter.profil') ? 'active' : '' }}"
           href="{{ route('dokter.profil') }}">
            Profil Saya
        </a>
    </li>
</ul>

{{-- MAIN CONTENT --}}
<div class="page-wrapper px-3 px-md-0">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
