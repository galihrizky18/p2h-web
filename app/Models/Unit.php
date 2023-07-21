<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_polisi',
        'merk_mobil',
        'model_mobil',
        'warna',
        'no_mesin',
        'tahun_pembuatan',
    ];

    public function reportForm(){
        return $this->hasMany(ReportForm::class, 'no_polisi', 'no_polisi');
    }
}
