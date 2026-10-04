@extends('layouts.app')

@section('title', 'Booking ' . $ruangan->nama_ruangan . ' — PS Galaxy')

@section('content')
<div class="ps-dashboard-bg py-5">
    <div class="container">

        {{-- TOMBOL KEMBALI --}}
        <div class="d-flex align-items-center gap-3 mb-4 animate-fadeup">
            <a href="{{ route('tamu.detail-ruangan', $ruangan->id) }}" class="ps-btn-back" title="Kembali ke Detail Ruangan">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ps-breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('tamu.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tamu.ruangan') }}">Ruangan</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tamu.detail-ruangan', $ruangan->id) }}">{{ $ruangan->nama_ruangan }}</a></li>
                    <li class="breadcrumb-item active">Booking</li>
                </ol>
            </nav>
        </div>

        <div class="row g-5">
            {{-- FORM BOOKING --}}
            <div class="col-lg-7 animate-fadeup">
                <div class="ps-card">
                    <h4 class="ps-card-title mb-4">
                        <i class="bi bi-calendar-plus me-2 ps-gradient-text"></i>Form Booking
                    </h4>

                    @if($errors->any())
                        <div class="alert ps-alert-danger mb-4">
                            <ul class="mb-0 ps-0" style="list-style:none">
                                @foreach($errors->all() as $err)
                                    <li><i class="bi bi-exclamation-circle me-2"></i>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tamu.booking.store', $ruangan->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="ps-label">Tanggal Booking</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-calendar3"></i></span>
                                <input type="date" name="tanggal_booking" class="ps-input"
                                    min="{{ date('Y-m-d') }}" value="{{ old('tanggal_booking') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="ps-label">Jam Mulai</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-clock"></i></span>
                                <input type="time" name="jam_mulai" class="ps-input"
                                    value="{{ old('jam_mulai') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="ps-label">Durasi (Jam)</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-hourglass-split"></i></span>
                                <input type="number" name="durasi_jam" id="durasi" class="ps-input"
                                    min="1" max="12" value="{{ old('durasi_jam', 1) }}" required oninput="hitungTotal()">
                            </div>
                            <small class="text-muted">Minimal 1 jam — Maksimal 12 jam</small>
                        </div>
                        <div class="mb-4">
                            <label class="ps-label">Catatan (Opsional)</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon" style="top:.75rem;align-self:flex-start"><i class="bi bi-chat-text"></i></span>
                                <textarea name="catatan" class="ps-input" rows="3"
                                    placeholder="Catatan tambahan...">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        {{-- TOTAL HARGA PREVIEW --}}
                        <div class="ps-total-preview mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Harga per jam</span>
                                <span class="text-white">Rp {{ number_format($ruangan->harga_diskon ?? $ruangan->harga_normal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="text-muted small">Durasi</span>
                                <span class="text-white" id="previewDurasi">1 jam</span>
                            </div>
                            <hr class="border-secondary my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-white">Total Bayar</span>
                                <span class="ps-price-new fs-5" id="previewTotal">
                                    Rp {{ number_format($ruangan->harga_diskon ?? $ruangan->harga_normal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <button type="submit" class="btn ps-btn-primary btn-lg ps-btn-glow w-100">
                                <i class="bi bi-check-circle me-2"></i>Konfirmasi Booking
                            </button>
                            <a href="{{ route('tamu.detail-ruangan', $ruangan->id) }}" class="btn ps-btn-outline w-100">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Detail Ruangan
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFO RUANGAN --}}
            <div class="col-lg-5 animate-fadeup" style="animation-delay:.15s">
                <div class="ps-card">
                    <h5 class="ps-card-title mb-3">
                        <i class="bi bi-door-open me-2"></i>Info Ruangan
                    </h5>
                    @if($ruangan->foto)
                        <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama_ruangan }}"
                            class="w-100 rounded mb-3" style="height:200px;object-fit:cover">
                    @else
                        <div class="ps-room-img-placeholder mb-3" style="height:150px;border-radius:10px">
                            <i class="bi bi-controller" style="font-size:3rem"></i>
                        </div>
                    @endif
                    <h5 class="text-white">{{ $ruangan->nama_ruangan }}</h5>
                    <p class="text-muted small mb-3">{{ $ruangan->deskripsi }}</p>
                    <div class="d-flex align-items-center gap-2 mb-3 text-muted small">
                        <i class="bi bi-people text-info"></i>
                        <span>Kapasitas: <strong class="text-white">{{ $ruangan->kapasitas }} orang</strong></span>
                    </div>
                    <div class="ps-room-price">
                        @if($ruangan->harga_diskon)
                            <span class="ps-price-old">Rp {{ number_format($ruangan->harga_normal, 0, ',', '.') }}</span>
                            <span class="ps-price-new ms-2">Rp {{ number_format($ruangan->harga_diskon, 0, ',', '.') }}/jam</span>
                        @else
                            <span class="ps-price-new">Rp {{ number_format($ruangan->harga_normal, 0, ',', '.') }}/jam</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
const hargaPerJam = {{ $ruangan->harga_diskon ?? $ruangan->harga_normal }};
function hitungTotal() {
    const durasi = parseInt(document.getElementById('durasi').value) || 1;
    const total  = hargaPerJam * durasi;
    document.getElementById('previewDurasi').textContent = durasi + ' jam';
    document.getElementById('previewTotal').textContent  = 'Rp ' + total.toLocaleString('id-ID');
}
</script>
@endpush