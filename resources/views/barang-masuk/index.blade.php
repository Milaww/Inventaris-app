@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary mb-4">Daftar Barang Masuk</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
    @endif

    {{-- Filter Modern & Rapi --}}
    <form method="GET" class="row row-cols-lg-auto g-2 align-items-end mb-4">
        <div class="col">
            <label class="form-label small mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="form-control form-control-sm rounded-3" value="{{ request('tanggal') }}">
        </div>
        <div class="col">
            <label class="form-label small mb-1">Status</label>
            <select name="status" class="form-select form-select-sm rounded-3">
                <option value="">Semua</option>
                @foreach($daftarStatus as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label class="form-label small mb-1">Lokasi</label>
            <select name="lokasi_id" class="form-select form-select-sm rounded-3">
                <option value="">Semua</option>
                @foreach($daftarLokasi as $lokasi)
                    <option value="{{ $lokasi->id }}" {{ request('lokasi_id') == $lokasi->id ? 'selected' : '' }}>
                        {{ $lokasi->nama_lokasi }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label class="form-label small mb-1">Kategori</label>
            <select name="kategori_id" class="form-select form-select-sm rounded-3">
                <option value="">Semua</option>
                @foreach($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label class="form-label small mb-1">Cari</label>
            <input type="text" name="q" class="form-control form-control-sm rounded-3" placeholder="Cari barang..." value="{{ request('q') }}">
        </div>
        <div class="col-auto d-flex gap-2 align-items-end">
            <button class="btn btn-sm btn-primary rounded-3 px-3" type="submit">Filter</button>
            @if(request()->hasAny(['tanggal', 'status', 'lokasi_id', 'kategori_id', 'q']))
                <a href="{{ route('barang-masuk.index') }}" class="btn btn-sm btn-outline-secondary rounded-3" title="Reset Filter">
                    <i class="bi bi-x-circle"></i>
                </a>
            @endif
        </div>
    </form>

    {{-- Tabel Barang Masuk --}}
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
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangMasuks as $index => $masuk)
                            <tr>
                                <td>{{ $barangMasuks->firstItem() + $index }}</td>
                                <td>{{ $masuk->barang->nama_brg ?? '-' }}</td>
                                <td>{{ $masuk->barang->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $masuk->unitBarang->kode_inventaris ?? '-' }}</td>
                                <td>{{ $masuk->unitBarang->lokasi->nama_lokasi ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $masuk->unitBarang->status === 'rusak' ? 'danger' : ($masuk->unitBarang->status === 'dipinjam' ? 'warning text-dark' : 'success') }}">
                                        {{ ucfirst($masuk->unitBarang->status ?? '-') }}
                                    </span>
                                </td>
                                <td>{{ $masuk->unitBarang->created_at ? $masuk->unitBarang->created_at->format('d-m-Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data barang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $barangMasuks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
