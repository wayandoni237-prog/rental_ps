@extends('layouts.app')

@section('title', 'Booking Saya — PS Galaxy')

@section('content')
<div class="ps-dashboard-bg py-5">
    <div class="container">

        {{-- HEADER + KEMBALI --}}
        <div class="d-flex align-items-center gap-3 mb-2 animate-fadeup">
            <a href="{{ route('tamu.dashboard') }}" class="ps-btn-back" title="Kembali ke Dashboard">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <div>
                <h2 class="ps-page-title mb-0">Booking <span class="ps-gradient-text">Saya</span></h2>
                <p class="text-muted small mb-0">Riwayat dan status semua booking Anda</p>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="mb-4 animate-fadeup">
            <ol class="breadcrumb ps-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('tamu.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Booking Saya</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-end mb-4 animate-fadeup">
            <a href="{{ route('tamu.ruangan') }}" class="btn ps-btn-primary ps-btn-glow">
                <i class="bi bi-plus-lg me-2"></i>Booking Baru
            </a>
        </div>

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

        @forelse($bookings as $booking)
            <div class="ps-booking-card mb-3 animate-fadeup">
                <div class="row align-items-center g-3">
                    <div class="col-md-2 text-center">
                        @if($booking->ruangan && $booking->ruangan->foto)
                            <img src="{{ asset('storage/' . $booking->ruangan->foto) }}"
                                class="rounded" style="width:80px;height:70px;object-fit:cover" alt="">
                        @else
                            <div class="ps-room-img-placeholder" style="width:80px;height:70px;border-radius:8px;margin:auto">
                                <i class="bi bi-controller" style="font-size:1.5rem"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-white mb-1">{{ $booking->ruangan->nama_ruangan ?? 'Ruangan Dihapus' }}</h6>
                        <p class="text-muted small mb-1">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ \Carbon\Carbon::parse($booking->tanggal_booking)->isoFormat('dddd, D MMMM Y') }}
                        </p>
                        <p class="text-muted small mb-0">
                            <i class="bi bi-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                            <span class="ms-1">({{ $booking->durasi_jam }} jam)</span>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class="text-muted small mb-1">Total Bayar</p>
                        <p class="ps-price-new mb-0">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <span class="ps-status ps-status-{{ $booking->status }}">
                            @if($booking->status == 'pending') ⏳ Pending
                            @elseif($booking->status == 'dikonfirmasi') ✅ Dikonfirmasi
                            @elseif($booking->status == 'dibatalkan') ❌ Dibatalkan
                            @else 🏁 Selesai
                            @endif
                        </span>
                        @if($booking->catatan)
                            <p class="text-muted mt-1 mb-0" style="font-size:.7rem">
                                <i class="bi bi-chat-text me-1"></i>{{ Str::limit($booking->catatan, 30) }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-2 text-end">
                        @if($booking->status === 'pending')
                            <form method="POST" action="{{ route('tamu.booking.cancel', $booking->id) }}"
                                onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                @csrf
                                <button type="submit" class="btn ps-btn-danger btn-sm w-100">
                                    <i class="bi bi-x-circle me-1"></i>Batalkan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="ps-empty-state mt-4 animate-fadeup">
                <i class="bi bi-calendar-x"></i>
                <p class="mb-3">Anda belum memiliki booking.</p>
                <a href="{{ route('tamu.ruangan') }}" class="btn ps-btn-primary ps-btn-glow">
                    <i class="bi bi-controller me-2"></i>Booking Sekarang
                </a>
            </div>
        @endforelse

    </div>
</div>
@endsection