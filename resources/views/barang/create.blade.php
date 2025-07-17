@extends('layouts.app')

@section('pageTitle', 'Tambah Barang & Unit')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-semibold text-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Barang & Unit
    </h2>

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

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_brg" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_brg" name="nama_brg" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori_id" name="kategori_id" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3 fw-bold text-secondary">
                    <i class="bi bi-hdd-network me-2"></i>Unit Barang
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode_inventaris" class="form-label">Kode Inventaris</label>
                        <input type="text" class="form-control" id="kode_inventaris" name="kode_inventaris" required>
                    </div>

                    <div class="col-md-6">
                        <label for="lokasi_id" class="form-label">Lokasi</label>
                        <select name="lokasi_id" id="lokasi_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Lokasi</option>
                            @foreach($lokasis as $lokasi)
                                <option value="{{ $lokasi->id }}">
                                    {{ $lokasi->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pic" class="form-label">PIC</label>
                        <input type="text" class="form-control" id="pic" name="pic" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="rusak">Rusak</option>
                            <option value="dipinjam">Dipinjam</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Tambah Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
