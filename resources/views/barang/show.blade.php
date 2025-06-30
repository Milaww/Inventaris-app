@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary mb-4">Detail Barang</h2>

    <div class="card shadow rounded-4 border-0 mb-4">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $barang->nama_brg }}</p>
            <p><strong>Kategori:</strong> {{ $barang->kategori->nama_kategori ?? '-' }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Daftar Unit Barang</h4>
        <a href="{{ route('barang.unit.create', $barang->id) }}" class="btn btn-success shadow-sm">
            + Tambah Unit Barang
        </a>
    </div>

    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Inventaris</th>
                            <th>Status</th>
                            <th>Lokasi</th>
                            <th>PIC</th>
                            <th>Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang->unitBarangs as $unit)
                            <tr>
                                <td>{{ $unit->kode_inventaris }}</td>
                                <td>
                                    @php
                                        $statusColor = match($unit->status) {
                                            'aktif' => 'success',
                                            'dipinjam' => 'warning',
                                            'rusak' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">
                                        {{ ucfirst($unit->status) }}
                                    </span>
                                </td>

                                <td>{{ optional($unit->divisi)->nama_divisi }}  {{ $unit->lokasi->nama_lokasi }}</td>
                                <td>{{ $unit->pic ?? '-' }}</td>
                                <td>
                                    @if($unit->foto)
                                        
                                        <img src="{{ asset('storage/' . $unit->foto) }}"
                                            alt="Foto Unit"
                                            class="rounded"
                                            style="height: 50px; width: 50px; object-fit: cover; cursor: pointer;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#fotoModal{{ $unit->id }}">
                                        
                                        <!-- Modal untuk pop-up -->
                                        <div class="modal fade" id="fotoModal{{ $unit->id }}" tabindex="-1" aria-labelledby="fotoModalLabel{{ $unit->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/' . $unit->foto) }}" alt="Foto Unit Besar" class="img-fluid rounded">
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>


                                <td class="text-center">
                                    <a href="{{ route('barang.unit.edit', [$barang->id, $unit->id]) }}" class="btn btn-sm btn-outline-primary rounded-circle me-2" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('barang.unit.destroy', [$barang->id, $unit->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus unit ini?')" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada unit untuk barang ini.</td>
                            </tr>
                        @endforelse

                    </tbody>

                    
                </table>
            </div>
        </div>
    </div>

    <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-4">← Kembali</a>
</div>
@endsection
