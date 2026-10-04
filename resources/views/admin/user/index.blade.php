@extends('admin.layouts.admin')

@section('title', 'Manajemen User — PS Doni Galaxy')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 animate-fadeup">
    <div>
        <h3 class="ps-page-title">Manajemen <span class="ps-gradient-text">User</span></h3>
        <p class="text-muted">Kelola semua akun pengguna</p>
    </div>
    <a href="{{ route('admin.user.tambah') }}" class="btn ps-btn-primary ps-btn-glow">
        <i class="bi bi-person-plus me-2"></i>Tambah User
    </a>
</div>

{{-- TABEL TAMU --}}
<div class="ps-card mb-4 animate-fadeup">
    <h5 class="ps-card-title mb-4">
        <i class="bi bi-people me-2"></i>Daftar Tamu ({{ $users->count() }})
    </h5>
    @if($users->count() > 0)
        <div class="ps-table-wrap">
            <table class="table ps-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="color:#fff;font-weight:600">{{ $user->nama }}</td>
                        <td>
                            <span class="ps-badge-user">{{ $user->username }}</span>
                        </td>
                        <td style="color:#94a3b8">{{ $user->email }}</td>
                        <td style="color:#94a3b8">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                    class="btn ps-btn-icon-sm ps-btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.user.hapus', $user->id) }}"
                                    onsubmit="return confirm('Hapus user {{ $user->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn ps-btn-icon-sm ps-btn-del" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="ps-empty-state">
            <i class="bi bi-people"></i>
            <p>Belum ada tamu terdaftar.</p>
        </div>
    @endif
</div>

{{-- TABEL ADMIN --}}
<div class="ps-card animate-fadeup" style="animation-delay:.1s">
    <h5 class="ps-card-title mb-4">
        <i class="bi bi-shield-check me-2 text-warning"></i>Daftar Admin ({{ $admins->count() }})
    </h5>
    @if($admins->count() > 0)
        <div class="ps-table-wrap">
            <table class="table ps-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $i => $admin)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="color:#fff;font-weight:600">{{ $admin->nama }}</td>
                        <td>
                            <span class="ps-badge-admin">{{ $admin->username }}</span>
                        </td>
                        <td style="color:#94a3b8">{{ $admin->email }}</td>
                        <td style="color:#94a3b8">{{ $admin->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.user.edit', $admin->id) }}"
                                    class="btn ps-btn-icon-sm ps-btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($admin->id !== Auth::id())
                                <form method="POST" action="{{ route('admin.user.hapus', $admin->id) }}"
                                    onsubmit="return confirm('Hapus admin {{ $admin->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn ps-btn-icon-sm ps-btn-del" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="ps-empty-state">
            <i class="bi bi-shield"></i>
            <p>Belum ada admin lain.</p>
        </div>
    @endif
</div>
@endsection