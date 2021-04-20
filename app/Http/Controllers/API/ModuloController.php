<?php

namespace App\Http\Controllers\API;

use App\Modulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuloController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
        return Modulo::latest()->paginate(5);
        //}
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
            'modulo'            => 'required|string|max:450'
            , 'contenido'     => 'required|string'
            , 'video'     => 'string'
            , 'id_curso'       => 'required'     
            , 'texto_prueba' => 'required'       
        ]);

        return Modulo::create([
            'modulo'            => $request['modulo']
            , 'contenido'       => $request['contenido']
            , 'id_curso'           => $request['id_curso']
            , 'video'        => $request['video']
            , 'texto_prueba' => $request['texto_prueba']
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
        $curso = Modulo::findOrFail($id);
        
        $this->validate($request,[
            'modulo'            => 'required|string|max:450'
            , 'contenido'     => 'required|string'
            , 'video'     => 'string'
            , 'id_curso'       => 'required'      
            , 'texto_prueba'       => 'required'         
        ]);

        $curso->update($request->all());
        return ['message' => 'Modulo actualizado'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $curso = Modulo::findOrFail($id);
        
        $curso->delete();

        return ['message' => 'Modulo eliminado'];
    }

    public function search ()
    {
        if ($search = \Request::get('q')) {
            $cursos = Modulo::where(function ($query) use ($search) {
                $query->where('modulo', 'LIKE', "%$search%")
                        ->orWhere('contenido', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $cursos = Modulo::latest()->paginate(5);
        }

        
    }

    public function getModules($id_curso) {
       
        $modulos = Modulo::where(function ($query) use ($id_curso) {
            $query->where('id_curso', 'LIKE', "$id_curso");
        })->paginate(20);
        
        return $modulos;
    }
}
