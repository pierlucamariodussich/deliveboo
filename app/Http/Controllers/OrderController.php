<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\restaurantValidator;
use App\Restaurant;
use App\Order;
use App\Type;
use App\Http\Requests\OrderValidate;
use Braintree\Gateway;
use Braintree;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderValidate $request)
    {
        $dish = $request->all();
        $data = $request->validated();
       
        $order = new Order();
        $order["total"] = $data["total"];
        $order["client_name"] = $data["client_name"];
        $order["client_surname"] = $data["client_surname"];
        $order["client_email"] = $data["client_email"];
        $order["client_phone"] = $data["client_phone"];
        $order["client_address"] = $data["client_address"];
        $order["is_payed"] = 0;

        $order->getRestaurant()->associate($data["restaurant_id"]);
        $order->save();
        $order->getDishes()->attach(explode(",",$dish["dishes"]));
        
        $input = array(
            'total' => $order["total"],
            "order_id" => $order["id"],
            "client_name" => $order["client_name"],
            "dishes" => $order->getDishes,
        );

        Mail::send('order-mail', $input, function ($message) use ($order) {
            $message->to($order["client_email"], $order["client_name"])->subject('Grazie per aver usato il nostro servizio!');
            $message->from('deliverboo@gmail.com', 'DeliverBoo Team-3');
        });

        $gateway = new Braintree\Gateway([
                'environment' => "sandbox",
                'merchantId' => "rbhzcjjb2rtjsx4j",
                'publicKey' => "8hsqrm2vqx9twkpw",
                'privateKey' => "1971b9924ee94d6d0320bc61d1ccb6be"
            ]);
        $token = $gateway->ClientToken()->generate();
        $total = $order["total"];
        return view("payment", compact("token","total"));
       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        $orders = json_encode(Order::where('restaurant_id', $id)->with("getDishes")->orderBy('id', 'DESC')->get());
        return view("test-orders", compact("restaurant", "orders"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
