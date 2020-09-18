<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movimiento;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the suck my dick.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movimiento::latest()->paginate(5);
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
            'id_usuario'    => 'required|integer',
            'id_destinatario'    => 'required|integer',
            'observacion'    => 'required|text',
            'motivo'    => 'required|string'
        ]);

    return Movimiento::create([

      
        'id_destinatario' => $request['id_destinatario'],
        'id_usuario' => $request['id_usuario'],
        'observacion' => $request['observacion'],
        'motivo' => $request['motivo'],
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
        $movimiento = Movimiento::findOrFail($id);

        $movimiento->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        $movimiento->delete();
    }
    public function search()
    {
        if($search = \Request::get('q')){
            $movimientos=Movimiento::select('*')->orderBy('movimientos.id','desc')->where(function($query) use ($search){
                $query->where('motivo','LIKE',"%$search%")->orWhere('observacion','LIKE',"%$search%");
            })->paginate();
        }

        return $movimientos;
    }
}
