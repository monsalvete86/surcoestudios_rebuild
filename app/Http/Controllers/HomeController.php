<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Categoria;
use App\Curso;
use App\Inscripcion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::where('type','=','author')->orderBy('name', 'asc')->get();
       
        return view('welcome',['users' => $users]);
    }

    public function getListTutoresArray() {
        $tutores = User::where('type','=','author')->select('id','name')->orderBy('name', 'asc')->get();
        $aux_tuts = array();
        
        foreach($tutores as $tutor){    $aux_tuts[$tutor->id] = $tutor->name; }
        return $aux_tuts;
    }

    public function getListCategorisArray() {
        $categorias = Categoria::select('id','categoria')->orderBy('categoria', 'asc')->get();
        $aux_cats = array();
        foreach($categorias as $categoria){    $aux_cats[$categoria->id] = $categoria->categoria; }
        return $aux_cats;
    }

    public function oferta()
    {               
        $cursos = Curso::where('estado','=',1)->where('tipo','=',1)->orderBy('nombre', 'asc')->get();

        return view('oferta',[ 'cursos' => $cursos, 'tutores' => $this->getListTutoresArray(), 'categorias' => $this->getListCategorisArray()]);
    }

    public function diplomados()
    {               
        $cursos = Curso::where('estado','=',1)->where('tipo','=',2)->orderBy('nombre', 'asc')->get();

        return view('diplomados',[ 'cursos' => $cursos, 'tutores' => $this->getListTutoresArray(), 'categorias' => $this->getListCategorisArray()]);
    }
    
    public function detalle(Request $request, $id)
    {
        $curso = array();
        $curso= Curso::where('id','=',$id)->orderBy('nombre', 'asc')->get();
        //var_dump($curso); exit; die;
        $user = auth()->user();
        //$data = $request->session()->all();
        
        return view('detalle', ['curso' => $curso[0], 'tutores' => $this->getListTutoresArray(), 'categorias' => $this->getListCategorisArray(), 'user' => $user]);
    }

    public function dashboard(){
        return view('home');
    }

    public function inscribirme($id){
        $user = auth()->user();
        $nd = getDate();
        $correo_alumno = $user->emai;

        $inscripcion = new Inscripcion();
        $inscripcion->id_curso = $id;
        $inscripcion->id_alumno = $user->id;
        $inscripcion->fecha = $nd['year'].'-'.$nd['mon'].'-'.$nd['mday'];
        $inscripcion->save();
        
        $curso = Curso::findOrFail($id);
/*
        $to = "coordinacion@surcoestudios.com";
        //$to = "ccmonpan@hotmail.com";
        $subject = "Solicitud ingreso al curso";
        $message = " Nombre: ". $user->name."\r\n
         Telefonos: ".$user->telefonos."\r\n
         Correo: ". $user->email."\r\n
         Curso/Diplomado ".$curso->nombre;
        $headers = "From: respuesta@surcoestudio.com" . "\r\n";
        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        mail($to, $subject, $message);

        $to = $correo_alumno;
        $message ="Bienvenido a SURCOLOMBIANA DE ESTUDIOS SAS, \r\n
            En estos momentos estás registrado para iniciar en el grandioso mundo del conocimiento por intermedio de nuestro centro de formación. Ya creaste un usuario y una contraseña (guárdalos ya que te servirán para todo tu proceso formativo). \r\n 
            Estás a un solo paso de INSCRIBIRTE en el proceso formativo (Curso o Diplomado) que más te interese y se ajuste a tus necesidades laborales, profesionales o explorar en nuevos temas de tu interés. \r\n
            \r\n
            Para inscribirte solo debes seguir los siguientes pasos:	\r\n
            \r\n
            1.	Entrar a www.surcoestudios.com \r\n
            2.	Dar click en CURSOS O DIPLOMADOS \r\n
            3.	Escoges el proceso formativo (Curso o Diplomado) de tu interés (Dar Click en VER MÁS) \r\n
            4.	Luego dar click en INSCRIBIRSE \r\n
            5.	Debes CONSIGNAR el valor del CURSO o DIPLOMADO que te interese a la cuenta de BANCOLOMBIA Ahorros 451-282071-75 a nombre de SURCOLOMBIANA DE ESTUDIOS SAS. Nit. 900513118-7 \r\n
            6.	Escaneas el recibo y lo envías al correo coordinacion@surcoestudios.com o una foto al Whatsapp 320 468 8543, siempre indicando tu nombre, cédula y el curso o diplomado al cual estás inscrito. \r\n
            7.	Inmediatamente quedarás habilitado para iniciar tu formación. \r\n
            \r\n
            IMPORTANTE: Si te inscribiste a:  \r\n
            \r\n
            1.	UN CURSO: Al iniciar tu CURSO debes leer todo el contenido, videos e instructivos. Recuerda, tienes las horas indicadas para realizar tu CURSO, ten en cuenta que tú puedes realizarlo en menos tiempo, lo importante es leer detalladamente el contenido, videos y realizar el examen final. \r\n
            Una vez realices el examen, el sistema te mostrará el porcentaje de aprobación de tu CURSO, Recuerda que debes obtener al menos un 65% para que lo apruebes. \r\n
            \r\n
            Para finalizar, debes descargar tu CURSO como se indica en tu plataforma. \r\n
            \r\n
            2.	UN DIPLOMADO: Al iniciar tu DIPLOMADO debes leer cada uno de los 4 MÓDULOS  e instructivos. Recuerda, tienes 1 mes para realizar tu DIPLOMADO, ten en cuenta que tú puedes realizarlo en menos tiempo, lo importante es leer detalladamente cada MÓDULO, todos los contenidos, videos y realizar los exámenes de cada MÓDULO. \r\n

            Una vez realices un examen de cada MÓDULO, el sistema te mostrará un avance en porcentaje de aprobación de tu DIPLOMADO, cuando termines los 4 exámenes, el sistema te mostrará tu calificación total. Recuerda que debes obtener al menos un 65% para que apruebes tu DIPLOMADO. \r\n
            Para finalizar, debes descargar tu DIPLOMADO como se indica en tu plataforma. \r\n
            \r\n
            Cualquier duda o inquietud, puedes contactarnos en coordinacion@surcoestudios.com o al Teléfono 320 468 8543, siempre habrá una persona dispuesta a responder tus inquietudes, sugerencias o reclamos.  \r\n
            ¡Anímate! \r\n
";
         mail($to, $subject, $message);*/
        
        return view('registrado');
    }
}
