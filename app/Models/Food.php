<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'foods_orders', 'food_id', 'order_id')
            ->withPivot('quantity');
    }

    public function categoria()
    {
        return $this->belongsTo(Category::class,  'category_id', 'id');
    }

    public function foodorders()
    {
        return $this->hasMany(Food_Order::class);
    }

}
