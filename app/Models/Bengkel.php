<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mitra' ,
        'no_telepon' ,
        'email' ,
        'alamat' ,
        'kode_pos' ,
    ];

    public function perbaikan(){
        return $this->hasMany(Perbaikan::class, 'id', 'mitra_bengkel');
    }
}
