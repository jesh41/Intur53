<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'id_cathotel',
        'id_catactivity',
        'id_city',
        'id_municipio',
        'id_user',
    ];

    protected $table = 'hotel';

    public function user()
    {
        return $this->belongsTo('App\User');//, 'id', 'id_user');
    }

    public function catactivity()
    {
        return $this->hasOne('App\Catactivity', 'id', 'id_catactivity');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'id_city');
    }

    public function municipio()
    {
        return $this->hasOne('App\Municipio', 'id', 'id_municipio');
    }

    public function cathotel()
    {
        return $this->hasOne('App\Cathotel', 'id', 'id_cathotel');
    }


}
