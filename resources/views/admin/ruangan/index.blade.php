@extends('admin.layouts.admin')

@section('title', 'Manajemen Ruangan — PS Doni Galaxy')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 animate-fadeup">
    <div>
        <h3 class="ps-page-title">Manajemen <span class="ps-gradient-text">Ruangan</span></h3>
        <p class="text-muted">Tambah, edit, dan kelola ruangan PS</p>
    </div>
    <a href="{{ route('admin.ruangan.tambah') }}" class="btn ps-btn-primary ps-btn-glow">
        <i class="bi bi-plus-lg me-2"></i>Tambah Ruangan
    </a>
</div>

<div class="row g-4">
    @forelse($ruangan as $room)
        <div class="col-md-6 col-xl-4 animate-fadeup">
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
                        @if($room->status == 'tersedia') Tersedia
                        @elseif($room->status == 'dipesan') Dipesan
                        @else Tidak Tersedia
                        @endif
                    </span>
                </div>
                <div class="ps-room-body">
                    <h5 class="ps-room-name">{{ $room->nama_ruangan }}</h5>
                    <p class="text-muted small">{{ Str::limit($room->deskripsi, 60) }}</p>
                    <div class="ps-room-price mb-3">
                        @if($room->harga_diskon)
                            <span class="ps-price-old">Rp {{ number_format($room->harga_normal, 0, ',', '.') }}</span>
                            <span class="ps-price-new">Rp {{ number_format($room->harga_diskon, 0, ',', '.') }}/jam</span>
                        @else
                            <span class="ps-price-new">Rp {{ number_format($room->harga_normal, 0, ',', '.') }}/jam</span>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.ruangan.edit', $room->id) }}" class="btn ps-btn-edit flex-fill">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.ruangan.hapus', $room->id) }}"
                            onsubmit="return confirm('Hapus ruangan ini?')" class="flex-fill">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn ps-btn-danger w-100">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="ps-empty-state">
                <i class="bi bi-door-open"></i>
                <p>Belum ada ruangan. <a href="{{ route('admin.ruangan.tambah') }}" class="ps-link">Tambah sekarang!</a></p>
            </div>
        </div>
    @endforelse
</div>
@endsection