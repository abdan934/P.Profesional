<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawas extends Model
{
    use HasFactory;
    protected $table = 'pengawas';
    // protected $primaryKey = 'id_pengawas';
    protected $fillable = [
        'id_pengawas',
        'name_pengawas',
    ];
}
