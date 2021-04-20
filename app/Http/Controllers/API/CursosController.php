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
        /*
        $this->validate($request,[
            'curso' => 'required|string|max:300'
        ]);*/

        return Curso::create([
            'curso' => $request['curso']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
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

        /*$this->validate($request,[
            'curso' => 'required|string|max:300'
        ]);*/

        $curso->update($request->all());
        return ['message' => 'Categoría actualizada'];
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
                $query->where('nombre', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $cursos = Curso::latest()->paginate(5);
        }

        return $cursos;
    }
}
