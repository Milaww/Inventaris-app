@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Lokasi Baru</h4>
    <form action="{{ route('lokasi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Lokasi</label>
            <input type="text" name="nama_lokasi" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
