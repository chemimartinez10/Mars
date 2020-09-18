<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ente extends Model
{
    protected $fillable = [
        'razon_soc', 'descripcion', 'persona_id'
    ];

    function persona(){
        return $this->belongsTo('App\Persona');
    }
}
