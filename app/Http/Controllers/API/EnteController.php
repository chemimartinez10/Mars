<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ente;
use App\Persona;

class EnteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 
        Persona::join('entes','entes.persona_id','personas.id')
        ->select('*')->orderBy('entes.id','desc')
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
        $id=Persona::max('id');

        $this->validate($request,[
            'razon_soc' => 'required|string',
        ]);

    return Ente::create([
        
      
        'razon_soc' => $request['razon_soc'],
        'descripcion' => $request['descripcion'],
        'persona_id' => $id,
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
        $empleado = Ente::findOrFail($id);

        $empleado->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if($search = \Request::get('q')){
            $entes=Persona::join('entes','entes.persona_id','personas.id')
            ->select('*')->orderBy('entes.id','desc')->where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%")->orWhere('apellido','LIKE',"%$search%")->orWhere('identificacion','LIKE',"%$search%")->orWhere('descripcion','LIKE',"%$search%")->orWhere('razon_soc','LIKE',"%$search%");
            })->paginate();
        }

        return $entes;
    }
}
