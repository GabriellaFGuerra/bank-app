<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'user_id',
        'date'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
