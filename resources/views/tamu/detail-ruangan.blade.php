@extends('layouts.app')

@section('title', $ruangan->nama_ruangan . ' — PS Galaxy')

@section('content')
<div class="ps-dashboard-bg py-5">
    <div class="container">

        {{-- TOMBOL KEMBALI --}}
        <div class="d-flex align-items-center gap-3 mb-4 animate-fadeup">
            <a href="{{ route('tamu.ruangan') }}" class="ps-btn-back" title="Kembali ke Daftar Ruangan">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ps-breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('tamu.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tamu.ruangan') }}">Ruangan</a></li>
                    <li class="breadcrumb-item active">{{ $ruangan->nama_ruangan }}</li>
                </ol>
            </nav>
        </div>

        <div class="row g-5">
            <div class="col-lg-6 animate-fadeup">
                <div class="ps-detail-img">
                    @if($ruangan->foto)
                        <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama_ruangan }}">
                    @else
                        <div class="ps-room-img-placeholder" style="height:380px;border-radius:16px">
                            <i class="bi bi-controller" style="font-size:5rem"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 animate-fadeup" style="animation-delay:.15s">
                <span class="ps-room-badge ps-badge-{{ $ruangan->status }} mb-3 d-inline-block" style="position:static">
                    @if($ruangan->status == 'tersedia') ✅ Tersedia
                    @elseif($ruangan->status == 'dipesan') 🔒 Sedang Dipesan
                    @else ❌ Tidak Tersedia
                    @endif
                </span>

                <h2 class="ps-page-title">{{ $ruangan->nama_ruangan }}</h2>
                <p class="text-muted mb-4">{{ $ruangan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                <div class="ps-detail-info mb-4">
                    <div class="ps-detail-info-item">
                        <i class="bi bi-people text-info"></i>
                        <span>Kapasitas: <strong class="text-white">{{ $ruangan->kapasitas }} orang</strong></span>
                    </div>
                    <div class="ps-detail-info-item">
                        <i class="bi bi-clock text-info"></i>
                        <span>Harga dihitung per jam</span>
                    </div>
                </div>

                <div class="ps-room-price mb-4">
                    @if($ruangan->harga_diskon)
                        <div class="mb-1">
                            <span class="ps-price-old fs-5">Rp {{ number_format($ruangan->harga_normal, 0, ',', '.') }}</span>
                            @if($ruangan->persen_diskon)
                                <span class="ps-badge-diskon ms-2">-{{ $ruangan->persen_diskon }}% OFF</span>
                            @endif
                        </div>
                        <span class="ps-price-new" style="font-size:1.8rem">
                            Rp {{ number_format($ruangan->harga_diskon, 0, ',', '.') }}
                            <small style="font-size:1rem">/jam</small>
                        </span>
                    @else
                        <span class="ps-price-new" style="font-size:1.8rem">
                            Rp {{ number_format($ruangan->harga_normal, 0, ',', '.') }}
                            <small style="font-size:1rem">/jam</small>
                        </span>
                    @endif
                </div>

                <div class="d-flex flex-column gap-3">
                    @if($ruangan->isTersedia())
                        <a href="{{ route('tamu.booking', $ruangan->id) }}" class="btn ps-btn-primary btn-lg ps-btn-glow">
                            <i class="bi bi-calendar-plus me-2"></i>Booking Ruangan Ini
                        </a>
                    @else
                        <button class="btn ps-btn-disabled btn-lg" disabled>
                            <i class="bi bi-lock me-2"></i>Ruangan Tidak Tersedia
                        </button>
                    @endif
                    <a href="{{ route('tamu.ruangan') }}" class="btn ps-btn-outline btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Ruangan
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection