<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'license',
        'email',
    ];

    public function doctor_patient(){
        return $this->hasMany(Patient::class);
    }
    public function doctor_diagnosis(){
        return $this->hasMany(Diagnosis::class);
    }
}
