<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function getRestaurants()
    {
        return $this->belongsToMany("App\Restaurant", "restaurant_type");
    }
}
