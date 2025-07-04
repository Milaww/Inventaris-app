<nav class="position-fixed top-0 start-0 bg-white border-end shadow-sm d-flex flex-column justify-between" style="width: 240px; height: 100vh; z-index: 1030;">
    {{-- Header --}}
    <div class="p-4 border-bottom">
        <h5 class="fw-bold mb-1 d-flex align-items-center text-primary">
            <i class="bi bi-layers me-2 fs-4"></i> Inventaris
        </h5>
        <small class="text-muted">Admin Panel</small>
    </div>

    {{-- Menu --}}
    <ul class="nav flex-column p-3 gap-2 flex-grow-1">
        @php
            $menus = [
                ['route' => 'dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard'],
                ['route' => 'barang.index', 'icon' => 'bi-box-seam', 'label' => 'Data Barang'],
                ['route' => 'barang-masuk.index', 'icon' => 'bi-box-arrow-in-down', 'label' => 'Barang Masuk'],
                ['route' => 'barang-keluar.index', 'icon' => 'bi-box-arrow-up', 'label' => 'Barang Keluar'],
                ['route' => 'laporan.index', 'icon' => 'bi-file-earmark-text', 'label' => 'Laporan'],
            ];
        @endphp

        @foreach ($menus as $menu)
            <li>
                <a href="{{ route($menu['route']) }}" class="nav-link d-flex align-items-center rounded px-3 py-2 {{ request()->routeIs($menu['route']) ? 'bg-light text-primary fw-semibold' : 'text-dark' }}">
                    <i class="bi {{ $menu['icon'] }} me-2 fs-5"></i> {{ $menu['label'] }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- User & Logout --}}
    <div class="border-top p-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle fs-4 text-secondary"></i>
            <div>
                <large class="text-dark d-block">{{ Auth::user()->name ?? 'Admin' }}</large>
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-link text-danger p-0" style="font-size: 12px;">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
