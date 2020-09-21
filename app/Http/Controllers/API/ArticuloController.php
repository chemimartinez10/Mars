<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulo;
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
        Recurso::join('articulos','articulos.recurso_id','recursos.id')
        ->select('*')->orderBy('articulos.id','desc')
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
            'material' => 'required|string',
            'color' => 'required|integer',


        ]);

        return Articulo::create([

            'material' =>$request['material'],
            'id_color' =>$request['color'],
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
        $articulo = Articulo::findOrFail($id);

        $articulo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);

        $articulo->delete();
    }
    public function search()
    {
        if($search = \Request::get('q')){
            $articulos=Recurso::join('articulos','articulos.recurso_id','recursos.id')
            ->select('*')->orderBy('equipos.id','desc')->where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%")->orWhere('material','LIKE',"%$search%");
            })->paginate();
        }

        return $articulos;
    }
}
