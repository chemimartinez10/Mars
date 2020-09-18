<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
        'nombre', 'id_estado', 'id_marca', 'id_tipo', 'cantidad', 'observacion'
    ];

    function equipo(){
        return $this->hasOne('App\Equipo','id_recurso','id');
    }
    function vehiculo(){
        return $this->hasOne('App\Vehiculo','id_recurso','id');
    }
    function articulo(){
        return $this->hasOne('App\Articulo','id_recurso','id');
    }
    function maquinaria(){
        return $this->hasOne('App\Maquinaria','id_recurso','id');
    }
    function movimiento_recurso(){
        return $this->hasMany('App\Movimiento_recurso','id_recurso','id');
    }

    // function elemento_config(){
    //     return $this->belongsTo('App\Elemento_Configuracion');
    // }
}
