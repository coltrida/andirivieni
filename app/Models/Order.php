<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'foods_orders', 'order_id', 'food_id');
    }
}
