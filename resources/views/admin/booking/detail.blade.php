@extends('admin.layouts.admin')

@section('title', 'Detail Booking — PS Doni Galaxy')

@section('content')
<div class="mb-4 animate-fadeup">
    <a href="{{ route('admin.booking') }}" class="ps-link"></a>
    <h3 class="ps-page-title mt-2">Detail <span class="ps-gradient-text">Booking</span> #{{ $booking->id }}</h3>
</div>

<div class="row g-4">
    {{-- INFO BOOKING --}}
    <div class="col-lg-8 animate-fadeup">
        <div class="ps-card mb-4">
            <h5 class="ps-card-title mb-4"><i class="bi bi-calendar-check me-2"></i>Informasi Booking</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="text-muted small mb-1">Tanggal Booking</p>
                    <p class="text-white fw-semibold">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('l, d F Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="text-muted small mb-1">Waktu</p>
                    <p class="text-white fw-semibold">{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</p>
                <div class="col-md-6">
                    <p class="text-muted small mb-1">Total Harga</p>
                    <p class="ps-price-new fs-5">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="text-muted small mb-1">Status Saat Ini</p>
                    <span class="ps-status ps-status-{{ $booking->status }} fs-6">{{ ucfirst($booking->status) }}</span>
                </div>
                @if($booking->catatan)
                    <div class="col-12">
                        <p class="text-muted small mb-1">Catatan dari Tamu</p>
                        <p class="text-white">{{ $booking->catatan }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- UPDATE STATUS --}}
        <div class="ps-card animate-fadeup" style="animation-delay:.1s">
            <h5 class="ps-card-title mb-4"><i class="bi bi-arrow-repeat me-2"></i>Update Status Booking</h5>
            <form method="POST" action="{{ route('admin.booking.status', $booking->id) }}">
                @csrf @method('PUT')
                <div class="d-flex gap-3 align-items-end">
                    <div class="flex-grow-1">
                        <label class="ps-label">Status Baru</label>
                        <select name="status" class="ps-input" required>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dikonfirmasi" {{ $booking->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="dibatalkan" {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn ps-btn-primary ps-btn-glow">
                        <i class="bi bi-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- INFO TAMU & RUANGAN --}}
    <div class="col-lg-4">
        <div class="ps-card mb-4 animate-fadeup">
            <h5 class="ps-card-title mb-3"><i class="bi bi-person me-2"></i>Data Tamu</h5>
            <p class="text-white fw-bold mb-1">{{ $booking->user->nama ?? '-' }}</p>
            <p class="text-muted small mb-1"><i class="bi bi-at me-1"></i>{{ $booking->user->username ?? '-' }}</p>
            <p class="text-muted small mb-0"><i class="bi bi-envelope me-1"></i>{{ $booking->user->email ?? '-' }}</p>
        </div>
        <div class="ps-card animate-fadeup" style="animation-delay:.1s">
            <h5 class="ps-card-title mb-3"><i class="bi bi-door-open me-2"></i>Data Ruangan</h5>
            @if($booking->ruangan && $booking->ruangan->foto)
                <img src="{{ asset('storage/' . $booking->ruangan->foto) }}" alt="" class="w-100 rounded mb-3" style="height:120px;object-fit:cover">
            @endif
            <p class="text-white fw-bold mb-1">{{ $booking->ruangan->nama_ruangan ?? 'Ruangan Dihapus' }}</p>
            <div class="ps-room-price">
                @if($booking->ruangan && $booking->ruangan->harga_diskon)
                    <span class="ps-price-old">Rp {{ number_format($booking->ruangan->harga_normal, 0, ',', '.') }}</span>
                    <span class="ps-price-new">Rp {{ number_format($booking->ruangan->harga_diskon, 0, ',', '.') }}/jam</span>
                @elseif($booking->ruangan)
                    <span class="ps-price-new">Rp {{ number_format($booking->ruangan->harga_normal, 0, ',', '.') }}/jam</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection