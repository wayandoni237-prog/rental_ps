@extends('admin.layouts.admin')

@section('title', 'Edit User — PS Doni Galaxy')

@section('content')
<div class="mb-4 animate-fadeup">
    <a href="{{ route('admin.user') }}" class="ps-link"></a>
    <h3 class="ps-page-title mt-2">Edit <span class="ps-gradient-text">User</span></h3>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="ps-card animate-fadeup">
            <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="ps-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="ps-input @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $user->nama) }}" required>
                    @error('nama') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="ps-label">Username</label>
                    <input type="text" name="username" class="ps-input @error('username') is-invalid @enderror"
                        value="{{ old('username', $user->username) }}" required>
                    @error('username') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="ps-label">Email</label>
                    <input type="email" name="email" class="ps-input @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="ps-label">Role</label>
                    <select name="role" class="ps-input" required>
                        <option value="tamu" {{ (old('role', $user->role) == 'tamu') ? 'selected' : '' }}>Tamu</option>
                        <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="ps-label">Password Baru <span class="text-muted small">(kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="ps-input @error('password') is-invalid @enderror"
                        placeholder="Password baru">
                    @error('password') <div class="ps-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="d-flex gap-3">
                    <button type="submit" class="btn ps-btn-primary ps-btn-glow">
                        <i class="bi bi-save me-2"></i>Update User
                    </button>
                    <a href="{{ route('admin.user') }}" class="btn ps-btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection