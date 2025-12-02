@extends('layouts.resepsionis')

@section('title', 'Temu Dokter')

@section('content')
<div class="container mt-4">

    <h3 class="fw-bold mb-4" style="color: var(--primary)">👨‍⚕️ Daftar Temu Dokter</h3>

    <div class="card shadow-sm p-4" style="border-radius: 18px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($temu as $t)
                    <tr>
                        <td>{{ $t->idreservasi_dokter }}</td>
                        <td>{{ $t->pet->nama }}</td>
                        <td>{{ $t->pet->pemilik->user->nama }}</td>
                        <td>{{ $t->dokter->user->nama ?? '-' }}</td>

                        <td>
                            @if($t->status == 1)
                                <span class="badge bg-success">Selesai</span>
                            @elseif($t->status == 2)
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-secondary">Proses</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('resepsionis.temu.edit', $t->idreservasi_dokter) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('resepsionis.temu.destroy', $t->idreservasi_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr><td colspan="6" class="text-muted">Belum ada data antrian temu dokter.</td></tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
