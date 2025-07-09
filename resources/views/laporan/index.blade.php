@extends('layouts.app')

@section('pageTitle', 'Laporan Inventaris')
@section('content')
<div class="container mt-5">
    <h3 class="fw-semibold text-primary mb-4">Laporan Inventaris</h3>

    <div class="card shadow-sm border-0 rounded-4">
        {{-- filter --}}
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.cetak') }}" target="_blank" class="row g-3">

                {{-- Tanggal --}}
                <div class="col-md-3">
                    <label for="tanggal" class="form-label small fw-semibold text-muted">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control rounded-3 shadow-sm" required>
                </div>

                {{-- Status --}}
                <div class="col-md-3">
                    <label for="status" class="form-label small fw-semibold text-muted">Status Unit</label>
                    <select name="status" id="status" class="form-select rounded-3 shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>

                {{-- Jenis Laporan --}}
                <div class="col-md-3">
                    <label for="jenis" class="form-label small fw-semibold text-muted">Jenis Laporan</label>
                    <select name="jenis" id="jenis" class="form-select rounded-3 shadow-sm" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="masuk">Barang Masuk</option>
                        <option value="keluar">Barang Keluar</option>
                        <option value="mutasi">Mutasi (Masuk & Keluar)</option>
                    </select>
                </div>

                {{-- Lokasi --}}
                <div class="col-md-3">
                    <label for="lokasi_id" class="form-label small fw-semibold text-muted">Lokasi</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-select rounded-3 shadow-sm">
                        <option value="">Semua Lokasi</option>
                        @foreach($daftarLokasi as $lokasi)
                            <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                        @endforeach
                    </select>
                </div>


                {{-- Tombol Cetak --}}
                <div class="col-12 d-grid gap-2 mt-2">
                    

                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-printer me-1"></i> Cetak Laporan
                    </button>
                    <a href="{{ route('laporan.cetak') }}" target="_blank" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-printer-fill me-1"></i> Cetak Semua Data
                    </a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection
