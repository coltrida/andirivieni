<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $appends = ['orario', 'cameriere'];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'foods_orders', 'order_id', 'food_id')
            ->withPivot('quantity', 'mandata');
    }

    public function getOrarioAttribute()
    {
        return $this->updated_at->format('H:i:s');
    }

    public function getCameriereAttribute()
    {
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
