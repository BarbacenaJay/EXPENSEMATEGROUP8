<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    protected $fillable = ['source', 'amount', 'date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
