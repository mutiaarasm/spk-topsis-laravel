<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'pendapatan', // huruf kecil sesuai dengan yang digunakan dalam validasi
        'jumlah_tanggungan', // huruf kecil sesuai dengan yang digunakan dalam validasi
        'jaminan', // huruf kecil sesuai dengan yang digunakan dalam validasi
        'jumlah_pinjaman', // huruf kecil sesuai dengan yang digunakan dalam validasi
        'lama_angsuran', // huruf kecil sesuai dengan yang digunakan dalam validasi
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
