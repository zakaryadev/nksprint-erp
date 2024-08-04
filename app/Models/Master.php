<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Master extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'procent',
        'salary',
        'masters_group_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mastersGroup(): BelongsTo
    {
        return $this->belongsTo(MastersGroup::class);
    }
}
