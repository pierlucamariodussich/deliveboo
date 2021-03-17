<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'total', 'client_name', 'client_surname', "client_address", "client_phone","is_payed","restaurant_id"
    ];
    public function getDishes(){
        return $this->belongsToMany("App\Dish", `dish_order`,"order_id","dish_id");
    }
    public function getRestaurant(){
        return $this->belongsTo("App\Restaurant","restaurant_id");
    }


}
