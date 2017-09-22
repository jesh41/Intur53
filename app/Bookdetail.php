<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Bookdetail extends Model
{
    //
    protected $fillable = [
        'Identificacion',
        'pais_id',
        'Sexo',
        'FechaEntrada',
        'FechaSalida',
        'Noches',
        'Motivo',
        'created_at',
    ];


       public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function pais()
    {

        return $this->hasOne('App\Country','id','pais_id');
   	
    }

      public function sexo()
    {

        return $this->hasOne('App\Sex','id','sexo_id');
    
    }

       public function motivo()
    {

        return $this->hasOne('App\Reason','id','motivo_id');
    
    }


}
