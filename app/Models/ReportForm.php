<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportForm extends Model
{
    use HasFactory;

    public function document(){
        return $this->hasMany(FormDocument::class);
    }

    public function safety(){
        return $this->hasMany(FormSafety::class);
    }

    public function engine(){
        return $this->hasMany(FormEngine::class);
    }
    public function tools(){
        return $this->hasMany(FormTools::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'no_polisi', 'no_polisi');
    }
}
