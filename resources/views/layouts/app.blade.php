<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PS Doni Galaxy — Rental PS Premium')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ps-style.css') }}">
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ps-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand ps-brand" href="{{ route('beranda') }}">
            <i class="bi bi-controller me-2"></i>PS<span>Doni Galaxy</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beranda') }}">
                        <i class="bi bi-house me-1"></i>Beranda
                    </a>
                </li>
                @auth
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard Admin
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tamu.dashboard') }}">
                                <i class="bi bi-grid me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tamu.ruangan') }}">
                                <i class="bi bi-door-open me-1"></i>Ruangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tamu.my-bookings') }}">
                                <i class="bi bi-calendar-check me-1"></i>Booking Saya
                            </a>
                        </li>
                    @endif

                    {{-- USER DROPDOWN --}}
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle ps-user-badge" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end ps-dropdown">
                            <li>
                                <span class="dropdown-item-text text-muted small px-3 py-1">
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @if(!Auth::user()->isAdmin())
                                <li>
                                    <a class="dropdown-item" href="{{ route('tamu.dashboard') }}">
                                        <i class="bi bi-grid me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('tamu.my-bookings') }}">
                                        <i class="bi bi-calendar-check me-2"></i>Booking Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-2">
                        <a class="btn ps-btn-outline" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn ps-btn-primary" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="ps-footer mt-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h5 class="ps-brand mb-3"><i class="bi bi-controller me-2"></i>PS<span>DoniGalaxy</span></h5>
                <p class="text-muted small">Rental PlayStation premium dengan fasilitas terbaik. Nikmati pengalaman gaming yang tak terlupakan bersama kami.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white mb-3">Jam Operasional</h6>
                <p class="text-muted small mb-1"><i class="bi bi-clock me-2"></i>Senin – Jumat: 09.00 – 23.00</p>
                <p class="text-muted small mb-1"><i class="bi bi-clock me-2"></i>Sabtu – Minggu: 08.00 – 01.00</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white mb-3">Kontak</h6>
                <p class="text-muted small mb-1"><i class="bi bi-telephone me-2"></i>+62 812-3456-7890</p>
                <p class="text-muted small mb-1"><i class="bi bi-envelope me-2"></i>info@psgalaxy.id</p>
                <p class="text-muted small"><i class="bi bi-geo-alt me-2"></i>Jl. Babakan no 1,Badung</p>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="text-center text-muted small py-2">© {{ date('Y') }} PSDoniGalaxy.AllDoni.</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>