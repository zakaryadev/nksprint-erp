<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'name', 'desc', 'deadline', 'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'orders_services')
            ->withPivot('id', 'orderable_id', 'orderable_type', 'price', 'width', 'height', 'quantity')
            ->withTimestamps()
            ->using(OrderService::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function orderServices()
    {
        return $this->hasMany(OrderService::class);
    }
}
