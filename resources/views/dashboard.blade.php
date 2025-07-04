@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <h2 class="fw-bold text-primary mb-4">Dashboard Inventaris</h2>
    {{-- Statistik Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow rounded-4 bg-white">
                <div class="card-body text-center">
                    <div class="text-muted small mb-1">Total Barang</div>
                    <h4 class="fw-bold text-primary">{{ $totalBarang }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow rounded-4 bg-white">
                <div class="card-body text-center">
                    <div class="text-muted small mb-1">Unit Tersedia</div>
                    <h4 class="fw-bold text-success">{{ $unitTersedia }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow rounded-4 bg-white">
                <div class="card-body text-center">
                    <div class="text-muted small mb-1">Unit Rusak</div>
                    <h4 class="fw-bold text-danger">{{ $unitRusak }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow rounded-4 bg-white">
                <div class="card-body text-center">
                    <div class="text-muted small mb-1">Total Unit</div>
                    <h4 class="fw-bold text-secondary">{{ $unitTotal }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi Cepat --}}
    <div class="mb-4">
        <h5 class="fw-semibold mb-3 text-secondary">Navigasi Cepat</h5>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('barang.create') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-plus-lg me-1"></i> Tambah Barang
            </a>
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary rounded-pill">
                <i class="bi bi-box me-1"></i> Lihat Barang
            </a>
            <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-success rounded-pill">
                <i class="bi bi-box-arrow-in-down me-1"></i> Barang Masuk
            </a>
            <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-warning text-dark rounded-pill">
                <i class="bi bi-box-arrow-up me-1"></i> Barang Keluar
            </a>
            <a href="{{ route('laporan.index') }}" class="btn btn-outline-info rounded-pill">
                <i class="bi bi-file-earmark-text me-1"></i> Laporan
            </a>
        </div>
    </div>

    {{-- Recent Unit Table --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-secondary">Unit Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Inventaris</th>
                            <th>Barang</th>
                            <th>Status</th>
                            <th>Lokasi</th>
                            <th>Ditambahkan</th>
                            <th>Diupdate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unitTerbaru as $unit)
                            <tr>
                                <td>{{ $unit->kode_inventaris }}</td>
                                <td>{{ $unit->barang->nama_brg ?? '-' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($unit->status === 'rusak') bg-danger
                                        @elseif($unit->status === 'dipinjam') bg-warning text-dark
                                        @else bg-success
                                        @endif">
                                        {{ ucfirst($unit->status) }}
                                    </span>
                                </td>
                                <td>{{ $unit->lokasi->nama_lokasi ?? '-' }}</td>
                                <td>{{ $unit->created_at->format('d M Y') }}</td>
                                <td>{{ $unit->updated_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada unit barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Mutasi Terbaru --}}
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-header bg-gradient bg-info text-white fw-semibold rounded-top-4">
            Mutasi Terbaru
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse($mutasiTerbaru as $mutasi)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $mutasi['nama_barang'] }}</strong><br>
                                <small class="text-muted">Kode: {{ $mutasi['kode_inventaris'] }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $mutasi['tipe'] === 'masuk' ? 'primary' : 'danger' }}">
                                    {{ ucfirst($mutasi['tipe']) }}
                                </span>
                                <div><small class="text-muted">{{ $mutasi['tanggal']->format('d/m/Y') }}</small></div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Belum ada mutasi.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
