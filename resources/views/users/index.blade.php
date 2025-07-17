@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Manajemen User</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Tambah User</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
