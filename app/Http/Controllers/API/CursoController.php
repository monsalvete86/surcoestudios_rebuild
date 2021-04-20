<?php

namespace App\Http\Controllers\API;

use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursoController extends Controller
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
        return Curso::latest()->paginate(5);
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
            'nombre'            => 'required|string|max:450'
            , 'categoria'       => 'required|integer|max:11'
            , 'tutor'           => 'required|integer|max:11'
            , 'duracion'        => 'required|integer'
            , 'tipo_duracion'   => 'required|string|max:300'            
            , 'descripcion'     => 'required|string'
           
        ]);

        return Curso::create([
            'nombre'            => $request['nombre']
            , 'categoria'       => $request['categoria']
            , 'tutor'           => $request['tutor']
            , 'duracion'        => $request['duracion']
            , 'tipo_duracion'   => $request['tipo_duracion']
            , 'img'             => $request['img']
            , 'valor'           => $request['valor']
            , 'descripcion'     => $request['descripcion']
            , 'tipo'            => $request['tipo']
            , 'validez'         => $request['validez']
            , 'tipo_validez'    => $request['tipo_validez']
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
        $curso = Curso::findOrFail($id);
        
        $this->validate($request,[
            'nombre'            => 'required|string|max:450'
            , 'categoria'       => 'required|integer|max:11'
            , 'tutor'           => 'required|integer|max:11'
            , 'duracion'        => 'required|integer'
            , 'tipo_duracion'   => 'required|string|max:300'
            
        ]);

        $curso->update($request->all());
        return ['message' => 'Curso actualizado'];
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

        $curso = Curso::findOrFail($id);
        
        $curso->delete();

        return ['message' => 'Curso eliminado'];
    }

    public function search ()
    {
        if ($search = \Request::get('q')) {
            $cursos = Curso::where(function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%$search%")
                        ->orWhere('tipo_duracion', 'LIKE', "%$search%")
                        ->orWhere('descripcion', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $cursos = Curso::latest()->paginate(5);
        }

        return $cursos;
    }

    public function getCurso ($id)
    {
       
        $curso = Curso::findOrFail($id);

        return $curso;
    }
    public function listaCursos() {
        $curso = Curso::orderBy('nombre')->get();
        return $curso;
    }
}
