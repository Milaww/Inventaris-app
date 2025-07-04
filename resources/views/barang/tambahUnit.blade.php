@extends('layouts.app')

@section('pageTitle', 'Tambah Unit Barang')
@section('content')
<div class="container mt-3">
    <h5 class="mb-3">
        <i class="bi bi-plus-circle text-primary"></i> Tambah Unit Barang
    </h5>
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('barang.unit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <!-- Barang -->
                    <div class="col-md-6">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select name="barang_id" id="barang_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">
                                    {{ $barang->nama_brg }} - ({{ $barang->kategori->nama_kategori }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Divisi -->
                    <div class="col-md-6">
                        <label for="divisi_id" class="form-label">Divisi</label>
                        <select name="divisi_id" id="divisi_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Divisi</option>
                            @foreach($divisis as $divisi)
                                <option value="{{ $divisi->id }}">
                                    {{ $divisi->nama_divisi }} - ({{ $divisi->lokasi->nama_lokasi }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <h6><i class="bi bi-hdd-stack"></i> Unit Barang</h6>

                <div class="row mb-3">
                    <!-- Kode Inventaris -->
                    <div class="col-md-6">
                        <label for="kode_inventaris" class="form-label">Kode Inventaris</label>
                        <input type="text" name="kode_inventaris" id="kode_inventaris" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pic" class="form-label">PIC</label>
                        <input type="text" name="pic" id="pic" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="rusak">Rusak</option>
                            <option value="dipinjam">Dipinjam</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">← Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Tambah Unit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
