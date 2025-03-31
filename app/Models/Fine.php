<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_id',
        'amount',
        'reason',
        'fineStatus_id',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function fineStatus()
    {
        return $this->belongsTo(FineStatus::class, 'fineStatus_id');
    }
}
