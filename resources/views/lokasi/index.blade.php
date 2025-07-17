@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Manajemen Lokasi Cabang</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('lokasi.create') }}" class="btn btn-primary mb-3">Tambah Lokasi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lokasi as $lokasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lokasi->nama_lokasi }}</td>
                    <td>
                        <a href="{{ route('lokasi.edit', $lokasi) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('lokasi.destroy', $lokasi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
