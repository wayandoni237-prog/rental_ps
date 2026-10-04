@extends('layouts.app')

@section('title', 'Dashboard — PS Galaxy')

@section('content')
<div class="ps-dashboard-bg py-5">
    <div class="container">

        {{-- HEADER --}}
        <div class="ps-dashboard-header mb-4 animate-fadeup">
            <div>
                <h2 class="ps-page-title">
                    Halo, <span class="ps-gradient-text">{{ Auth::user()->nama }}</span>! 👋
                </h2>
                <p class="text-muted mb-0">Selamat datang di dashboard Anda. Yuk booking ruangan PS hari ini!</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('tamu.ruangan') }}" class="btn ps-btn-primary ps-btn-glow">
                    <i class="bi bi-controller me-2"></i>Booking Sekarang
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn ps-btn-logout">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
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

        {{-- STAT CARDS --}}
        <div class="row g-4 mb-5">
            <div class="col-6 col-md-3">
                <div class="ps-dash-stat animate-fadeup">
                    <div class="ps-dash-stat-icon blue"><i class="bi bi-calendar2-check"></i></div>
                    <div>
                        <p class="ps-dash-stat-label">Total Booking</p>
                        <h4 class="ps-dash-stat-val">{{ $myBookings->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="ps-dash-stat animate-fadeup" style="animation-delay:.1s">
                    <div class="ps-dash-stat-icon yellow"><i class="bi bi-hourglass-split"></i></div>
                    <div>
                        <p class="ps-dash-stat-label">Pending</p>
                        <h4 class="ps-dash-stat-val">{{ $myBookings->where('status','pending')->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="ps-dash-stat animate-fadeup" style="animation-delay:.2s">
                    <div class="ps-dash-stat-icon green"><i class="bi bi-check-circle"></i></div>
                    <div>
                        <p class="ps-dash-stat-label">Dikonfirmasi</p>
                        <h4 class="ps-dash-stat-val">{{ $myBookings->where('status','dikonfirmasi')->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="ps-dash-stat animate-fadeup" style="animation-delay:.3s">
                    <div class="ps-dash-stat-icon red"><i class="bi bi-x-circle"></i></div>
                    <div>
                        <p class="ps-dash-stat-label">Dibatalkan</p>
                        <h4 class="ps-dash-stat-val">{{ $myBookings->where('status','dibatalkan')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- RUANGAN TERSEDIA --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="ps-section-title-sm">
                    Ruangan <span class="ps-gradient-text">Tersedia</span>
                </h4>
                <a href="{{ route('tamu.ruangan') }}" class="ps-link">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-4">
                @forelse($ruangan->where('status','tersedia')->take(3) as $room)
                    <div class="col-md-4 animate-fadeup">
                        <div class="ps-room-card h-100">
                            <div class="ps-room-img">
                                @if($room->foto)
                                    <img src="{{ asset('storage/' . $room->foto) }}" alt="{{ $room->nama_ruangan }}">
                                @else
                                    <div class="ps-room-img-placeholder">
                                        <i class="bi bi-controller"></i>
                                    </div>
                                @endif
                                <span class="ps-room-badge ps-badge-tersedia">✅ Tersedia</span>
                            </div>
                            <div class="ps-room-body">
                                <h5 class="ps-room-name">{{ $room->nama_ruangan }}</h5>
                                <p class="text-muted small">{{ Str::limit($room->deskripsi, 60) }}</p>
                                <div class="ps-room-price mb-2">
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
                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('tamu.detail-ruangan', $room->id) }}" class="btn ps-btn-outline flex-fill btn-sm">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                    <a href="{{ route('tamu.booking', $room->id) }}" class="btn ps-btn-primary flex-fill btn-sm ps-btn-glow">
                                        <i class="bi bi-calendar-plus me-1"></i>Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="ps-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada ruangan tersedia saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- BOOKING TERBARU --}}
        <div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="ps-section-title-sm">
                    Booking <span class="ps-gradient-text">Terbaru</span>
                </h4>
                <a href="{{ route('tamu.my-bookings') }}" class="ps-link">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @if($myBookings->count() > 0)
                <div class="ps-table-wrap">
                    <table class="table ps-table">
                        <thead>
                            <tr>
                                <th>Ruangan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($myBookings->take(5) as $booking)
                                <tr>
                                    <td>{{ $booking->ruangan->nama_ruangan ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td>
                                    <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="ps-status ps-status-{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="ps-empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <p>Anda belum memiliki booking.
                        <a href="{{ route('tamu.ruangan') }}" class="ps-link">Booking sekarang!</a>
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection