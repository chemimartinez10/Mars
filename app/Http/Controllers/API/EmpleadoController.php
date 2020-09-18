<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\Persona;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 
        Persona::join('empleados','empleados.persona_id','personas.id')
        ->select('*')->orderBy('empleados.id','desc')
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
        // $id = DB::table('personas')->max('id');
        $id=Persona::max('id');

        $this->validate($request,[
            'edo_civil'      => 'required|string',
            'genero'         => 'required|integer',
            'fecha_nac'      => 'required|date',
            'fecha_ing'      => 'required|date',
            'cargo'          => 'required|integer',
            'especialidad'   => 'required|integer'
        ]);

    return Empleado::create([
        
      
        'edo_civil' => $request['edo_civil'],
        'genero' => $request['genero'],
        'fecha_nac' => $request['fecha_nac'],
        'fecha_ing' => $request['fecha_ing'],
        'cargo' => $request['cargo'],
        'especialidad' => $request['especialidad'],
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
        $empleado = Empleado::findOrFail($id);

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
            $empleados=Persona::join('empleados','empleados.persona_id','personas.id')
            ->select('*')->orderBy('empleados.id','desc')->where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%")->orWhere('apellido','LIKE',"%$search%")->orWhere('identificacion','LIKE',"%$search%")->orWhere('correo','LIKE',"%$search%");
            })->paginate();
        }

        return $empleados;
    }
}
