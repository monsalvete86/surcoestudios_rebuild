<?php



namespace App\Http\Controllers\API;


use App\Inscripcion;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InscripcionController extends Controller

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

			return Inscripcion::join('cursos','inscripciones.id_curso','=','cursos.id')
			->join('users','inscripciones.id_alumno','=','users.id')
			->select('inscripciones.id as id','cursos.nombre as curso','cursos.id as id_curso', 'users.name as name', 'users.id as id_alumno', 'inscripciones.fecha as fecha', 'inscripciones.estado as estado', 'inscripciones.fec_activa as fec_activa', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_termina as fec_termina')->latest('inscripciones.created_at')->paginate(10);
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

			return Inscripcion::create([

				'id_alumno'            => $request['id_alumno'],
				'id_curso'       => $request['id_curso'],
				'fecha'           => $request['fecha']
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

			$inscripcion = Inscripcion::findOrFail($id);
			



			$inscripcion->update($request->all());
			return ['message' => 'Inscripcion actualizado'];
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


			$inscripcion = Inscripcion::findOrFail($id);
			

			$inscripcion->estado = 0;
			$inscripcion->save();


			return ['message' => 'Inscripcion eliminado'];
	}



	public function activa($id)

	{

		$this->authorize('isAdmin');

		$inscripcion = Inscripcion::findOrFail($id);
		$nd = getDate();
		$inscripcion->estado = 2;
		$inscripcion->fec_activa = $nd['year'].'-'.$nd['mon'].'-'.$nd['mday'];
		$inscripcion->save();
		return ['message' => 'Inscripcion activada'];
	}



	public function search ()
	{
		if ($search = \Request::get('q')) {
			$inscripcions = Inscripcion::leftJoin('users', 'inscripciones.id_alumno', 'users.id')->where(function ($query) use ($search) {

				$query->orWhere('users.name', 'LIKE', "%$search%")
				->orWhere('users.documento', 'LIKE', "%$search%")
				
				;
			})->paginate(15);
		} else {

			$inscripcions = Inscripcion::latest()->paginate(15);
		}
			return $inscripcions;
	}

	public function crearInscripcion(Request $request) {

		$inscripcion = new Inscripcion();
		$inscripcion->id_alumno = $request->id_alumno;
		$inscripcion->id_curso = $request->id_curso;
		$inscripcion->fec_activa = $request->fec_activa;
		$inscripcion->fec_termina = $request->fec_termina;
		$inscripcion->fecha = $request->fec_activa;
		$inscripcion->resultado = $request->resultado; 
		$inscripcion->fec_vence = $request->fec_vence;
		$inscripcion->duracion_nro = $request->duracion_nro;
		$inscripcion->duracion_tipo = $request->duracion_tipo;
		$inscripcion->estado = 3;       

		$inscripcion->save();       
		return $inscripcion;
	}

	public function getListTutoresArray() {
		$tutores = User::where('type','=','author')->select('id','name')->orderBy('name', 'asc')->get();
		$aux_tuts = array();
		foreach($tutores as $tutor){    $aux_tuts[$tutor->id] = $tutor->name;}
		return $aux_tuts;
	}

	public function getListCursosArray() {

			$tutores = User::where('type','=','author')->select('id','name')->orderBy('name', 'asc')->get();
			$aux_tuts = array();
			foreach($tutores as $tutor){    $aux_tuts[$tutor->id] = $tutor->name;}

			return $aux_tuts;
	}



	public function getInscripciones () {


			$inscripciones = Inscripcion::join('users','inscripciones.id_alumno','=','users.id')

			->join('cursos','inscripciones.id_curso','=','cursos.id')

			->select('inscripciones.id as id','cursos.nombre as curso','cursos.id as id_curso', 'users.name as name', 'users.id as id_alumno', 'inscripciones.fecha as fecha', 'inscripciones.estado as estado', 'inscripciones.fec_activa as fec_activa', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_termina as fec_termina')

			->orderBy('inscripciones.id', 'desc')->paginate(15);
			return ['inscripciones' => $inscripciones, 'tutores' =>$this->getListTutoresArray()];
	}



	public function findMisInscripciones($buscar = null) {

			$user = \Auth::user();
			if($buscar != '') {

					$inscripciones = Inscripcion::join('users','inscripciones.id_alumno','=','users.id')

					->join('cursos','inscripciones.id_curso','=','cursos.id')

					->where('id_alumno', '=', $user->id)

					->where('cursos.nombre', 'like', "%$buscar%")                     

					->select('inscripciones.id as id','cursos.nombre as curso','cursos.id as id_curso', 'users.name as name', 'users.id as id_alumno', 'inscripciones.fecha as fecha', 'inscripciones.estado as estado', 'inscripciones.fec_activa as fec_activa', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_termina as fec_termina')

					->orderBy('inscripciones.id', 'desc')->paginate(20);
			}

			else {

					

					$inscripciones = Inscripcion::join('users','inscripciones.id_alumno','=','users.id')

					->join('cursos','inscripciones.id_curso','=','cursos.id')

					->where('id_alumno', '=', $user->id)

					->select('inscripciones.id as id','cursos.nombre as curso','cursos.id as id_curso', 'users.name as name', 'users.id as id_alumno', 'inscripciones.fecha as fecha', 'inscripciones.estado as estado', 'inscripciones.fec_activa as fec_activa', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_cancela as fec_cancela', 'inscripciones.fec_termina as fec_termina')

					->orderBy('inscripciones.id', 'desc')->paginate(20);
			}

			return $inscripciones;
	}



	public function cancelarMisInscripciones($id){

		$inscripcion = Inscripcion::findOrFail($id);
		$nd = getDate();
		$inscripcion->estado = 0;
		$inscripcion->fec_cancela = $nd['year'].'-'.$nd['mon'].'-'.$nd['mday'];
		$inscripcion->save();
	}
}
