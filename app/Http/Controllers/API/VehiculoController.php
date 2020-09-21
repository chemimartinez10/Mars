<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vehiculo;
use App\Recurso;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 
        Recurso::join('vehiculos','vehiculos.recurso_id','recursos.id')
        ->select('*')->orderBy('vehiculos.id','desc')
        ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id=Recurso::max('id');

        $this->validate($request,[
            'placa' => 'required|string',
            'anno' => 'required|integer',
            'pasajeros' => 'required|integer',
            'km' => 'required|integer',
            'tipoVehiculo' => 'required|integer',
            'color' => 'required|integer',
            'combustible' => 'required|integer',
            'modelo' => 'required|integer',


        ]);

        return Vehiculo::create([

            'placa' =>$request['placa'],
            'anno' =>$request['anno'],
            'pasajeros' =>$request['pasajeros'],
            'km' =>$request['km'],
            'id_tipoVehiculo' =>$request['tipoVehiculo'],
            'id_color' =>$request['color'],
            'id_combustible' =>$request['combustible'],
            'id_modelo' =>$request['modelo'],
            'id_recurso' =>$id,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->delete();
    }
    public function search()
    {
        if($search = \Request::get('q')){
            $vehiculos=Recurso::join('vehiculos','vehiculos.recurso_id','recursos.id')
            ->select('*')->orderBy('vehiculos.id','desc')->where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%")->orWhere('anno','LIKE',"%$search%")->orWhere('placa','LIKE',"%$search%")->orWhere('pasajeros','LIKE',"%$search%")->orWhere('km','LIKE',"%$search%");
            })->paginate();
        }

        return $vehiculos;
    }
}
