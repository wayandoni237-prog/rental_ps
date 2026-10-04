@extends('layouts.app')

@section('title', 'Daftar Ruangan — PS Galaxy')

@section('content')
<div class="ps-dashboard-bg py-5">
    <div class="container">

        {{-- HEADER + TOMBOL KEMBALI --}}
        <div class="d-flex align-items-center gap-3 mb-2 animate-fadeup">
            <a href="{{ route('tamu.dashboard') }}" class="ps-btn-back" title="Kembali ke Dashboard">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <h2 class="ps-page-title mb-0">Daftar <span class="ps-gradient-text">Ruangan</span></h2>
                <p class="text-muted small mb-0">Pilih ruangan terbaik untuk sesi gaming Anda</p>
            </div>
        </div>

        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-4 animate-fadeup">
            <ol class="breadcrumb ps-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tamu.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Ruangan</li>
            </ol>
        </nav>

        {{-- FILTER PAKAI CSS :target — TANPA JS --}}
        {{-- Target anchor tersembunyi --}}
        <div id="filter-all"></div>
        <div id="filter-tersedia"></div>
        <div id="filter-dipesan"></div>

        <div class="ps-filter-wrap d-flex gap-2 mb-4 flex-wrap animate-fadeup">
            <a href="#filter-all" class="btn ps-btn-filter ps-filter-btn" id="btn-all">
                <i class="bi bi-grid me-1"></i>Semua
            </a>
            <a href="#filter-tersedia" class="btn ps-btn-filter ps-filter-btn" id="btn-tersedia">
                <i class="bi bi-circle-fill me-1 text-success ps-dot"></i>Tersedia
            </a>
            <a href="#filter-dipesan" class="btn ps-btn-filter ps-filter-btn" id="btn-dipesan">
                <i class="bi bi-circle-fill me-1 text-warning ps-dot"></i>Dipesan
            </a>
        </div>

        {{-- SEMUA RUANGAN --}}
        <div class="ps-ruangan-grid row g-4" id="ruanganContainer">
            @forelse($ruangan as $room)
                <div class="col-md-6 col-lg-4 animate-fadeup ps-room-item ps-status-item-{{ $room->status }}">
                    <div class="ps-room-card h-100">
                        <div class="ps-room-img">
                            @if($room->foto)
                                <img src="{{ asset('storage/' . $room->foto) }}" alt="{{ $room->nama_ruangan }}">
                            @else
                                <div class="ps-room-img-placeholder">
                                    <i class="bi bi-controller"></i>
                                </div>
                            @endif
                            <span class="ps-room-badge ps-badge-{{ $room->status }}">
                                @if($room->status == 'tersedia') ✅ Tersedia
                                @elseif($room->status == 'dipesan') 🔒 Dipesan
                                @else ❌ Tidak Tersedia
                                @endif
                            </span>
                        </div>
                        <div class="ps-room-body">
                            <h5 class="ps-room-name">{{ $room->nama_ruangan }}</h5>
                            <p class="text-muted small mb-2">{{ Str::limit($room->deskripsi, 75) }}</p>
                            <div class="d-flex align-items-center gap-2 mb-3 text-muted small">
                                <i class="bi bi-people text-info"></i>
                                <span>Kapasitas: <strong class="text-white">{{ $room->kapasitas }} orang</strong></span>
                            </div>
                            <div class="ps-room-price mb-3">
                                @if($room->harga_diskon)
                                    <div>
                                        <span class="ps-price-old">Rp {{ number_format($room->harga_normal, 0, ',', '.') }}</span>
                                        @if($room->persen_diskon)
                                            <span class="ps-badge-diskon ms-1">-{{ $room->persen_diskon }}%</span>
                                        @endif
                                    </div>
                                    <span class="ps-price-new">Rp {{ number_format($room->harga_diskon, 0, ',', '.') }}/jam</span>
                                @else
                                    <span class="ps-price-new">Rp {{ number_format($room->harga_normal, 0, ',', '.') }}/jam</span>
                                @endif
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('tamu.detail-ruangan', $room->id) }}" class="btn ps-btn-outline flex-fill">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                                @if($room->isTersedia())
                                    <a href="{{ route('tamu.booking', $room->id) }}" class="btn ps-btn-primary flex-fill ps-btn-glow">
                                        <i class="bi bi-calendar-plus me-1"></i>Booking
                                    </a>
                                @else
                                    <button class="btn ps-btn-disabled flex-fill" disabled>
                                        <i class="bi bi-lock me-1"></i>Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="ps-empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada ruangan tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection