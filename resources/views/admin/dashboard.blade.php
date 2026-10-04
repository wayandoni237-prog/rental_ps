@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin — PS Doni Galaxy')

@section('content')

<div class="mb-4 animate-fadeup">
    <h3 class="ps-page-title">Dashboard <span class="ps-gradient-text">Admin</span></h3>
    <p class="text-muted">Selamat datang kembali, {{ Auth::user()->nama }}!</p>
</div>

{{-- STAT CARDS --}}
<div class="row g-4 mb-5">
    <div class="col-6 col-xl-3">
        <div class="ps-admin-stat-card animate-fadeup">
            <div class="ps-admin-stat-icon blue"><i class="bi bi-people-fill"></i></div>
            <div>
                <p class="ps-dash-stat-label">Total Tamu</p>
                <h3 class="ps-dash-stat-val">{{ $totalUser }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="ps-admin-stat-card animate-fadeup" style="animation-delay:.1s">
            <div class="ps-admin-stat-icon purple"><i class="bi bi-shield-check"></i></div>
            <div>
                <p class="ps-dash-stat-label">Total Admin</p>
                <h3 class="ps-dash-stat-val">{{ $totalAdmin }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="ps-admin-stat-card animate-fadeup" style="animation-delay:.2s">
            <div class="ps-admin-stat-icon green"><i class="bi bi-door-open-fill"></i></div>
            <div>
                <p class="ps-dash-stat-label">Total Ruangan</p>
                <h3 class="ps-dash-stat-val">{{ $totalRuangan }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="ps-admin-stat-card animate-fadeup" style="animation-delay:.3s">
            <div class="ps-admin-stat-icon yellow"><i class="bi bi-calendar-check-fill"></i></div>
            <div>
                <p class="ps-dash-stat-label">Total Booking</p>
                <h3 class="ps-dash-stat-val">{{ $totalBooking }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- STATUS RUANGAN --}}
<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="ps-card animate-fadeup">
            <h5 class="ps-card-title mb-4">Status Ruangan</h5>
            <div class="d-flex gap-4">
                <div class="text-center">
                    <div class="ps-circle-stat green">{{ $ruanganTersedia }}</div>
                    <p class="text-muted small mt-2">Tersedia</p>
                </div>
                <div class="text-center">
                    <div class="ps-circle-stat yellow">{{ $ruanganDipesan }}</div>
                    <p class="text-muted small mt-2">Dipesan</p>
                </div>
                <div class="text-center">
                    <div class="ps-circle-stat gray">{{ $totalRuangan - $ruanganTersedia - $ruanganDipesan }}</div>
                    <p class="text-muted small mt-2">Tidak Tersedia</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ps-card animate-fadeup" style="animation-delay:.1s">
            <h5 class="ps-card-title mb-3">Aksi Cepat</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.ruangan.tambah') }}" class="btn ps-btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Ruangan
                </a>
                <a href="{{ route('admin.user.tambah') }}" class="btn ps-btn-outline btn-sm">
                    <i class="bi bi-person-plus me-1"></i>Tambah User
                </a>
                <a href="{{ route('admin.booking') }}" class="btn ps-btn-outline btn-sm">
                    <i class="bi bi-calendar-check me-1"></i>Lihat Booking
                </a>
            </div>
        </div>
    </div>
</div>

{{-- BOOKING TERBARU --}}
<div class="ps-card animate-fadeup">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="ps-card-title">Booking Terbaru</h5>
        <a href="{{ route('admin.booking') }}" class="ps-link small">Lihat Semua</a>
    </div>
    @if($bookingTerbaru->count() > 0)
        <div class="ps-table-wrap">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>Tamu</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookingTerbaru as $booking)
                        <tr>
                            <td>
                                <div class="fw-semibold text-white small">{{ $booking->user->nama ?? '-' }}</div>
                                <div class="text-muted" style="font-size:.75rem">{{ $booking->user->username ?? '' }}</div>
                            </td>
                            <td>{{ $booking->ruangan->nama_ruangan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</td>
                            <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="ps-status ps-status-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.booking.detail', $booking->id) }}" class="btn ps-btn-icon-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="ps-empty-state"><i class="bi bi-inbox"></i><p>Belum ada booking.</p></div>
    @endif
</div>

@endsection