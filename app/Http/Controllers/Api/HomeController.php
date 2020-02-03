<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CameriereResource;
use App\Http\Resources\FoodOrderResource;
use App\Http\Resources\FoodResource;
use App\Http\Resources\OrdineResource;
use App\Http\Resources\TavoloResource;
use App\Models\Food;
use App\Models\Food_Order;
use App\Models\Order;
use App\Models\Tavolo;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tavolo = Tavolo::all();
        return TavoloResource::collection($tavolo);
    }

    public function camerieri()
    {
        $camerieri = User::all();
        return CameriereResource::collection($camerieri);
    }

    public function ordini()
    {
        $ordini = Order::all();
        return OrdineResource::collection($ordini);
    }

    public function piatti()
    {
        $food = Food::all();
        return FoodResource::collection($food);
    }

    public function piattiOrdine()
    {
        $piattoOrdine = Food_Order::all();
        return FoodOrderResource::collection($piattoOrdine);
    }

    public function piattiOrdineSpecifico(Order $order)
    {
        $piattoOrdine = Food_Order::where('order_id', $order->id)->get();
        return FoodOrderResource::collection($piattoOrdine);
    }
}
