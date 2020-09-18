<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'material', 'id_color', 'id_recurso'
    ];

    function recurso(){
        return $this->belongsTo('App\Recurso');
    }
}
