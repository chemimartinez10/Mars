<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'id_destinatario', 'id_usuario','id_tipoMovimiento', 'motivo', 'observacion'
    ];

    function movimiento_recurso(){
        return $this->hasMany('App\Movimiento_recurso', 'id_movimiento', 'id');
    }
    function id_usuario(){
        return $this->belongsTo('App\User');
    }
    // function elemento_config(){
    //     return $this->belongsTo('App\Elemento_Configuracion');
    // }
}
