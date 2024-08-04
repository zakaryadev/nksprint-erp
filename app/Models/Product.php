<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'unit_id',
        'unit_price',
        'quantity'
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function arrivedProducts(): HasMany
    {
        return $this->hasMany(ArrivedProduct::class);
    }

    public function decommissionedProducts(): HasMany
    {
        return $this->hasMany(DecommissionedProduct::class);
    }
}
