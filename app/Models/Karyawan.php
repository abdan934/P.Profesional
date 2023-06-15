<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    // protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'id_karyawan',
        'name_karyawan',
        'qr_karyawan',
    ];
}
