<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sift extends Model
{
    use HasFactory;
    protected $table = 'sift';
    // protected $primaryKey = 'id_sift';
    protected $fillable = [
        'id_sift',
        'name_sift',
        'waktu_awal',
        'waktu_akhir',
    ];
}
