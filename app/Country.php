<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['country',];
    protected $table = 'country';

     public function region()
    {
        return $this->hasOne('App\Region','id','id_region');
    }

    public function city()
    {
    	return $this->hasMany('App\City','id_country','id');

    }


}
