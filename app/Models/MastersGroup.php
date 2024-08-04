<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MastersGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function masters()
    {
        return $this->hasMany(Master::class);
    }

    public function ordersServices()
    {
        return $this->morphMany(OrderService::class, 'orderable');
    }
}
