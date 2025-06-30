<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <aside class="col-md-2 vh-100 position-fixed bg-white shadow-sm p-3" style="z-index: 1030;">
            <h4 class="mb-4 fw-bold text-primary">
                <i class="bi bi-grid me-2"></i>Inventory Admin
            </h4>

            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active fw-semibold text-primary' : 'text-dark' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->is('barang*') ? 'active fw-semibold text-primary' : 'text-dark' }}" href="{{ route('barang.index') }}">
                        <i class="bi bi-box-seam me-2"></i> Data Barang
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->is('barang-masuk*') ? 'active fw-semibold text-primary' : 'text-dark' }}" href="{{ route('barang-masuk.index') }}">
                        <i class="bi bi-box-arrow-in-down me-2"></i> Barang Masuk
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->is('barang-keluar*') ? 'active fw-semibold text-primary' : 'text-dark' }}" href="{{ route('barang-keluar.index') }}">
                        <i class="bi bi-box-arrow-up me-2"></i> Barang Keluar
                    </a>
                </li>
            </ul>

            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </aside>

        {{-- Main Content --}}
        <main class="col-md-10 offset-md-2 p-4">
            <div class="container mt-4">
                <h2 class="fw-bold text-primary mb-4">Dashboard Inventaris</h2>

                {{-- Cards Statistik --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Barang</h6>
                                <h4 class="fw-bold text-warning">{{ $totalBarang }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Unit Tersedia</h6>
                                <h4 class="fw-bold text-success">{{ $unitTersedia }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Unit Rusak</h6>
                                <h4 class="fw-bold text-danger">{{ $unitRusak }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Unit</h6>
                                <h4 class="fw-bold text-warning">{{ $unitTotal }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Navigasi Cepat --}}
                <div class="mb-4">
                    <h5 class="fw-semibold mb-3">Navigasi Cepat</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('barang.create') }}" class="btn btn-outline-primary">+ Tambah Barang</a>
                        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">📦 Lihat Barang</a>
                        <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-success">⬅ Barang Masuk</a>
                        <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-danger">➡ Barang Keluar</a>
                    </div>
                </div>

                {{-- Daftar Unit Terbaru --}}
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3"> Recent Unit</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Inventaris</th>
                                        <th>Barang</th>
                                        <th>Status</th>
                                        <th>Lokasi</th>
                                        <th>Ditambahkan</th>
                                        <th>Di update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($unitTerbaru as $unit)
                                        <tr>
                                            <td>{{ $unit->kode_inventaris }}</td>
                                            <td>{{ $unit->barang->nama_brg ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $unit->status === 'rusak' ? 'danger' : ($unit->status === 'dipinjam' ? 'warning text-dark' : 'success') }}">
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
                <div class="card shadow-sm rounded-4 border-0 mt-4">
                    <div class="card-header bg-info text-white fw-semibold">
                        Mutasi Terbaru
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($mutasiTerbaru as $mutasi)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $mutasi['nama_barang'] }}</strong> <br>
                                            <small>Kode: {{ $mutasi['kode_inventaris'] }}</small>
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
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
