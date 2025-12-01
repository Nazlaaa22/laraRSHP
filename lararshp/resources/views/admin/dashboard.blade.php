@extends('layouts.lte.main')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="app-content-headerText">Dashboard</h3>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">

    {{-- 1. JENIS HEWAN --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>{{ $totalJenis }}</h3>
                <p>Jenis Hewan</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.jenis.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

    {{-- 2. RAS HEWAN --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>{{ $totalRas }}</h3>
                <p>Ras Hewan</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.ras.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

    {{-- 3. KATEGORI --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>{{ $totalKategori }}</h3>
                <p>Kategori</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.kategori.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

    {{-- 4. KATEGORI KLINIS --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>{{ $totalKategoriKlinis }}</h3>
                <p>Kategori Klinis</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.kategori_klinis.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

</div>


<div class="row mt-3">

    {{-- 5. TINDAKAN TERAPI --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info">
            <div class="inner">
                <h3>{{ $totalTindakan }}</h3>
                <p>Tindakan Terapi</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.tindakan_terapi.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

    {{-- 6. PET --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-secondary">
            <div class="inner">
                <h3>{{ $totalPet }}</h3>
                <p>Pet</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.pet.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

    {{-- 7. ROLE --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>{{ $totalRole }}</h3>
                <p>Role</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.role.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

    {{-- 8. USER --}}
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-dark">
            <div class="inner">
                <h3>{{ $totalUser }}</h3>
                <p>User</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">...</svg>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

</div>
@endsection

