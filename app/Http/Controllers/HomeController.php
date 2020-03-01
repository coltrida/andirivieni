<?php

namespace App\Http\Controllers;

use App\Events\NewOrderCreated;
use App\Models\Category;
use App\Models\Food;
use App\Models\Food_Order;
use App\Models\Order;
use App\Models\Tavolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tavoli = Tavolo::all();
        if (Auth::user()->isAdmin()){
            $ordini = $this->getNuoviOrdini();
            //dd($ordini);
            return view('admin.home', compact('tavoli', 'ordini'));
        } else {
            return view('camerieri.home', compact('tavoli'));
        }
    }

    public function getNuoviOrdini()
    {

        return $ordini = Order::where('stato', 'inviato')->latest()->get();

    }

    public function getStatoTavoli()
    {

        return $tavoli = Tavolo::all();

    }

    public function selezioneTavolo(Tavolo $tavolo)
    {
        if ($tavolo->stato == 'libero'){
            return view('camerieri.coperti', compact('tavolo'));
        } elseif ($tavolo->stato == 'occupato') {
            $menu = Category::orderBy('id', 'ASC')->with('foods')->get();
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

            //dd($ordine);

            return view('camerieri.ordine', compact('menu', 'ordine'));
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
        $ordine->user_id = Auth::user()->id;
        $ordine->nrTavolo = $tavolo->id;
        $ordine->nrPersone = $coperti;
        $ordine->stato = 'occupato';
        $ordine->save();

        $menu = Category::orderBy('id', 'ASC')->with(['foods' => function ($query) {
            $query->where('inmenu', true);
        }])->get();
        return view('camerieri.ordine', compact( 'menu', 'ordine'));
    }

    public function riepilogo(Request $request, Order $order)
    {
        //dd($request);
        $tavolo = $request->tavolo;
        $coperti = $request->persone;
        $order->note = $request->note1;
        $order->note2 = $request->note2;
        $order->note3 = $request->note3;
        $order->nrPersone = $coperti;
        $order->save();

        $cancellaPiatti = Food_Order::where('order_id', $order->id)->delete();

        $piatti = $request->dati;
        $collection = collect($piatti);
        $grouped = $collection->groupBy(2);

        isset($grouped["listamandata1"]) ? $mandata1 = $grouped["listamandata1"] : $mandata1 = collect([]);
        isset($grouped["listamandata2"]) ? $mandata2 = $grouped["listamandata2"] : $mandata2 = collect([]);
        isset($grouped["listaaltro"]) ? $mandata3 = $grouped["listaaltro"] : $mandata3 = collect([]);

        foreach ($mandata1 as $item){
            $food_order = new Food_Order();
            $food_order->order_id = $order->id;
            $food_order->food_id = $item[3];
            $food_order->quantity = $item[1];
            $food_order->mandata = 1;
            $food_order->save();
        }

        foreach ($mandata2 as $item){
            $food_order = new Food_Order();
            $food_order->order_id = $order->id;
            $food_order->food_id = $item[3];
            $food_order->quantity = $item[1];
            $food_order->mandata = 2;
            $food_order->save();
        }

        foreach ($mandata3 as $item){
            $food_order = new Food_Order();
            $food_order->order_id = $order->id;
            $food_order->food_id = $item[3];
            $food_order->quantity = $item[1];
            $food_order->mandata = 3;
            $food_order->save();
        }

        return view('camerieri.riepilogo', compact( 'tavolo', 'coperti', 'mandata1', 'mandata2', 'mandata3', 'order'));
    }

    public function inviaPrenotazione(Order $order)
    {
        $order->stato = 'inviato';
        $order->save();
        //event(new NewOrderCreated($order));
        return redirect()->route('home');
    }

    public function annullaTavolo(Tavolo $tavolo)
    {
        $tavolo->stato = 'libero';
        $tavolo->save();

        $ordine = Order::where([
            ['nrTavolo', $tavolo->id],
            ['stato', '!=', 'libero'],
        ])->delete();

        return redirect()->route('home');
    }
}
