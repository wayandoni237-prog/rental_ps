@extends('layouts.app')

@section('title', 'Beranda — PS Doni Galaxy Rental')

@section('content')

{{-- HERO SECTION --}}
<section class="ps-hero ps-hero-bg">
    <div class="ps-hero-overlay"></div>
    <div class="ps-particles"></div>

    <div class="container position-relative">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7">

                <div class="ps-hero-badge mb-3 animate-fadeup ps-delay-1">
                    <i class="bi bi-star-fill me-2 text-warning"></i>#1 Rental PS Premium di Bali
                </div>

                <h1 class="ps-hero-title animate-fadeup ps-delay-2">
                    Selamat Datang di<br>
                    <span class="ps-gradient-text">PS Doni Galaxy</span>
                </h1>

                <p class="ps-hero-desc animate-fadeup ps-delay-3">
                    Rasakan pengalaman gaming yang sesungguhnya! Kami menyediakan ruangan PS5 & PS4 eksklusif dengan layar 4K, kursi gaming ergonomis, dan suasana yang nyaman. Booking mudah, harga terjangkau!
                </p>

                <div class="d-flex flex-wrap gap-3 animate-fadeup ps-delay-4">
                    @auth
                        <a href="{{ route('tamu.ruangan') }}" class="btn ps-btn-primary btn-lg ps-btn-glow">
                            <i class="bi bi-controller me-2"></i>Lihat Ruangan
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn ps-btn-primary btn-lg ps-btn-glow">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="btn ps-btn-outline btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>

    <div class="ps-hero-scroll-hint">
        <i class="bi bi-chevron-double-down"></i>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="ps-stats-section py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <div class="col-6 col-md-3">
                <div class="ps-stat-card text-center animate-fadeup">
                    <div class="ps-stat-icon"><i class="bi bi-controller"></i></div>
                    <h3 class="ps-stat-num">15+</h3>
                    <p class="ps-stat-label">Unit PlayStation</p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="ps-stat-card text-center animate-fadeup ps-delay-1">
                    <div class="ps-stat-icon"><i class="bi bi-people"></i></div>
                    <h3 class="ps-stat-num">500+</h3>
                    <p class="ps-stat-label">Member Aktif</p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="ps-stat-card text-center animate-fadeup ps-delay-2">
                    <div class="ps-stat-icon"><i class="bi bi-star"></i></div>
                    <h3 class="ps-stat-num">4.9</h3>
                    <p class="ps-stat-label">Rating Pelanggan</p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="ps-stat-card text-center animate-fadeup ps-delay-3">
                    <div class="ps-stat-icon"><i class="bi bi-clock-history"></i></div>
                    <h3 class="ps-stat-num">16</h3>
                    <p class="ps-stat-label">Jam Operasional</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- FITUR SECTION --}}
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <span class="ps-section-badge">Kenapa Pilih Kami?</span>
            <h2 class="ps-section-title mt-2">Fasilitas <span class="ps-gradient-text">Premium</span></h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="ps-feature-card h-100 animate-fadeup">
                    <div class="ps-feature-icon"><i class="bi bi-display"></i></div>
                    <h5>Layar 4K Ultra HD</h5>
                    <p class="text-muted small">Nikmati visual gaming yang memukau dengan monitor/TV 4K terbaru di setiap ruangan.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ps-feature-card h-100 animate-fadeup ps-delay-1">
                    <div class="ps-feature-icon"><i class="bi bi-volume-up"></i></div>
                    <h5>Sound System Dolby</h5>
                    <p class="text-muted small">Audio imersif dengan speaker Dolby Atmos untuk pengalaman gaming total.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ps-feature-card h-100 animate-fadeup ps-delay-2">
                    <div class="ps-feature-icon"><i class="bi bi-wind"></i></div>
                    <h5>AC & Ruangan Nyaman</h5>
                    <p class="text-muted small">Ruangan ber-AC dengan kursi gaming premium agar Anda betah berlama-lama.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ps-feature-card h-100 animate-fadeup ps-delay-1">
                    <div class="ps-feature-icon"><i class="bi bi-wifi"></i></div>
                    <h5>Internet Cepat</h5>
                    <p class="text-muted small">Koneksi fiber optic 1 Gbps untuk online gaming tanpa lag.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ps-feature-card h-100 animate-fadeup ps-delay-2">
                    <div class="ps-feature-icon"><i class="bi bi-shield-check"></i></div>
                    <h5>Aman & Terpercaya</h5>
                    <p class="text-muted small">CCTV 24 jam, staf profesional, dan sistem booking terenkripsi untuk keamanan Anda.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ps-feature-card h-100 animate-fadeup ps-delay-3">
                    <div class="ps-feature-icon"><i class="bi bi-calendar-check"></i></div>
                    <h5>Booking Online Mudah</h5>
                    <p class="text-muted small">Pesan ruangan kapan saja dan di mana saja melalui sistem booking online kami.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="ps-cta-section py-5 my-5">
    <div class="container text-center">
        <h2 class="ps-section-title mb-3">Siap Untuk <span class="ps-gradient-text">Gaming?</span></h2>
        <p class="text-muted mb-4">Daftar sekarang dan nikmati promo member baru!</p>
        @guest
            <a href="{{ route('register') }}" class="btn ps-btn-primary btn-lg ps-btn-glow me-3">
                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn ps-btn-outline btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sudah Punya Akun
            </a>
        @else
            <a href="{{ route('tamu.ruangan') }}" class="btn ps-btn-primary btn-lg ps-btn-glow">
                <i class="bi bi-controller me-2"></i>Booking Sekarang
            </a>
        @endguest
    </div>
</section>

@endsection