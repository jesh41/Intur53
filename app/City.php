<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
 protected $fillable = ['city',];

    protected $table = 'city';

     public function pais()
    {
        return $this->hasOne('App\Country','id','id_country');
    }

    public function municipio()
    {
        return $this->hasMany('App\Municipio', 'id_municipio', 'id');
    }

}
