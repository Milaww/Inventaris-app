@extends('layouts.guest')

@section('content')
<style>
    body {
        background-color: #1c0f13;
    }

    .left-panel {
        background: linear-gradient(135deg, #3b0a18, #640d14);
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
        {{-- Kiri: Branding --}}
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center left-panel">
            <h1 class="fw-bold mb-3">Buat Akun Baru</h1>
            <p class="text-center" style="max-width: 70%;">
                Daftarkan akun Anda untuk mulai mengelola inventaris dengan mudah, cepat, dan aman.
            </p>
            {{-- <img src="{{ asset('images/register.svg') }}" alt="Register" class="img-fluid mt-4" style="max-height: 250px;"> --}}
        </div>

        {{-- Kanan: Form --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center right-panel px-5">
            <div class="w-100" style="max-width: 400px;">
                <h3 class="text-center fw-bold text-danger mb-4">Create Account</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input id="name" type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required autofocus 
                               placeholder="Enter your full name" autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required 
                               placeholder="Enter your email" autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required 
                               placeholder="Create a password" autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" 
                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                               name="password_confirmation" required 
                               placeholder="Re-enter your password" autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary rounded-pill">
                            Register
                        </button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted">Already have an account?</span>
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            Log in here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
