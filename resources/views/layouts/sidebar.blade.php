<nav class="position-fixed start-0 top-0 vh-100 bg-white p-3 shadow-sm d-flex flex-column" style="width: 240px; z-index: 1030;">
    <h4 class="mb-4 fw-bold text-primary">
        <i class="bi bi-grid me-2"></i>Inventory Admin
    </h4>

    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark" href="{{ route('barang.index') }}">
                <i class="bi bi-box-seam me-2"></i> Data Barang
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark" href="{{ route('barang-masuk.index') }}">
                <i class="bi bi-box-arrow-in-down me-2"></i> Barang Masuk
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark" href="{{ route('barang-keluar.index') }}">
                <i class="bi bi-box-arrow-in-down me-2"></i> Barang Keluar
            </a>
        </li>
        {{-- Tambahan lainnya bisa di sini --}}
    </ul>

    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</nav>
