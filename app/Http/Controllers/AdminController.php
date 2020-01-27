<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Tavolo;
use App\Models\User;
use Illuminate\Http\Request;
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
            if ($i == 2){
                $tavolo->stato = 'occupato';
            } else {
                $tavolo->stato = 'libero';
            }

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

    public function caricamenu()
    {
        Food::truncate();

        $food = new Food();
        $food->name = 'carbonara';
        $food->category = 'primi';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'pizza margherita';
        $food->category = 'pizze';
        $food->destinazione = 'pizzeria';
        $food->price = 5;
        $food->cost = 1;
        $food->save();

        $food = new Food();
        $food->name = 'pizza funghi';
        $food->category = 'pizze';
        $food->destinazione = 'pizzeria';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'coca';
        $food->category = 'bevande';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'crostini';
        $food->category = 'antipasto';
        $food->destinazione = 'ristorante';
        $food->price = 8;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tagliere';
        $food->category = 'antipasto';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tartare grande';
        $food->category = 'tartare';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tartare piccolo';
        $food->category = 'tartare';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'hamburger piccolo';
        $food->category = 'hamburger';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'hamburger grande';
        $food->category = 'hamburger';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'patatine';
        $food->category = 'contorni';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'instalata';
        $food->category = 'contorni';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tiramisu';
        $food->category = 'dolci';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        $food = new Food();
        $food->name = 'tartufo';
        $food->category = 'dolci';
        $food->destinazione = 'ristorante';
        $food->price = 10;
        $food->cost = 2;
        $food->save();

        return redirect()->back();
    }
}
