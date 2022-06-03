<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekammedis extends Model
{
    use HasFactory;
    protected $table = 'rekammedis';
    protected $primaryKey = 'id';
    public function Patients(){
        return $this->belongsTo(Patients::class,'no_BPJS','no_BPJS');
    }
}
