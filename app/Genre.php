<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function getDishes(){
        return $this->hasMany("App\Dish");
    }
}
