<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {//menampilkan hlmn branda
        return view('beranda');
    }
}