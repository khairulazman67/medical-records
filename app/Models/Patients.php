<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $primaryKey = 'NIK';
    public function RekamMedis(){
        return $this->hasMany(RekamMedis::class,'no_BPJS');
    }
}
