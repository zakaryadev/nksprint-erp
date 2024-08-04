<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id', 'name', 'desc', 'price'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_services')
            ->withPivot('id', 'orderable_id', 'orderable_type', 'price', 'width', 'height', 'quantity')
            ->withTimestamps()
            ->using(OrderService::class);
    }
}
