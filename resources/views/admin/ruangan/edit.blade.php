@extends('admin.layouts.admin')

@section('title', 'Edit Ruangan — PS Doni Galaxy')

@section('content')
<div class="mb-4 animate-fadeup">
    <a href="{{ route('admin.ruangan') }}" class="ps-link">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
    <h3 class="ps-page-title mt-2">Edit <span class="ps-gradient-text">Ruangan</span></h3>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="ps-card animate-fadeup">
            <form method="POST" action="{{ route('admin.ruangan.update', $ruangan->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="ps-label">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="ps-input"
                            value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
                        @error('nama_ruangan')
                            <div class="ps-input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="ps-label">Kapasitas (orang)</label>
                        <input type="number" name="kapasitas" class="ps-input"
                            value="{{ old('kapasitas', $ruangan->kapasitas) }}" min="1" required>
                        @error('kapasitas')
                            <div class="ps-input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="ps-label">Deskripsi</label>
                        <textarea name="deskripsi" class="ps-input" rows="3"
                            placeholder="Deskripsi ruangan...">{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="ps-label">Harga Normal (Rp/jam)</label>
                        <input type="number" name="harga_normal" class="ps-input"
                            value="{{ old('harga_normal', $ruangan->harga_normal) }}"
                            placeholder="Contoh: 200000" min="0" required>
                        @error('harga_normal')
                            <div class="ps-input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="ps-label">
                            Harga Diskon (Rp/jam)
                            <span class="text-muted small">opsional</span>
                        </label>
                        <input type="number" name="harga_diskon" class="ps-input"
                            value="{{ old('harga_diskon', $ruangan->harga_diskon) }}"
                            placeholder="Contoh: 150000" min="0">
                    </div>

                    <div class="col-md-4">
                        <label class="ps-label">
                            Persen Diskon (%)
                            <span class="text-muted small">opsional</span>
                        </label>
                        <input type="number" name="persen_diskon" class="ps-input"
                            value="{{ old('persen_diskon', $ruangan->persen_diskon) }}"
                            placeholder="Contoh: 25" min="0" max="100">
                    </div>

                    <div class="col-md-6">
                        <label class="ps-label">Status</label>
                        <select name="status" class="ps-input" required>
                            <option value="tersedia"
                                {{ old('status', $ruangan->status) == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>
                            <option value="dipesan"
                                {{ old('status', $ruangan->status) == 'dipesan' ? 'selected' : '' }}>
                                Dipesan
                            </option>
                            <option value="tidak_tersedia"
                                {{ old('status', $ruangan->status) == 'tidak_tersedia' ? 'selected' : '' }}>
                                Tidak Tersedia
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="ps-label">
                            Foto Baru
                            <span class="text-muted small">opsional</span>
                        </label>
                        <input type="file" name="foto" class="ps-input" accept="image/*">

                        {{-- Foto yang sudah ada --}}
                        @if($ruangan->foto)
                            <div class="ps-foto-current mt-2">
                                <img src="{{ asset('storage/' . $ruangan->foto) }}"
                                    alt="{{ $ruangan->nama_ruangan }}"
                                    class="ps-foto-preview-img">
                                <p class="text-muted small mt-1 mb-0">
                                    <i class="bi bi-image me-1"></i>Foto saat ini.
                                    Upload foto baru untuk mengganti.
                                </p>
                            </div>
                        @else
                            <p class="text-muted small mt-1 mb-0">
                                <i class="bi bi-image me-1"></i>Belum ada foto.
                            </p>
                        @endif
                    </div>

                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn ps-btn-primary ps-btn-glow">
                        <i class="bi bi-save me-2"></i>Update Ruangan
                    </button>
                    <a href="{{ route('admin.ruangan') }}" class="btn ps-btn-outline">
                        <i class="bi bi-x me-1"></i>Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection