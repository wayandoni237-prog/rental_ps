<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    protected $fillable = [
        'nama_ruangan',
        'deskripsi',
        'harga_normal',
        'harga_diskon',
        'persen_diskon',
        'foto',
        'status',
        'kapasitas',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getHargaFinalAttribute()
    {
        return $this->harga_diskon ?? $this->harga_normal;
    }

    public function isTersedia()
    {
        return $this->status === 'tersedia';
    }
}