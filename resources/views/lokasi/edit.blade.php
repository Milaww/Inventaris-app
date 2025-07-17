@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Lokasi</h4>
    <form action="{{ route('lokasi.update', $location) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Lokasi</label>
            <input type="text" name="name" class="form-control" value="{{ $lokasi>name }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
