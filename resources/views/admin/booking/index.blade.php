@extends('admin.layouts.admin')

@section('title', 'Manajemen Booking — PS Doni Galaxy')

@section('content')
<div class="mb-4 animate-fadeup">
    <h3 class="ps-page-title">Manajemen <span class="ps-gradient-text">Booking</span></h3>
    <p class="text-muted">Lihat dan kelola semua booking ruangan</p>
</div>

{{-- FILTER --}}
<div class="d-flex gap-2 mb-4 flex-wrap animate-fadeup">
    <button class="btn ps-btn-filter active" onclick="filterBooking(this,'all')">
        Semua ({{ $bookings->count() }})
    </button>
    <button class="btn ps-btn-filter" onclick="filterBooking(this,'pending')">
        Pending ({{ $bookings->where('status','pending')->count() }})
    </button>
    <button class="btn ps-btn-filter" onclick="filterBooking(this,'dikonfirmasi')">
        Dikonfirmasi ({{ $bookings->where('status','dikonfirmasi')->count() }})
    </button>
    <button class="btn ps-btn-filter" onclick="filterBooking(this,'dibatalkan')">
        Dibatalkan ({{ $bookings->where('status','dibatalkan')->count() }})
    </button>
    <button class="btn ps-btn-filter" onclick="filterBooking(this,'selesai')">
        Selesai ({{ $bookings->where('status','selesai')->count() }})
    </button>
</div>

<div class="ps-card animate-fadeup">
    @if($bookings->count() > 0)
    <div class="ps-table-wrap">
        <table class="table ps-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tamu</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Durasi</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $i => $booking)
                <tr class="booking-row" data-status="{{ $booking->status }}">
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div style="color:#fff;font-weight:600;font-size:.9rem">
                            {{ $booking->user->nama ?? '-' }}
                        </div>
                        <div style="color:#64748b;font-size:.75rem">
                            {{ $booking->user->email ?? '' }}
                        </div>
                    </td>
                    <td style="color:#e2e8f0">{{ $booking->ruangan->nama_ruangan ?? '-' }}</td>
                    <td style="color:#e2e8f0">
                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                    </td>
                   <td style="color:#e2e8f0">
                     {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} – 
                     {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td>
                    <td style="color:#e2e8f0">{{ $booking->durasi_jam }} jam</td>
                    <td style="color:#10b981;font-weight:700">
                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="ps-status ps-status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.booking.detail', $booking->id) }}"
                            class="btn ps-btn-icon-sm" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="ps-empty-state">
            <i class="bi bi-calendar-x"></i>
            <p>Belum ada data booking.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function filterBooking(btn, status) {
    document.querySelectorAll('.ps-btn-filter').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.booking-row').forEach(row => {
        row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
    });
}
</script>
@endpush