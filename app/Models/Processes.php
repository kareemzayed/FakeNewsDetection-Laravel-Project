<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Processes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'processText', 
        'result'
    ];

    // relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
