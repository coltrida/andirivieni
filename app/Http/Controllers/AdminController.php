<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Food_Order;
use App\Models\Order;
use App\Models\Tavolo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function caricatavoli()
    {
        return view('admin.caricaTavoli');
    }

    public function caricatavolisave(Request $request)
    {
        Tavolo::truncate();
        $totale = $request->input('tavoli');
        for ($i = 1; $i <= $totale; $i++){
            $tavolo = new Tavolo();
            $tavolo->id = $i;
            $tavolo->stato = 'libero';

            $tavolo->save();
        }
        return redirect()->route('home');
    }

    public function caricacamerieri()
    {
        User::where('role', '!=', 'Admin')->delete();

        $user = new User();
        $user->name = 'cacao';
        $user->role = 'cameriere';
        $user->email = 'cacao@cacao.it';
        $user->password = Hash::make('12345678');
        $user->save();

        $user = new User();
        $user->name = 'miao';
        $user->role = 'cameriere';
        $user->email = 'miao@miao.it';
        $user->password = Hash::make('12345678');
        $user->save();


        return redirect()->back();
    }

    public function caricacategorie()
    {
        $categorie = Category::all();
        return view('admin.caricaCategorie', compact('categorie'));
    }

    public function caricacategoriesave(Request $request)
    {
        //Category::truncate();
        $categoria = new Category();
        $categoria->name = $request->input('categoria');
        $categoria->save();
        return redirect()->route('caricacategorie');
    }

    public function caricamenu()
    {
        $categorie = Category::all();
        $foods = Food::orderBy('name')->get();
        return view('admin.caricaMenu', compact('categorie', 'foods'));
    }

    public function caricamenusave(Request $request)
    {
        //dd($request);

        $food = new Food();
        $food->name = $request->input('food');
        $food->category_id = $request->input('categoria');
        $food->destinazione = $request->input('destinazione');
        $food->price = $request->input('prezzo');
        $food->cost = $request->input('costo');
        $food->inmenu = true;
        $food->save();


        return redirect()->back();
    }

    public function infoOrdine(Order $order)
    {
        $grouped = $order->foods->groupBy(function ($item) {
            return $item->pivot->mandata;
        });

        return view('admin.infoOrdine', compact('order','grouped'));
    }

    public function chiudiOrdine(Order $order)
    {
        $order->stato = 'chiuso';
        $order->save();
        $tavolo = Tavolo::find($order->nrTavolo);
        $tavolo->stato = "libero";
        $tavolo->save();

        return redirect()->route('home');
    }

    public function stampaOrdine(Order $order)
    {
        $grouped = $order->foods->groupBy(function ($item) {
            return $item->pivot->mandata;
        });

        $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('admin.stampaOrdine', compact('order','grouped'))
            ->stream();
    }

    public function statistiche()
    {
        $foods = Food::all();

        foreach ($foods as $food){
            $totale = 0;
            $raggruppa = Food_Order::where('food_id', $food->id)->get();
            //dd($raggruppa);
            foreach ($raggruppa as $ele){

                //dd($ele->quantity);
                $totale+=$ele->quantity;
            }
            $conteggio[$food->id]=$totale;
            //dd($conteggio);
        }
        arsort($conteggio);
        //dd($conteggio);
        //dd($foods[0]);
        return view('admin.statistiche', compact('conteggio', 'foods'));
    }

    public function azzera()
    {
        Category::truncate();
        Food::truncate();
        Tavolo::truncate();
        Order::truncate();
        Food_Order::truncate();
        return redirect()->back();
    }

    public function eliminaPiatto(Food $food)
    {
        $food->inmenu = false;
        $food->save();
        return redirect()->back();
    }

    public function rimettiPiatto(Food $food)
    {
        $food->inmenu = true;
        $food->save();
        return redirect()->back();
    }

    public function modificaPiatto(Food $food)
    {
        $categorie = Category::all();
        return view('admin.modificaPiatto', compact('food', 'categorie'));
    }

    public function modificaPiattosave(Food $food, Request $request)
    {
        $food->name = $request->input('nome');
        $food->category_id = $request->input('categoria');
        $food->destinazione = $request->input('destinazione');
        $food->price = $request->input('prezzo');
        $food->cost = $request->input('costo');
        $food->save();
        return redirect()->route('caricamenu');
    }

}
