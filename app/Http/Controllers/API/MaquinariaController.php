<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Maquinaria;
use App\Recurso;

class MaquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 
        Recurso::join('maquinarias','maquinarias.recurso_id','recursos.id')
        ->select('*')->orderBy('maquinarias.id','desc')
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
            'pasajeros' => 'required|numeric',
            'color' => 'required|integer',
            'combustible' => 'required|integer',
            'modelo' => 'required|integer',


        ]);

        return Maquinaria::create([

            'descripcion' =>$request['descripcion'],
            'anno' =>$request['anno'],
            'peso' =>$request['peso'],
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
        $maquinaria = Maquinaria::findOrFail($id);

        $maquinaria->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maquinaria = Maquinaria::findOrFail($id);

        $maquinaria->delete();
    }
    public function search()
    {
        if($search = \Request::get('q')){
            $maquinarias=Recurso::join('maquinarias','maquinarias.recurso_id','recursos.id')
            ->select('*')->orderBy('maquinarias.id','desc')->where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%")->orWhere('anno','LIKE',"%$search%")->orWhere('descripcion','LIKE',"%$search%")->orWhere('peso','LIKE',"%$search%");
            })->paginate();
        }

        return $maquinarias;
    }
}
