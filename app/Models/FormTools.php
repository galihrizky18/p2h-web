<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormTools extends Model
{
    use HasFactory;

    public function reportform(){
        return $this->belongsTo(reportform::class);
    }
}
