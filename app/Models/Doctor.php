<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'license',
    ];

    public function doctor_patient(){
        return $this->hasMany(Patient::class);
    }
    public function doctor_diagnose(){
        return $this->hasMany(Diagnose::class);
    }
}
