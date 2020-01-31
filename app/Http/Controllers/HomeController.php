<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
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
        if (Auth::user()->isAdmin()){
            return view('admin.home');
        } else {
            $tavoli = Tavolo::all();
            return view('camerieri.home', compact('tavoli'));
        }
    }

    public function selezioneTavolo(Tavolo $tavolo)
    {
        if ($tavolo->stato == 'libero'){
            return view('camerieri.coperti', compact('tavolo'));
        } elseif ($tavolo->stato == 'occupato') {
            $menu = Category::orderBy('id', 'ASC')->with('foods')->get();
            $ordine = Order::where([
                ['nrTavolo', $tavolo->id],
                ['stato', 'occupato'],
            ])->first();
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

        $menu = Category::orderBy('id', 'ASC')->with('foods')->get();
        return view('camerieri.ordine', compact( 'menu', 'ordine'));
    }

    public function riepilogo(Request $request)
    {
        $tavolo = $request->tavolo;
        $coperti = $request->persone;
        $piatti = $request->dati;
        $collection = collect($piatti);

        $grouped = $collection->groupBy(2);

        $mandata1 = $grouped["listamandata1"];
        $mandata2 = $grouped["listamandata2"];
        $mandata3 = $grouped["listaaltro"];

        //dd($mandata1);

        return view('camerieri.riepilogo', compact( 'tavolo', 'coperti', 'mandata1', 'mandata2', 'mandata3'));
    }
}
