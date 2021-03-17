<?php

namespace App\Http\Controllers;

use App\Http\Requests\restaurantValidator;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Type;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return view("frontHome", compact("restaurants"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view("test-create", compact("types"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(restaurantValidator $request)
    {


        $exists = (Restaurant::where("restaurateur_id", Auth::User()->id)->exists());
        $data = $request->validated();
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($file->getFilename() . '.' . $extension, File::get($file));
        if (!$exists) {

            $restaurant = new Restaurant();
            $restaurant["name"] = $data["name"];
            $restaurant["address"] = $data["address"];
            $restaurant["p_iva"] = $data["p_iva"];
            $restaurant["image_url"] = $file->getFilename() . '.' . $extension;
            $restaurant->getRestaurateur()->associate(Auth::User()->id);
            $restaurant->save();

            $restaurant->getTypes()->sync($data["types"]);

            $item = "Hai creato con successo il tuo ristorante.";


            // $input = array(
            //     'name' => Auth::User()["name"],
            //     "restaurantName" => $restaurant["name"],
            //     "restaurantAddress" => $restaurant["address"],
            //     "restaurantIva" => $restaurant["p_iva"],
            // );
            // Mail::send('restaurant-mail', $input, function ($message) {
            //     $message->to(Auth::User()["email"], Auth::User()["name"])->subject('Grazie per aver usato il nostro servizio');
            //     $message->from('deliverboo@gmail.com', 'DeliverBoo Team-3');
            // });

            return view("success", compact("item"));
        } else {
            $item = "Hai già registrato un ristorante.";
            return view("failed", compact("item"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $temp_rest = Restaurant::find($id);
            if (Auth::User()->id  == $temp_rest->getRestaurateur->id) {
                $restaurant = Auth::User()->getRestaurant;
                return view('dashboard', compact('restaurant'));
            } else {
                $restaurant = Restaurant::where("id", $id)->with("getTypes", "getDishes", "getRestaurateur", "getDishes.getGenre")->get();
                return view("menu", compact("restaurant"));
            }
        } else {

            $restaurant = Restaurant::where("id", $id)->with("getTypes", "getDishes", "getRestaurateur", "getDishes.getGenre")->get();
            return view("menu", compact("restaurant"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        $types = Type::all();
        return view("test-restaurant-edit", compact("restaurant", "types"));
    }


    public function orders($id)
    {
        $restaurant = Restaurant::find($id);;
        return view("show-orders", compact("restaurant"));
    }

    public function getChart()
    {
        $restaurant = Auth::User()->getRestaurant;
        return view("chart", compact("restaurant"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(restaurantValidator $request, $id)
    {

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('public')->put($file->getFilename() . '.' . $extension, File::get($file));
        $restaurant = Restaurant::find($id);
        $data = $request->validated();

        $restaurant->update([
            "name" => $data["name"],
            "address" => $data["address"],
            "p_iva" => $data["p_iva"],
            "image_url" => $file->getFilename() . '.' . $extension,

        ]);
        $restaurant->getRestaurateur()->associate(Auth::User()->id)->save();
        $restaurant->getTypes()->sync($data["types"]);


        $item = "Le modifiche sono state effettuate con successo.";

        return view("success", compact("item"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (Auth::User()->getRestaurant->id == $id) {
            $restaurant = Restaurant::find($id);
            $restaurant->getDishes()->delete();
            $restaurant->getTypes()->detach();
            $restaurant->delete();
            $item = "Hai rimosso con successo il tuo ristorante.";

            return view("success", compact("item"));
        } else {
            $item = "Non sei autorizzato a questa operazione";
            return view("failed", compact("item"));
        }
    }
}
