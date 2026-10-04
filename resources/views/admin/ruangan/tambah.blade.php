@extends('admin.layouts.admin')

@section('title', 'Tambah Ruangan — PS Doni Galaxy')

@section('content')
<div class="mb-4 animate-fadeup">
    <a href="{{ route('admin.ruangan') }}" class="ps-link"></a>
    <h3 class="ps-page-title mt-2">Tambah <span class="ps-gradient-text">Ruangan</span></h3>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="ps-card animate-fadeup">
            <form method="POST" action="{{ route('admin.ruangan.simpan') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="ps-label">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="ps-input @error('nama_ruangan') is-invalid @enderror"
                            placeholder="Contoh: Room PS5 VIP A" value="{{ old('nama_ruangan') }}" required>
                        @error('nama_ruangan') <div class="ps-input-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="ps-label">Kapasitas (orang)</label>
                        <input type="number" name="kapasitas" class="ps-input @error('kapasitas') is-invalid @enderror"
                            placeholder="Misal: 4" value="{{ old('kapasitas', 2) }}" min="1" required>
                        @error('kapasitas') <div class="ps-input-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="ps-label">Deskripsi</label>
                        <textarea name="deskripsi" class="ps-input" rows="3"
                            placeholder="Deskripsi ruangan...">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="ps-label">Harga Normal (Rp/jam)</label>
                        <input type="number" name="harga_normal" class="ps-input @error('harga_normal') is-invalid @enderror"
                            placeholder="200000" value="{{ old('harga_normal') }}" min="0" required>
                        @error('harga_normal') <div class="ps-input-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="ps-label">Harga Diskon (Rp/jam) <span class="text-muted small">opsional</span></label>
                        <input type="number" name="harga_diskon" class="ps-input @error('harga_diskon') is-invalid @enderror"
                            placeholder="150000" value="{{ old('harga_diskon') }}" min="0">
                        @error('harga_diskon') <div class="ps-input-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="ps-label">Persen Diskon (%) <span class="text-muted small">opsional</span></label>
                        <input type="number" name="persen_diskon" class="ps-input"
                            placeholder="25" value="{{ old('persen_diskon') }}" min="0" max="100">
                    </div>
                    <div class="col-md-6">
                        <label class="ps-label">Status</label>
                        <select name="status" class="ps-input" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak_tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="ps-label">Foto Ruangan <span class="text-muted small">opsional</span></label>
                        <input type="file" name="foto" class="ps-input" accept="image/*" onchange="previewFoto(this)">
                        <img id="fotoPreview" src="" alt="" class="mt-2 rounded d-none" style="max-height:150px">
                    </div>
                </div>
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn ps-btn-primary ps-btn-glow">
                        <i class="bi bi-save me-2"></i>Simpan Ruangan
                    </button>
                    <a href="{{ route('admin.ruangan') }}" class="btn ps-btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewFoto(input) {
    const preview = document.getElementById('fotoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush