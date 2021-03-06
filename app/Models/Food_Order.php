<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food_Order extends Model
{
    protected $table = 'foods_orders';

    public function foods()
    {
        return $this->hasMany(Food::class, 'food_id', 'id');
    }
}
