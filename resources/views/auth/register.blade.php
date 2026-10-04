@extends('layouts.app')

@section('title', 'Register — PS Doni Galaxy')

@section('content')
<div class="ps-auth-bg">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-md-6 col-lg-5">
                <div class="ps-auth-card animate-fadeup">
                    <div class="text-center mb-4">
                        <div class="ps-auth-logo mb-3">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h3 class="ps-auth-title">Buat Akun Baru</h3>
                        <p class="text-muted small">Daftar dan mulai booking sekarang!</p>
                    </div>

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="ps-label">Nama Lengkap</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-person-badge"></i></span>
                                <input type="text" name="nama" class="ps-input @error('nama') is-invalid @enderror"
                                    placeholder="Nama lengkap Anda" value="{{ old('nama') }}" required>
                            </div>
                            @error('nama') <div class="ps-input-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="ps-label">Username</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-at"></i></span>
                                <input type="text" name="username" class="ps-input @error('username') is-invalid @enderror"
                                    placeholder="Pilih username unik" value="{{ old('username') }}" required>
                            </div>
                            @error('username') <div class="ps-input-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="ps-label">Email</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="ps-input @error('email') is-invalid @enderror"
                                    placeholder="Email aktif Anda" value="{{ old('email') }}" required>
                            </div>
                            @error('email') <div class="ps-input-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="ps-label">Password</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="ps-input @error('password') is-invalid @enderror"
                                    placeholder="Minimal 6 karakter" required>
                            </div>
                            @error('password') <div class="ps-input-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="ps-label">Konfirmasi Password</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" class="ps-input"
                                    placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn ps-btn-primary w-100 btn-lg ps-btn-glow">
                            <i class="bi bi-person-check me-2"></i>Daftar Sekarang
                        </button>
                    </form>

                    <p class="text-center mt-4 text-muted small">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="ps-link">Login disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection