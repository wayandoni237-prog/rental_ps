<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — PS Galaxy')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ps-style.css') }}">
    @stack('styles')
</head>
<body class="ps-admin-body">

<div class="d-flex" style="min-height:100vh">

    {{-- SIDEBAR DESKTOP (lg ke atas) --}}
    <nav class="ps-sidebar d-none d-lg-flex flex-column" id="sidebarDesktop">
        <div class="ps-sidebar-brand">
            <i class="bi bi-controller me-2"></i>PS<span>Galaxy</span>
            <small class="d-block" style="font-size:.62rem;letter-spacing:2px;opacity:.45;font-family:'Exo 2',sans-serif">ADMIN PANEL</small>
        </div>
        <div class="ps-sidebar-user">
            <div class="ps-sidebar-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
            <div>
                <p class="mb-0 text-white small fw-semibold">{{ Auth::user()->nama }}</p>
                <span class="text-warning" style="font-size:.68rem">
                    <i class="bi bi-shield-fill-check me-1"></i>Administrator
                </span>
            </div>
        </div>
        <ul class="ps-sidebar-nav">
            <li class="ps-sidebar-label">Menu Utama</li>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="ps-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="ps-sidebar-label mt-3">Manajemen</li>
            <li>
                <a href="{{ route('admin.user') }}"
                    class="ps-sidebar-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ruangan') }}"
                    class="ps-sidebar-link {{ request()->routeIs('admin.ruangan*') ? 'active' : '' }}">
                    <i class="bi bi-door-open"></i> Manajemen Ruangan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.booking') }}"
                    class="ps-sidebar-link {{ request()->routeIs('admin.booking*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i> Manajemen Booking
                </a>
            </li>
            <li class="ps-sidebar-label mt-3">Navigasi</li>
            <li>
                <a href="{{ route('beranda') }}" class="ps-sidebar-link" target="_blank">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
        </ul>
        <div class="ps-sidebar-footer mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ps-sidebar-logout w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- OFFCANVAS MOBILE (di bawah lg) --}}
    <div class="offcanvas offcanvas-start ps-offcanvas" tabindex="-1" id="sidebarMobile">
        <div class="offcanvas-header border-bottom border-secondary pb-3">
            <div class="ps-sidebar-brand mb-0">
                <i class="bi bi-controller me-2"></i>PS<span>Galaxy</span>
                <small class="d-block" style="font-size:.62rem;letter-spacing:2px;opacity:.45;font-family:'Exo 2',sans-serif">ADMIN PANEL</small>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0 d-flex flex-column">
            <div class="ps-sidebar-user">
                <div class="ps-sidebar-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                <div>
                    <p class="mb-0 text-white small fw-semibold">{{ Auth::user()->nama }}</p>
                    <span class="text-warning" style="font-size:.68rem">
                        <i class="bi bi-shield-fill-check me-1"></i>Administrator
                    </span>
                </div>
            </div>
            <ul class="ps-sidebar-nav flex-grow-1">
                <li class="ps-sidebar-label">Menu Utama</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="ps-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="ps-sidebar-label mt-3">Manajemen</li>
                <li>
                    <a href="{{ route('admin.user') }}"
                        class="ps-sidebar-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.ruangan') }}"
                        class="ps-sidebar-link {{ request()->routeIs('admin.ruangan*') ? 'active' : '' }}">
                        <i class="bi bi-door-open"></i> Manajemen Ruangan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.booking') }}"
                        class="ps-sidebar-link {{ request()->routeIs('admin.booking*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i> Manajemen Booking
                    </a>
                </li>
                <li class="ps-sidebar-label mt-3">Navigasi</li>
                <li>
                    <a href="{{ route('beranda') }}" class="ps-sidebar-link" target="_blank">
                        <i class="bi bi-globe"></i> Lihat Website
                    </a>
                </li>
            </ul>
            <div class="ps-sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ps-sidebar-logout w-100">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="ps-admin-main flex-grow-1">

        {{-- TOP HEADER --}}
        <header class="ps-admin-header">
            <div class="d-flex align-items-center gap-2">
                {{-- Hamburger: hanya muncul di mobile --}}
                <button class="btn ps-btn-icon d-lg-none"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMobile"
                    title="Menu">
                    <i class="bi bi-list fs-5"></i>
                </button>
                {{-- Collapse desktop: hanya muncul di desktop --}}
                <button class="btn ps-btn-icon d-none d-lg-inline-flex"
                    onclick="document.getElementById('sidebarDesktop').classList.toggle('d-none');document.querySelector('.ps-admin-main').classList.toggle('sidebar-collapsed')"
                    title="Toggle Sidebar">
                    <i class="bi bi-layout-sidebar fs-5"></i>
                </button>
                <button onclick="history.back()" class="btn ps-btn-back-admin">
                    <i class="bi bi-arrow-left me-1"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </button>
            </div>

            <div class="ms-auto d-flex align-items-center gap-2">
                <span class="text-muted small d-none d-xl-block">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </span>
                <div class="dropdown">
                    <button class="btn ps-user-badge dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i>
                        <span class="d-none d-sm-inline">{{ Auth::user()->nama }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end ps-dropdown">
                        <li>
                            <span class="dropdown-item-text text-warning small">
                                <i class="bi bi-shield-check me-1"></i>Administrator
                            </span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('beranda') }}" target="_blank">
                                <i class="bi bi-globe me-2"></i>Lihat Website
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="ps-admin-content p-3 p-md-4">
            @if(session('success'))
                <div class="alert ps-alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert ps-alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>