<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $fillable = ['nombre', 'direccion', 'telefono', 'id_cathotel', 'id_catactivity', 'id_city', 'id_user',];

    protected $table = 'hotel';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
