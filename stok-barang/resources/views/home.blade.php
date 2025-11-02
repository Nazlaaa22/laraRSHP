<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">📦 Stok Barang</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="/barang" class="nav-link">Barang</a></li>
        <li class="nav-item"><a href="/vendor" class="nav-link">Vendor</a></li>
        <li class="nav-item"><a href="/satuan" class="nav-link">Satuan</a></li>
        <li class="nav-item"><a href="/user" class="nav-link">User</a></li>
        <li class="nav-item"><a href="/role" class="nav-link">Role</a></li>
        <li class="nav-item"><a href="/kartu_stok" class="nav-link">Kartu Stok</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <h3 class="text-center mb-4 fw-bold text-dark">Dashboard Master Data</h3>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Barang</h5>
          <h2 class="fw-bold text-primary">{{ $data['barang'] }}</h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Vendor</h5>
          <h2 class="fw-bold text-success">{{ $data['vendor'] }}</h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Satuan</h5>
          <h2 class="fw-bold text-warning">{{ $data['satuan'] }}</h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">User</h5>
          <h2 class="fw-bold text-info">{{ $data['user'] }}</h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Role</h5>
          <h2 class="fw-bold text-danger">{{ $data['role'] }}</h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Kartu Stok</h5>
          <h2 class="fw-bold text-secondary">{{ $data['kartu_stok'] }}</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="text-center mt-5 mb-3 text-muted">
  <small>© 2025 Sistem Stok Barang | Universitas Airlangga</small>
</footer>

</body>
</html>
