<?php

namespace App\Http\Controllers;

use App\Models\{Ruangan, Booking};
use Illuminate\Http\Request;

class TamuController extends Controller
//dashrboad tamu
{
    public function dashboard()
    {
        $ruangan = Ruangan::all();//ambl dta ruangan
        //ambil boking dri usr login
        $myBookings = Booking::where('user_id', auth()->id())
            ->with('ruangan')
            ->latest()
            ->get();

        return view('tamu.dashboard', compact('ruangan', 'myBookings'));
    }
     //list ruangan
    public function ruangan()
    {
        $ruangan = Ruangan::all();
        return view('tamu.ruangan', compact('ruangan'));
    }
    
    // detail ruangn
    public function detailRuangan(Ruangan $ruangan)
    { 
        return view('tamu.detail-ruangan', compact('ruangan'));//tampil detail
    }
    //form boking
    public function showBooking(Ruangan $ruangan)
    {
        if ($ruangan->status !== 'tersedia') {//cek ruangan tersedia/ngga
            return redirect()->route('tamu.ruangan')->with('error', 'Yah, ruangannya baru aja dipesen orang lain.');
        }
        return view('tamu.booking', compact('ruangan'));
    }
    //simpan booking
    public function storeBooking(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_mulai'       => 'required',
            'durasi_jam'      => 'required|integer|min:1|max:12',
            'catatan'         => 'nullable|string|max:255',
        ]);
        //hitung jam dn tntukn hrga
        $jamSelesai = date('H:i', strtotime($request->jam_mulai . " +{$request->durasi_jam} hours"));
        $hargaPerJam = $ruangan->harga_diskon ?? $ruangan->harga_normal;
        //smpn boking ke db
        Booking::create([
            'user_id'         => auth()->id(),
            'ruangan_id'      => $ruangan->id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $jamSelesai,
            'durasi_jam'      => $request->durasi_jam,
            'total_harga'     => $hargaPerJam * $request->durasi_jam,
            'status'          => 'pending',
            'catatan'         => $request->catatan,
        ]);

        $ruangan->update(['status' => 'dipesan']);//up status ruangn

        return redirect()->route('tamu.dashboard')->with('success', 'Sip! Booking berhasil, tunggu konfirmasi admin ya.');
    }

    //lis boking saya
    public function myBookings()
    {//ambil smua boking milih usr login
        $bookings = Booking::where('user_id', auth()->id())
            ->with('ruangan')
            ->latest()
            ->get();
            
        return view('tamu.my-bookings', compact('bookings'));
    }
    //batalkan boking tu
    public function cancelBooking(Booking $booking)
    {
        // Pastikan hnya pemilik yg bisa btl bookingnya
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        //hnya bisa dibtlkn jika status msi pending
        if ($booking->status === 'pending') {
            $booking->update(['status' => 'dibatalkan']);
            $booking->ruangan->update(['status' => 'tersedia']);
            
            return back()->with('success', 'Booking kamu berhasil dibatalkan.');
        }

        return back()->with('error', 'Gagal batalin, kayaknya statusnya udah berubah.');
    }
}