<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
 protected $fillable = ['city',];

     public function pais()
    {
        return $this->hasOne('App\Country','id','id_country');
    }

}
