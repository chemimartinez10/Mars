<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Persona::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'correo'    => 'required|string|email|max:191|unique:personas',
        // ]);

        $this->validate($request,[
            'nombre'         => 'required|string',
            'apellido'       => 'required|string',
            'identificacion' => 'required|string|max:13',
            'direccion'      => 'required|string',
            'telefono'       => 'string|max:32',
            'correo'         => 'required|string|email|unique:personas'
        ]);

    return Persona::create([

      
        'nombre' => $request['nombre'],
        'apellido' => $request['apellido'],
        'identificacion' => $request['identificacion'],
        'direccion' => $request['direccion'],
        'telefono' => $request['telefono'],
        'correo' => $request['correo'],
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
        $persona = Persona::findOrFail($id);

        $persona->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    

        $persona = Persona::findOrFail($id);

        //Borrar usuario
        
        $persona->delete();
    }
}
