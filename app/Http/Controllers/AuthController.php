<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class AuthController extends Controller
{//tampil hlm login 
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }//ck apkh ud lgin klo blm silhkn logn
    
    public function login(Request $request)
    {//proses dn validasi input login
        $creds = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($creds, $request->remember)) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'login' => 'Username atau password nggak cocok.',
        ])->withInput();
    }
    //tmpil hlm register
    public function showRegister()
    {
        return view('auth.register');
    }
    //proses regis
    public function register(Request $request)
    {//validasi regis
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([//simpn usr bru ke db
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'tamu',
        ]);
        //redirect ke login degn pesan berhasil
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }
    //logout 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('beranda');
    }
    
    //redirect berdasarkn role
    protected function redirectByRole()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('tamu.dashboard');
    }
}