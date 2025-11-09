<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/home">Stok Barang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/barang">Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="/vendor">Vendor</a></li>
                    <li class="nav-item"><a class="nav-link" href="/satuan">Satuan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user">User</a></li>
                    <li class="nav-item"><a class="nav-link" href="/role">Role</a></li>
                    <li class="nav-item"><a class="nav-link" href="/kartu-stok">Kartu Stok</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center mt-5 text-muted">
        <small>&copy; 2025 Sistem Stok Barang | Universitas Airlangga</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
