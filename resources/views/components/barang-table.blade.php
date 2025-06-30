@extends('layouts.app')
@section('content')
<div class="table-responsive">
    <h2>Data Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">+ Tambah Barang</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table id="barangTables" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NOMOR INVENTARIS</th>
                <th>NAMA BARANG</th>
                <th>POSISI</th>
                <th>PIC</th>
                <th>KETERANGAN</th>
                <th>FOTO BARANG</th>
                <th>tanggal ditambah</th>
                <th>tanggal diupdate</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $barang->kode_brg }}</td>
                <td>{{ $barang->nama_brg }}</td>
                <td>{{ $barang->kategori }}</td>
                <td>{{ $barang->stok }}</td>
                <td>{{ $barang->harga }}</td>
                <td>
                    @if ($barang->foto_barang)
                        <img src="{{ asset('storage/foto_barang/' . $barang->foto_barang) }}" width="80">
                    @else
                        Tidak ada foto
                    @endif
                </td>
                <td>{{ $barang->created_at }}</td>
                <td>{{ $barang->updated_at }}</td>
                <td>
                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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