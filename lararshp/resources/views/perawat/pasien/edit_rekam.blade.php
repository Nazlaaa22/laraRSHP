@extends('layouts.perawat')

@section('content')
<div class="container py-4">

    <a href="{{ url()->previous() }}" class="text-success fw-bold mb-3 d-inline-block">
        ← Kembali
    </a>

    <div class="card p-4 rounded-3 shadow-sm mb-4">
        <h4 class="fw-bold mb-3">✏ Edit Rekam Medis</h4>

        <form action="{{ route('perawat.rekam.update', $rekam->idrekam_medis) }}" method="POST">
            @csrf

            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control mb-3"
                   value="{{ $rekam->tanggal }}" required>

            <label>Diagnosis</label>
            <input type="text" name="diagnosa" class="form-control mb-3"
                   value="{{ $rekam->diagnosa }}" required>

            <label>Perawatan / Tindakan</label>
            <select name="perawatan" class="form-control mb-3">
                @foreach ($tindakan as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}"
                        {{ ($rekam->detail->first()->idkode_tindakan_terapi ?? '') == $t->idkode_tindakan_terapi ? 'selected' : '' }}>
                        {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                    </option>
                @endforeach
            </select>

            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3">{{ $rekam->anamnesa }}</textarea>

            <button type="submit" class="btn btn-success mt-3">💾 Simpan Perubahan</button>
        </form>
    </div>

</div>
@endsection
