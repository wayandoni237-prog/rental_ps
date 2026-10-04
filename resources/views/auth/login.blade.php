@extends('layouts.app')

@section('title', 'Login — PS Doni Galaxy')

@section('content')
<div class="ps-auth-bg">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5 col-lg-4">

                @if(session('success'))
                    <div class="alert ps-alert-success alert-dismissible fade show animate-fadeup mb-4" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="ps-auth-card animate-fadeup">
                    <div class="text-center mb-4">
                        <div class="ps-auth-logo mb-3">
                            <i class="bi bi-controller"></i>
                        </div>
                        <h3 class="ps-auth-title">Masuk Akun</h3>
                        <p class="text-muted small">Selamat datang kembali di PS Galaxy</p>
                    </div>

                    @if($errors->has('login'))
                        <div class="alert ps-alert-danger mb-3">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first('login') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="ps-label">Username</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" class="ps-input @error('username') is-invalid @enderror"
                                    placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                            </div>
                            @error('username')
                                <div class="ps-input-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="ps-label">Password</label>
                            <div class="ps-input-group">
                                <span class="ps-input-icon"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="pwdInput" class="ps-input @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password" required>
                                <span class="ps-input-toggle" onclick="togglePwd()">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="ps-input-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn ps-btn-primary w-100 btn-lg ps-btn-glow">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </form>

                    <p class="text-center mt-4 text-muted small">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="ps-link">Daftar disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePwd() {
    const input = document.getElementById('pwdInput');
    const icon  = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endpush