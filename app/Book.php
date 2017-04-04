<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
      protected $fillable = ['Obersevacion','Mes','Anio','FechaElaborado',];


 public function user()
    {
        return $this->belongsTo('App\User');
    }


 public function book()
    {
        return $this->hasMany('App\Bookdetail');
    }

}
