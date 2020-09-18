<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'edo_civil', 'genero', 'fecha_nac', 'fecha_ing', 'cargo', 'especialidad', 'persona_id'
    ];

    function persona(){
        return $this->belongsTo('App\Persona');
    }
}
