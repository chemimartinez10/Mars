<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'identificacion', 'direccion', 'telefono', 'correo'
    ];

    function empleado(){
        return $this->hasOne('App\Empleado','persona_id','id');
    }
    
    function ente(){
        return $this->hasOne('App\Ente','persona_id','id');
    }



}
