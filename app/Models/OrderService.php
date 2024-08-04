<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderService extends Pivot
{
    protected $table = 'orders_services';

    protected $fillable = [
        'order_id', 'service_id', 'orderable_id', 'orderable_type', 'price', 'width', 'height', 'quantity'
    ];

    public function orderable()
    {
        return $this->morphTo();
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
