<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'placa','pasajeros', 'anno','km','id_modelo', 'id_color', 'id_tipoVehiculo', 'id_combustible', 'id_recurso'
    ];

    function recurso(){
        return $this->belongsTo('App\Recurso');
    }
}