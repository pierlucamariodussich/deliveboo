<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Dish;
use App\Order;
use App\Http\Requests\restaurantValidator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Restaurateur;
use App\Type;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class FrontEndTestController extends Controller
{

    private $dataOrder = [];

    public function home(){
        $auth = Auth::User()->id;
        $restaurant = Restaurant::with("getTypes","getDishes","getRestaurateur")->whereHas('getRestaurateur', function ($q) use($auth){
            $q->where('id', "=", $auth);
        })->get();

        if(isset($restaurant)){
            return view('frontHome',compact("restaurant"));
        } else {
            return redirect()->view("restaurant/create");
        }
        
        
    }
    public function success(){
        return view('frontSuccess');

    }
    public function register(){
        return view('frontRegister');
    }
    public function menu(){
        return view('menu');
    }


    public function checkout(){
        return view('checkout');
    }
    public function login(){
        return view('frontLogin');
    }
    public function infoClienti(){
        return view('infoClienti');
    }
}

