<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Equipo;
use App\Recurso;

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
        Recurso::join('equipos','equipos.recurso_id','recursos.id')
        ->select('*')->orderBy('equipos.id','desc')
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
            'serial' => 'required|string',
            'anno' => 'required|integer',
            'id_color' => 'required|integer',


        ]);

        return Equipo::create([

            'serial' =>$request['serial'],
            'anno' =>$request['anno'],
            'id_color' =>$request['id_color'],
            'id_recurso' => $id

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
        $equipo = Equipo::findOrFail($id);

        $equipo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);

        $equipo->delete();
    }
    public function search()
    {
        if($search = \Request::get('q')){
            $equipos=Recurso::join('equipos','equipos.recurso_id','recursos.id')
            ->select('*')->orderBy('equipos.id','desc')->where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%")->orWhere('anno','LIKE',"%$search%")->orWhere('serial','LIKE',"%$search%")->orWhere('observacion','LIKE',"%$search%");
            })->paginate();
        }

        return $equipos;
    }
}
