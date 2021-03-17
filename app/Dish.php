<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 'description', 'price', "image_url", "restaurant_id", "visibility","genre_id"
    ];
    public function getRestaurant(){
        return $this->belongsTo("App\Restaurant","restaurant_id");
    }
    public function getGenre(){
        return $this->belongsTo("App\Genre","genre_id");
    }

    public function getOrders()
    {
        return $this->belongsToMany("App\Order", `dish_order`,"dish_id","order_id");
    }
}
