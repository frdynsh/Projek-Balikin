<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangHilang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_barang',
        'deskripsi_barang',
        'tgl_kehilangan',
        'lokasi_kehilangan',
        'gambar',
        'status',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}