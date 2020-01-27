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
            $ordine = Order::where('nrTavolo', $tavolo->id)->first();
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
        $ordine->save();

        $menu = Category::orderBy('id', 'ASC')->with('foods')->get();
        return view('camerieri.ordine', compact( 'menu', 'ordine'));
    }
}
