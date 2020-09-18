<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'serial', 'anno', 'id_color', 'id_recurso'
    ];

    function recurso(){
        return $this->belongsTo('App\Recurso');
    }
    // function color(){
    //     return $this->belongsTo('App\Elemento_Configuracion');
    // }

}
