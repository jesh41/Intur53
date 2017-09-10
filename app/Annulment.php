<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

//reparado
class Annulment extends Model
{
  protected $fillable = ['Obersevacion',];   

      public function book()
    {
        return $this->belongsTo('App\Book');
    }

}
