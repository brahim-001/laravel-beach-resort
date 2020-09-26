<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['total_price','checkin','checkout','name'];

    


      function User()
      {
         return $this->belongsTo('App\User');
      }

    
}