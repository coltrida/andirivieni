<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CameriereResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FoodOrderResource;
use App\Http\Resources\FoodResource;
use App\Http\Resources\OrdineResource;
use App\Http\Resources\TavoloResource;
use App\Models\Category;
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

    public function categorie()
    {
        $categorie = Category::all();
        return CategoryResource::collection($categorie);
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

    public function selezionaTavolo(Tavolo $tavolo)
    {
        if ($tavolo->stato !== 'libero'){
            $ordine = Order::with('foods')
                ->where([
                    ['nrTavolo', $tavolo->id],
                    ['stato', 'occupato'],
                ])
                ->orWhere([
                    ['nrTavolo', $tavolo->id],
                    ['stato', 'inviato'],
                ])
                ->first();

            return new OrdineResource($ordine);
        }
    }

    public function prenotaTavolo(Request $request)
    {
        $id_tavolo = $request->input('tavolo');
        $coperti = $request->input('coperti');
        $tavolo = Tavolo::find($id_tavolo);
        $tavolo->stato = 'occupato';
        $tavolo->save();

        $ordine = new Order();
        $ordine->user_id = 1;
        $ordine->nrTavolo = $tavolo->id;
        $ordine->nrPersone = $coperti;
        $ordine->stato = 'occupato';
        $ordine->save();

    }
}
