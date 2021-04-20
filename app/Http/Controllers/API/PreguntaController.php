<?php

namespace App\Http\Controllers\API;

use App\Pregunta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreguntaController extends Controller
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
        return Pregunta::latest()->paginate(5);
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
            'pregunta' => 'required|max:450'
            , 'respuesta' => 'required|max:450'
        ]);

        return Pregunta::create([
            'pregunta' => $request['pregunta']
            , 'respuesta' => $request['respuesta']
            , 'id_modulo' => $request['id_modulo']
            , 'tipo' => $request['tipo']
            , 'a' => $request['a']? $request['a']: ''
            , 'b' => $request['b']? $request['b']: ''
            , 'c' => $request['c']? $request['c']: ''
            , 'd' => $request['d']? $request['d']: ''
            , 'e' => $request['e']? $request['e']: ''
            , 'f' => $request['f']? $request['f']: ''
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
        $pregunta = Pregunta::findOrFail($id);

        $this->validate($request,[
            'pregunta' => 'required|max:450'
            , 'respuesta' => 'required|max:450'
        ]);
        
        $pregunta->pregunta = $request['pregunta'];
        $pregunta->respuesta = $request['respuesta'];
        $pregunta->id_modulo = $request['id_modulo'];
        $pregunta->tipo = $request['tipo'];
        $pregunta->a = $request['a']? $request['a']: ''; 
        $pregunta->b = $request['b']? $request['b']: ''; 
        $pregunta->c = $request['c']? $request['c']: '';
        $pregunta->d = $request['d']? $request['d']: ''; 
        $pregunta->e = $request['e']? $request['e']: '';
        $pregunta->f = $request['f']? $request['f']: '';

        
        $pregunta->save();
        return ['message' => 'Pregunta actualizado'];
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

        $pregunta = Pregunta::findOrFail($id);
        
        $pregunta->delete();

        return ['message' => 'Pregunta eliminado'];
    }

    public function borrarPregunta($id)
    {
        $this->authorize('isAdmin');

        $pregunta = Pregunta::findOrFail($id);
        
        $pregunta->delete();

        return ['message' => 'Pregunta eliminado'];
    }


    public function search ()
    {
        if ($search = \Request::get('q')) {
            $preguntas = Pregunta::where(function ($query) use ($search) {
                $query->where('pregunta', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $preguntas = Pregunta::latest()->paginate(100);
        }

        return $preguntas;
    }

    public function getPreguntas ($id)
    {
        
        $preguntas = Pregunta::where(function ($query) use ($id) {
            $query->where('id_modulo', 'LIKE', "%$id%");
        })->paginate(100);
       

        return $preguntas;
    }

    public function getPreguntasArray ($id_modulo)
    {
        $preguntas = Pregunta::where('id_modulo','=',$id_modulo)->orderBy('id','asc')->paginate(200);
        
        $aux_preguntas = array();
        
        foreach($preguntas as $pregunta){    
            
            $aux_preguntas[] = array($pregunta->id, $pregunta->respuesta);     
        }    
            
        $aux2 = array();
        $respuestas = array();
        foreach($aux_preguntas as $rc){
            $aux2[$rc[0]] = '';
            $respuestas[$rc[0]] = $rc[1];
        }
        return ["preguntas" => $preguntas, "listado_respuestas" => $aux2, "respuestas" => $respuestas ];
    }

    
}
