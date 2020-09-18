<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $fillable = [
        'id_modelo', 'anno', 'id_color', 'descripcion', 'peso', 'id_combustible', 'id_recurso'
    ];

    function recurso(){
        return $this->belongsTo('App\Recurso');
    }
}