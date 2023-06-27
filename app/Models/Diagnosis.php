<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable =[
        'diagnosis',
        'diagnosis_description',
    ];
    public function diagnosis_patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function diagnosis_doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
