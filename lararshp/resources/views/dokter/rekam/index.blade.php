@extends('layouts.dokter')

@section('content')
<style>
    .rekam-wrapper {
        padding: 32px 40px 40px;
        background: #f3f6ff;
        min-height: calc(100vh - 80px);
    }

    .rekam-title {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 24px;
    }

    .rekam-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .rekam-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .rekam-table thead {
        background: #eef2ff;
    }

    .rekam-table th,
    .rekam-table td {
        padding: 14px 20px;
        text-align: left;
    }

    .rekam-table th {
        font-weight: 600;
        color: #4b5563;
        font-size: 13px;
        border-bottom: 1px solid #e5e7eb;
    }

    .rekam-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
    }

    .rekam-table tbody tr:hover {
        background: #f9fafb;
    }

    .rekam-date {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #374151;
        font-weight: 500;
    }

    .rekam-date-icon {
        width: 26px;
        height: 26px;
        border-radius: 999px;
        background: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .rekam-pasien-nama {
        font-weight: 600;
        color: #111827;
    }

    .rekam-pasien-jenis {
        font-size: 12px;
        color: #6b7280;
    }

    .rekam-diagnosa {
        color: #111827;
        font-weight: 500;
    }

    .rekam-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-icon {
        width: 30px;
        height: 30px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: transform 0.12s ease, box-shadow 0.12s ease, background 0.12s ease;
        text-decoration: none;
        color: #fff;
    }

    .btn-eye {
        background: #2563eb;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.35);
    }

    .btn-eye:hover {
        transform: translateY(-1px);
        background: #1d4ed8;
    }

    .btn-plus {
        background: #16a34a;
        box-shadow: 0 4px 10px rgba(22, 163, 74, 0.35);
    }

    .btn-plus:hover {
        transform: translateY(-1px);
        background: #15803d;
    }

    .rekam-empty {
        text-align: center;
        padding: 30px 0;
        color: #6b7280;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .rekam-wrapper {
            padding: 20px 16px 28px;
        }

        .rekam-title {
            font-size: 22px;
        }

        .rekam-table th,
        .rekam-table td {
            padding: 10px 12px;
        }
    }
</style>

<div class="rekam-wrapper">
    <h1 class="rekam-title">Daftar Rekam Medis</h1>

    <div class="rekam-card">
        <table class="rekam-table">
            <thead>
                <tr>
                    <th>TANGGAL</th>
                    <th>PASIEN</th>
                    <th>DIAGNOSA</th>
                    <th style="text-align:center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekamMedis as $rm)
                    <tr>
                        {{-- Tanggal --}}
                        <td>
                            <div class="rekam-date">
                                    <i class="fa-regular fa-calendar"></i>
                               
                                {{ $rm->tanggal }}
                            </div>
                        </td>

                        {{-- Pasien --}}
                        <td>
                            <div class="rekam-pasien-nama">{{ $rm->nama_hewan }}</div>
                            <div class="rekam-pasien-jenis">
                                {{ $rm->jenis }} - {{ $rm->ras }}
                            </div>
                        </td>

                        {{-- Diagnosa --}}
                        <td>
                            <div class="rekam-diagnosa">
                                {{ $rm->diagnosa }}
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="rekam-actions">
                                {{-- Lihat detail rekam --}}
                                <a href="{{ route('dokter.rekam.detail', $rm->idrekam_medis) }}"
                                   class="btn-icon btn-eye" title="Lihat detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Tambah rekam baru untuk hewan ini --}}
                                <a href="{{ route('dokter.rekam.create', $rm->idpet) }}" class="btn btn-primary">+ Tambah Rekam</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="rekam-empty">
                            Belum ada data rekam medis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
