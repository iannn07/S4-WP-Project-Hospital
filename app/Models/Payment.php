<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $casts = [
        'id' => 'string',
    ];
    protected $fillable = [
        'patient_id',
        'full_amount'
    ];

    public function patient(): BelongsTo{
        return $this->belongsTo(Patient::class);
    }
}
