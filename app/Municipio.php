<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = ['municipio',];

    protected $table = 'municipio';

    public function pais()
    {
        return $this->hasOne('App\City', 'id', 'id_city');
    }
}
