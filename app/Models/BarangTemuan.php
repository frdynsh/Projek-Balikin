<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTemuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_barang',
        'deskripsi_barang',
        'tgl_penemuan',
        'lokasi_penemuan',
        'gambar',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}