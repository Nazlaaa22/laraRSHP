<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Toko</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        /* === SIDEBAR === */
        .sidebar {
            background: linear-gradient(180deg, #007bff, #0056b3);
            color: white;
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto; /* ✅ bisa discroll */
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.3) transparent;
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.6);
        }

        .sidebar h4 {
            color: #fff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar a {
            color: #e6e6e6;
            text-decoration: none;
            display: block;
            padding: 12px 18px;
            border-radius: 8px;
            margin: 6px 10px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .logout-btn {
            color: #ff4d4d !important;
            text-decoration: none;
            font-weight: 500;
            display: block;
            text-align: center;
            padding: 12px;
            margin-top: auto;
            transition: 0.3s;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .logout-btn:hover {
            background-color: #ff4d4d;
            color: #fff !important;
        }

        /* === CONTENT AREA === */
        .content {
            margin-left: 260px;
            padding: 25px;
        }

        /* === NAVBAR === */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 25px;
            flex-wrap: wrap;
        }

        .navbar h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .navbar .user-info span {
            font-weight: 500;
        }

        .navbar .btn-outline-danger {
            color: #ff4d4d;
            border-color: #ff4d4d;
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar .btn-outline-danger:hover {
            background-color: #ff4d4d;
            color: #fff;
        }

        @media (max-width: 992px) {
            .content {
                margin-left: 0;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div>
            <h4>
                <i class="bi bi-shop me-2"></i>Manajemen Toko
            </h4>

            <a href="/" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('barang.index') }}" class="{{ Request::is('barang') ? 'active' : '' }}"><i class="bi bi-box-seam"></i> Barang</a>
            <a href="{{ route('penjualan.index') }}" class="{{ Request::is('penjualan') ? 'active' : '' }}"><i class="bi bi-cart4"></i> Penjualan</a>
            <a href="{{ route('pengadaan.index') }}"><i class="bi bi-truck"></i> Pengadaan</a>
            <a href="{{ route('penerimaan.index') }}"><i class="bi bi-bag-check"></i> Penerimaan</a>
            <a href="{{ route('vendor.index') }}"><i class="bi bi-people"></i> Vendor</a>
            <a href="{{ route('retur.index') }}" class="{{ Request::is('retur*') ? 'active' : '' }}"><i class="bi bi-arrow-repeat"></i> Retur</a>
            <a href="{{ route('margin.index') }}" class="{{ Request::is('margin-penjualan*') ? 'active' : '' }}"><i class="bi bi-cash-stack"></i> Margin Penjualan</a>
            <a href="{{ route('kartu-stok.index') }}"><i class="bi bi-box-seam"></i> Kartu Stok</a>
            <a href="{{ route('role.index') }}" class="{{ request()->is('role*') ? 'active' : '' }}"><i class="bi bi-person-gear"></i> Role</a>
            <a href="{{ route('user.index') }}" class="{{ request()->is('user*') ? 'active' : '' }}"><i class="bi bi-person"></i> User</a>

        </div>

        <a href="#" class="logout-btn mt-3">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <!-- NAVBAR -->
        <nav class="navbar shadow-sm">
            <h5>Dashboard Overview</h5>
            <div class="user-info">
                <i class="bi bi-person-circle fs-5 text-primary"></i>
                <span>Admin User</span>
                <a href="#" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <div class="container-fluid mt-4">
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
