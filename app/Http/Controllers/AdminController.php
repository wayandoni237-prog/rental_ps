<?php

namespace App\Http\Controllers;

use App\Models\{User, Ruangan, Booking};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Storage};

class AdminController extends Controller
//dashbord
{
    public function dashboard()
    {//mengambil data dri user
        $data = [
            'totalUser' => User::where('role', 'tamu')->count(),
            'totalAdmin' => User::where('role', 'admin')->count(),
            'totalRuangan' => Ruangan::count(),
            'totalBooking' => Booking::count(),
            'ruanganTersedia' => Ruangan::where('status', 'tersedia')->count(),
            'ruanganDipesan' => Ruangan::where('status', 'dipesan')->count(),
            'bookingTerbaru' => Booking::with(['user', 'ruangan'])->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);//kirim data ke dashbosrd 
    }

    // MANAJEMEN USER 
    public function daftarUser()
    {//ambil dta tmu dn admn lalu kirim view
        $users = User::where('role', 'tamu')->latest()->get();
        $admins = User::where('role', 'admin')->latest()->get();
        return view('admin.user.index', compact('users', 'admins'));
    }

    public function tambahUser() { return view('admin.user.tambah'); }//tambil form tmbh usr

    public function simpanUser(Request $request)
    {//validasi input dri from
        $input = $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,tamu',
        ]);

        $input['password'] = Hash::make($request->password);
        User::create($input);//enkripsi pw sebelum di simpan 

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser(User $user)
    {
        return view('admin.user.edit', compact('user'));//form edit usr
    }

    public function updateUser(Request $request, User $user)
    {//validasi dta updait
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => "required|unique:users,username,{$user->id}",
            'email' => "required|email|unique:users,email,{$user->id}",
            'role' => 'required|in:admin,tamu',
        ]);

        $data = $request->except('password');//ambil semua data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        //update dta user
        $user->update($data);
        return redirect()->route('admin.user')->with('success', 'Data user diperbarui');
    }

    public function hapusUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }//hps usr dri db

    // --- MANAJEMEN RUANGAN ---
    public function daftarRuangan()
    {
        $ruangan = Ruangan::latest()->get();
        return view('admin.ruangan.index', compact('ruangan'));
    }//ambil smua dta ruangan

    public function tambahRuangan() { return view('admin.ruangan.tambah'); }//tampiln from tmbh ruanagan

    public function simpanRuangan(Request $request)
    {//validasi input
        $data = $request->validate([
            'nama_ruangan' => 'required|max:100',
            'harga_normal' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'status' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {//nmbh file fto
            $data['foto'] = $request->file('foto')->store('ruangan', 'public');
        }

        Ruangan::create($data);
        return redirect()->route('admin.ruangan')->with('success', 'Ruangan berhasil dibuat');
    }

    public function editRuangan(Ruangan $ruangan)
    {
        return view('admin.ruangan.edit', compact('ruangan'));
    }//edit ruangan

    public function updateRuangan(Request $request, Ruangan $ruangan)//up klo udh

    {  $data = $request->all();//ambil dta request

        if ($request->hasFile('foto')) {
            if ($ruangan->foto) Storage::disk('public')->delete($ruangan->foto);
            $data['foto'] = $request->file('foto')->store('ruangan', 'public');//mengganti fto 
        }

        $ruangan->update($data);
        return redirect()->route('admin.ruangan')->with('success', 'Ruangan diperbarui');//mggnti fto
      
    }

    public function hapusRuangan(Ruangan $ruangan)
    {
        if ($ruangan->foto) Storage::disk('public')->delete($ruangan->foto);
        $ruangan->delete();
        return back()->with('success', 'Ruangan dihapus');
    }//hps ruangan

    // --- MANAJEMEN BOOKING ---
    public function daftarBooking()
    {
        $bookings = Booking::with(['user', 'ruangan'])->latest()->get();
        return view('admin.booking.index', compact('bookings'));//ambil boking semua
    }

    
    public function detailBooking(Booking $booking)
    {
        $booking->load(['user', 'ruangan']);
        return view('admin.booking.detail', compact('booking'));//tampilan detail boking
    }

    public function updateStatusBooking(Request $request, Booking $booking)
    {//validasi dn updt status boking dn ruangan
        $request->validate(['status' => 'required|in:pending,dikonfirmasi,dibatalkan,selesai']);
        
        $booking->update(['status' => $request->status]);

        $statusRuangan = match($request->status) {
            'dikonfirmasi' => 'dipesan',
            'dibatalkan', 'selesai' => 'tersedia',
            default => $booking->ruangan->status
        };

        $booking->ruangan->update(['status' => $statusRuangan]);

        return redirect()->route('admin.booking')->with('success', 'Status pesanan berhasil diupdate');
    }
}