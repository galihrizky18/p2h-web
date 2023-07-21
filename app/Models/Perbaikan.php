<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    public function mitra(){
        return $this->belongsTo(Bengkel::class, 'mitra_bengkel', 'id');
    }
}
