<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #7EC8FF, #0066CC);
            min-height: 100vh;
        }
        .sidebar {
            background: #ffffff;
            height: 100vh;
            width: 260px;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 20px;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            padding: 12px 15px;
            border-radius: 12px;
            font-weight: 600;
            color: #0066CC;
            text-decoration: none;
            margin-bottom: 10px;
            transition: 0.3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #e6f3ff;
        }
        .content {
            margin-left: 280px;
            padding: 30px;
        }
        .profile-name {
            font-weight: 700;
            color: #004a94;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <h4 class="fw-bold mb-4">🐾 VetCare</h4>
        <p class="profile-name">Dashboard Perawat<br>{{ session('nama') }}</p>
        <hr>

        <a href="{{ route('perawat.dashboard') }}" class="active">🏠 Beranda</a>
        <a href="{{ route('perawat.pasien') }}">🐕 Data Pasien</a>
        <a href="#">👤 Profil Saya</a>
        <a href="/logout" class="text-danger fw-bold">🚪 Keluar</a>
    </div>

    {{-- CONTENT --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Bootstrap JS wajib --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
