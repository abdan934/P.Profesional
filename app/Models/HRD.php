<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRD extends Model
{
    use HasFactory;
    protected $table = 'hrd';
    // protected $primaryKey = 'id_hrd';
    protected $fillable = [
        'id_hrd',
        'name_hrd',
    ];
}
