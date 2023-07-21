<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'tempat_lahir',
        'kota',
        'kode_pos',
        'kebangsaan',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'driver_id');
    }
}
