<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'foods_orders', 'food_id', 'order_id');
    }
}
