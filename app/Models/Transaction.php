<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'receiver_id',
        'type',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function receiver(): BelongsTo {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
