<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email','email_verified_at','password'];

    function Reservation()
      {
         return $this->hasMany('App\Reservation');
      }
}
