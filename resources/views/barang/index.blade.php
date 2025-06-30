{{-- filepath: c:\xampp\htdocs\inventory\resources\views\barang\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Daftar Jenis Barang</h2>
    </div>

    <div class="card shadow rounded-4 border-0">
        <div class="card-body p-4">

            <form method="GET" action="{{ route('barang.index') }}">
                <div class="row mb-4 align-items-end">
                    <div class="col-md-4">
                        <label for="kategori" class="form-label fw-semibold">Filter Kategori</label>
                        <select name="kategori" id="kategori" class="form-select shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="q" class="form-label fw-semibold">Pencarian Barang</label>
                        <div class="input-group shadow-sm">
                            <input type="text" name="q" id="q" class="form-control" placeholder="Cari nama barang..." value="{{ request('q') }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex flex-column mt-2 mt-md-0">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('barang.create') }}" class="btn btn-success w-100">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Barang
                            </a>
                            <a href="{{ route('barang.unit.create') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-box-seam me-1"></i> Tambah Unit
                            </a>
                        </div>

                        @if(request('kategori') || request('q'))
                            <a href="{{ route('barang.index') }}" class="btn btn-link text-muted text-decoration-none mx-auto small">
                                <i class="bi bi-x-circle"></i> Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </form>



            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah Unit</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                            <tr>
                                <td class="fw-medium">{{ $barang->nama_brg }}</td>
                                <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                                <td><span class="badge bg-primary">{{ $barang->unit_barangs_count }}</span></td>
                
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- Detail -->
                                        {{-- <a href="{{ route('barang.show', $barang->id) }}"
                                        class="btn btn-sm btn-outline-info rounded-pill px-3">
                                            <i class="bi bi-eye"></i> Detail
                                        </a> --}}

                                        <!-- Edit -->
                                        <a href="{{ route('barang.show', $barang->id) }}"
                                        class="btn btn-sm btn-outline-warning rounded-pill px-3 ms-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline ms-1"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
