<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Bookdetail extends Model
{
    //
      protected $fillable = ['Identificacion','pais_id','Sexo','FechaEntrada','FechaSalida','Noches','Motivo',];


       public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function pais()
    {

        return $this->hasOne('App\Country','id','pais_id');
   	
    }
}
