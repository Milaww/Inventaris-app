@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary mb-4">Edit Unit Barang</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.unit.update', [$barang->id, $unit->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow-sm rounded-4 border-0 mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="kode_inventaris" class="form-label">Kode Inventaris</label>
                    <input type="text" class="form-control" id="kode_inventaris" name="kode_inventaris" value="{{ old('kode_inventaris', $unit->kode_inventaris) }}" required>
                </div>

                <div class="mb-3">
                    <label for="divisi_id" class="form-label">Divisi</label>
                    <select name="divisi_id" class="form-select" required>
                        <option value="" disabled>Pilih Divisi</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}" {{ $unit->divisi_id == $divisi->id ? 'selected' : '' }}>
                                {{ $divisi->nama_divisi }} - {{ $divisi->lokasi->nama_lokasi ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                        <label for="pic" class="form-label">PIC</label>
                        <input type="text" name="pic" id="pic" class="form-control" value="{{ old('pic', $unit->pic) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" value="{{ old('foto', $unit->foto) }}">
                    </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" {{ $unit->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="rusak" {{ $unit->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="dipinjam" {{ $unit->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
            <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
