@extends('admin.layouts.admin')

@section('title', 'Tambah User — PS Doni Galaxy')

@section('content')
<div class="mb-4 animate-fadeup">
    <a href="{{ route('admin.user') }}" class="ps-link"></a>
    <h3 class="ps-page-title mt-2">Tambah <span class="ps-gradient-text">User</span></h3>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="ps-card animate-fadeup">
            <form method="POST" action="{{ route('admin.user.simpan') }}">
                @csrf
                <div class="mb-3">
                    <label class="ps-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="ps-input @error('nama') is-invalid @enderror"
                        placeholder="Nama lengkap" value="{{ old('nama') }}" required>
                    @error('nama') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="ps-label">Username</label>
                    <input type="text" name="username" class="ps-input @error('username') is-invalid @enderror"
                        placeholder="Username" value="{{ old('username') }}" required>
                    @error('username') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="ps-label">Email</label>
                    <input type="email" name="email" class="ps-input @error('email') is-invalid @enderror"
                        placeholder="Email" value="{{ old('email') }}" required>
                    @error('email') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="ps-label">Password</label>
                    <input type="password" name="password" class="ps-input @error('password') is-invalid @enderror"
                        placeholder="Password" required>
                    @error('password') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="ps-label">Role</label>
                    <select name="role" class="ps-input" required>
                        <option value="tamu" {{ old('role') == 'tamu' ? 'selected' : '' }}>Tamu</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="d-flex gap-3">
                    <button type="submit" class="btn ps-btn-primary ps-btn-glow">
                        <i class="bi bi-person-check me-2"></i>Simpan User
                    </button>
                    <a href="{{ route('admin.user') }}" class="btn ps-btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection