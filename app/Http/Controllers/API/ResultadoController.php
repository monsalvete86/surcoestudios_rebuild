<?php

namespace App\Http\Controllers\API;

use App\Resultado;
use App\Modulo;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultadoController extends Controller
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
        return Resultado::latest()->paginate(5);
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
            'Resultado' => 'required|string|max:300'
        ]);

        return Resultado::create([
            'Resultado' => $request['Resultado']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resultado  $Resultado
     * @return \Illuminate\Http\Response
     */
    public function show(Resultado $Resultado)
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
        $Resultado = Resultado::findOrFail($id);

        $this->validate($request,[
            'Resultado' => 'required|string|max:300'
        ]);

        $Resultado->update($request->all());
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

        $Resultado = Resultado::findOrFail($id);
        
        $Resultado->delete();

        return ['message' => 'Resultado eliminada'];
    }

    public function search ()
    {
        if ($search = \Request::get('q')) {
            $Resultados = Resultado::where(function ($query) use ($search) {
                $query->where('Resultado', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $Resultados = Resultado::latest()->paginate(5);
        }

        return $Resultados;
    }

    public function getModules($id_curso) {
               
        $modulos = Modulo::where('id_curso','=',$id_curso)        
        ->get();
        $aux_modulos = array();
        foreach($modulos as $modulo){    $aux_modulos[$modulo->id] = $modulo->id; }
        
        return $aux_modulos;
    }

    public function getResultModules( $id_inscripcion, $id_curso){
        $user = \Auth::user();
        $modulos = $this->getModules($id_curso);
        
        $resultados = Resultado::where('id_alumno','=',$user->id)    
        ->where('id_inscripcion', '=', $id_inscripcion)    
        ->get();
        
        $aux_results = array();
        foreach($resultados as $resultado){    $aux_results[$resultado->id_modulo] = $resultado; }
        
        $resultadosxModulos = array();
        $ban_todos = 1;
        $sumatoria = 0;
        $cont_modulos = 0;
        foreach($modulos as $modulo) {
            $cont_modulos++;
            if(isset($aux_results[$modulo])){
                $sumatoria += $aux_results[$modulo]->resultado;
                $resultadosxModulos[$modulo] = $aux_results[$modulo];    
            }
            else {
                $ban_todos = 0;
                $resultadosxModulos[$modulo] = '';
            }            
        }
        $promedio = round(($sumatoria / $cont_modulos),0);
        
        $ND = getDate();
        if($ban_todos == 1 && $promedio > 65) {
            $inscripcion = Inscripcion::findOrFail($id_inscripcion);
            $inscripcion->estado=3;
            $inscripcion->resultado=$promedio;
            $inscripcion->fec_termina =$ND['year'].'-'.$ND['mon'].'-'.$ND['mday'];
            $inscripcion->save();
        }
        return $resultadosxModulos;
    }
    
    public function estadoCurso($id_curso) {

    }
    
    
    public function responder(Request $request) {

        $cont_preg = 0; $correctas = 0;
        $aux_res_cliente = $request->respuestas_clientes;
        foreach($request->repuestas as $key => $valor){
            $cont_preg++;
            if($aux_res_cliente[$key] == $valor){
                $correctas++;
            }
            //echo " --- valor = ".$valor;
        }
        $resultado_total = round((($correctas / $cont_preg) * 100),0) ;
        //echo "preguntas =$cont_preg correctas = $correctas $resultado";
        $estdo_examen = 0;


        if($resultado_total>65) {
            $estdo_examen = 1;
        }

        $ND = getDate();
        
        $user = \Auth::user();
        $resultado_aux = Resultado::where('id_modulo','=',$request->id_modulo)
        ->select('id')
        ->where('id_alumno','=',$user->id)    
        ->where('id_inscripcion', '=', $request->id_inscripcion)    
        ->first();
        
        if(isset($resultado_aux) && isset($resultado_aux->id)) {
            $resultado = Resultado::findOrFail($resultado_aux->id);            
        } else {
            $resultado = new Resultado();
            
        }
        
        $resultado->id_alumno = $user->id;
        $resultado->id_modulo = $request->id_modulo;
        $resultado->preguntas = $cont_preg;
        $resultado->respondidas	 = $correctas;
        $resultado->resultado = $resultado_total;
        $resultado->estado_eva = $estdo_examen;
        $resultado->fecha_realiz = $ND['year'].'-'.$ND['mon'].'-'.$ND['mday'];        
        $resultado->id_inscripcion = $request->id_inscripcion;
        $resultado->save();
        
        return ['message' => 'Registro actualizado'];
    }

}
