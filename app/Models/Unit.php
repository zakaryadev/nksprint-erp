<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function decommissionedProducts(): HasMany
    {
        return $this->hasMany(DecommissionedProduct::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function arrivedProducts(): HasMany
    {
        return $this->hasMany(ArrivedProduct::class);
    }
}
