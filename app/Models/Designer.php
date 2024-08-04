<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'procent', 'salary'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ordersServices()
    {
        return $this->morphMany(OrderService::class, 'orderable');
    }
}
