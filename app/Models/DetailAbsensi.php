<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAbsensi extends Model
{
    use HasFactory;
    protected $table = 'detail_absensi';
    protected $fillable = [
        'id_detail_absensi',
        'id_absensi',
        'id_karyawan',
        'bagian',
        'status',
        'keterangan',
        'waktu_absen',
    ];
}
