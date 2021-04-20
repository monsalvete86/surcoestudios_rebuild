<?php

namespace App\Http\Controllers\API;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
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
        return Categoria::latest()->paginate(5);
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
            'categoria' => 'required|string|max:300'
        ]);

        return Categoria::create([
            'categoria' => $request['categoria']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
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
        $categoria = Categoria::findOrFail($id);

        $this->validate($request,[
            'categoria' => 'required|string|max:300'
        ]);

        $categoria->update($request->all());
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

        $categoria = Categoria::findOrFail($id);
        
        $categoria->delete();

        return ['message' => 'Categoría eliminada'];
    }

    public function search ()
    {
        if ($search = \Request::get('q')) {
            $categorias = Categoria::where(function ($query) use ($search) {
                $query->where('categoria', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $categorias = Categoria::latest()->paginate(5);
        }

        return $categorias;
    }
}
