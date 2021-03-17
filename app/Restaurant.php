<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    protected $fillable = [
        'name', 'address', 'p_iva', "image_url", "restaurateur_id"
    ];
    public function getRestaurateur(){
        return $this->belongsTo("App\Restaurateur","restaurateur_id");
    }

    public function getTypes(){
        return $this->belongsToMany("App\Type", "restaurant_type");
    }

    public function getDishes()
    {
        return $this->hasMany("App\Dish");
    }

    public function getOrders()
    {
        return $this->hasMany("App\Order");
    }
}

