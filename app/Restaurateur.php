<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Restaurateur extends Authenticatable
{
    use Notifiable;

    public function getRestaurant(){
        return $this->hasOne("App\Restaurant");
    }
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
