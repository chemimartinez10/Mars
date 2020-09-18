<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_recurso extends Model
{
    protected $fillable = [
        'cantidad','id_recurso', 'id_operacion','fecha' ,'id_movimiento', 'documento', 'observacion'
    ];

    function movimiento(){
        return $this->belongsTo('App\Movimiento');
    }
    function recurso(){
        return $this->belongsTo('App\Recurso');
    }
}
