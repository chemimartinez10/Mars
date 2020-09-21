<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recurso;

class RecursoController extends Controller
{
    /**
     * Display a listing of the suck my dick.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Recurso::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'    => 'required|string',
            'observacion'    => 'required|string',
            'cantidad'    => 'required|numeric'
        ]);

    return Recurso::create([

      
        'nombre' => $request['nombre'],
        'cantidad' => $request['cantidad'],
        'observacion' => $request['observacion'],
        'id_marca' => $request['marca'],
        'id_tipo' => $request['tipo'],
        'id_estado' => $request['estado'],
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
        $recurso = Recurso::findOrFail($id);

        $recurso->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recurso = Recurso::findOrFail($id);

        $recurso->delete();
    }
}
