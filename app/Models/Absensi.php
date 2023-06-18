<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = [
        'id_absensi',
        'id_pengawas',
        'id_sift',
        'name_kapal',
        'dermaga',
        'tgl',
    ];
}
