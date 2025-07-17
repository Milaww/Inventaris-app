@extends('layouts.guest')

@section('content')
<style>
    body {
        background-color: #1c0f13; /* Very dark red-black */
    }

    .left-panel {
        background: linear-gradient(135deg, #3b0a18, #640d14); /* Deep red */
        color: #fff;
    }

    .right-panel {
        background-color: #1c0f13;
        color: #fff;
    }

    .form-control,
    .form-check-input {
        background-color: #2a1419;
        border: 1px solid #641e16;
        color: #fff;
    }

    .form-control::placeholder {
        color: #c7bcbc;
    }

    .form-control:focus {
        background-color: #2a1419;
        color: #fff;
        border-color: #a93226;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #a93226;
        border: none;
    }

    .btn-primary:hover {
        background-color: #922b21;
    }

    a {
        color: #e6b0aa;
    }

    a:hover {
        color: #f5b7b1;
    }
</style>

<div class="container-fluid vh-100">
    <div class="row h-100">
        {{-- Panel Kiri --}}
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center left-panel">
            <h1 class="fw-bold mb-3">Aplikasi Inventaris</h1>
            <p class="text-center" style="max-width: 70%;">
                Kelola dan pantau data barang secara efisien dan real-time dengan tampilan profesional dan terstruktur.
            </p>
            {{-- <img src="{{ asset('images/inventory.svg') }}" alt="Inventory" class="img-fluid mt-4" style="max-height: 250px;"> --}}
        </div>

        {{-- Panel Kanan (Login Form) --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center right-panel px-5">
            <div class="w-100" style="max-width: 400px;">
                <h3 class="text-center fw-bold text-danger mb-4">Login Admin</h3>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus 
                               placeholder="Masukkan email" autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required 
                               placeholder="Masukkan password" autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Ingat saya</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if (Route::has('password.request'))
                            <a class="small" href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill">
                            Masuk
                        </button>
                    </div>

                    {{-- <div class="text-center mt-4">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}">Daftar di sini</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
