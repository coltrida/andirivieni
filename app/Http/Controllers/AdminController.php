<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
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
        Tavolo::truncate();

        for ($i = 1; $i <=25; $i++){
            $tavolo = new Tavolo();
            $tavolo->id = $i;
            $tavolo->stato = 'libero';

            $tavolo->save();
        }
        return redirect()->back();
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
        DB::table('categories')->delete();

        $categoria = new Category();
        $categoria->name = 'Primi';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Pizze';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Bevande';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Antipasti';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Tartare';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Hamburger';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Contorni';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Dolci';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Caffe';
        $categoria->save();

        $categoria = new Category();
        $categoria->name = 'Amari';
        $categoria->save();


        return redirect()->back();
    }

    public function caricamenu()
    {
        Food::truncate();

        $food = new Food();
        $food->name = 'carbonara';
        $food->category_id = 1;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza margherita';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 5;
        $food->cost = 1;
        $food->save();

        $food = new Food();
        $food->name = 'pizza funghi';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza bianca';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza rossa';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza verde';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza nera';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza blu';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza gialla';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza rosa';
        $food->category_id = 2;
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'coca';
        $food->category_id = 3;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'crostini';
        $food->category_id = 4;
        $food->destinazione = 'ristorante';
        $food->price = 8;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tagliere';
        $food->category_id = 4;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tartare grande';
        $food->category_id = 5;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tartare piccolo';
        $food->category_id = 5;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'hamburger piccolo';
        $food->category_id = 6;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'hamburger grande';
        $food->category_id = 6;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'patatine';
        $food->category_id = 7;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'instalata';
        $food->category_id = 7;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tiramisu';
        $food->category_id = 8;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tartufo';
        $food->category_id = 8;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'caffè lungo';
        $food->category_id = 9;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'caffè macchiato';
        $food->category_id = 9;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'fernet';
        $food->category_id = 10;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'grappa';
        $food->category_id = 10;
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        return redirect()->back();
    }

    public function infoOrdine(Order $order)
    {
        $grouped = $order->foods->groupBy(function ($item) {
            return $item->pivot->mandata;
        });

        //return view('admin.infoOrdine', compact('order','grouped'));

        $pdf = App::make('dompdf.wrapper');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->loadView('admin.infoOrdinePdf', compact('order','grouped'))
            ->stream();
    }
}
