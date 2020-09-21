<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movimiento_recurso;
use App\Recurso;
use App\Movimiento;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 
        Recurso::join('movimiento_recursos','movimiento_recursos.recurso_id','recursos.id')->join('movimientos','movimiento_recursos.id_movimiento','movimientos.id')
        ->select('*')->orderBy('movimientos.id','desc')
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
        $id=Movimiento::max('id');

        $this->validate($request,[
            'cantidad' => 'required|numeric',
            'id_recurso' => 'required|integer',
            'id_operacion' => 'required|integer',
            'id_movimiento' => 'required|integer',
            'fecha' => 'required|date',
            'documento' => 'required|string',
            'observacion' => 'required|string',


        ]);

        return Movimiento_recurso::create([

            'cantidad' =>$request['cantidad'],
            'id_recurso' =>$request['id_recurso'],
            'id_operacion' => $request['id_operacion'],
            'id_movimiento' => $id,
            'fecha' =>$request['fecha'],
            'documento' =>$request['documento'],
            'observacion' =>$request['observacion'],

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
        $movimiento_recurso = Movimiento_recurso::findOrFail($id);

        $movimiento_recurso->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimiento_recurso = Movimiento_recurso::findOrFail($id);

        $movimiento_recurso->delete();
    }
}
