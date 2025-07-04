@extends('layouts.app')

@section('pageTitle', 'Daftar Barang Keluar')
@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-danger mb-4">Daftar Barang Keluar</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
    @endif

    {{-- Filter Minimalis --}}
    <form method="GET" class="row g-3 align-items-end mb-4">
    <div class="col-md-3">
        <label class="form-label mb-1">Tanggal Keluar</label>
        <input type="date" name="tanggal" class="form-control form-control-sm rounded-3" value="{{ request('tanggal') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label mb-1">Lokasi</label>
        <select name="lokasi_id" class="form-select form-select-sm rounded-3">
            <option value="">Semua</option>
            @foreach($daftarLokasi as $lokasi)
                <option value="{{ $lokasi->id }}" {{ request('lokasi_id') == $lokasi->id ? 'selected' : '' }}>
                    {{ $lokasi->nama_lokasi }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label mb-1">Cari</label>
        <input type="text" name="q" class="form-control form-control-sm rounded-3" placeholder="Cari barang..." value="{{ request('q') }}">
    </div>
    <div class="col-md-2 d-flex gap-2">
        <button class="btn btn-sm btn-danger rounded-3 w-100" type="submit">Filter</button>

        @if(request()->hasAny(['tanggal', 'lokasi_id', 'q']))
        <a href="{{ route('barang-keluar.index') }}" class="btn btn-sm btn-outline-secondary rounded-3" title="Reset Filter">
            <i class="bi bi-x-circle"></i>
        </a>
        @endif
    </div>
</form>


    {{-- Tabel Barang Keluar --}}
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Kode Inventaris</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unitRusak as $index => $unit)
                        <tr>
                            <td>{{ $unitRusak->FirstItem() + $index }}</td>
                            <td>{{ $unit->barang->nama_brg ?? '-' }}</td>
                            <td>{{ $unit->barang->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $unit->kode_inventaris ?? '-' }}</td>
                            <td>{{ $unit->lokasi->nama_lokasi ?? '-' }}</td>
                            <td>
                                <span class="badge bg-danger">Rusak</span>
                            </td>
                            <td>{{ $unit->updated_at ? $unit->updated_at->format('d-m-Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data barang rusak.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="p-3">
                {{ $unitRusak->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
