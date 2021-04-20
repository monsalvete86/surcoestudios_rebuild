<?php
include('class.conexion.php');
//@ini_set('display_errors', 'on');
if(isset($_POST['action'])){
	$accion = $_POST['action'];
	$accion();
}
function asignarcurso($d,$m,$a, $estado, $estudiante, $curso)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "INSERT INTO `alumnocurso`(`id_alumno`, `id_curso`, `dia`, `mes`, `año`, `estado`) VALUES ($estudiante, $curso,'$d','$m','$a', '$estado')";
	if($db->query($sql))
	{
		return true;
	}
	else
	{
		return false;
	}
	
		
}
function hayRespuestas($id_alumno,$id_prueba)
{
    $db = new Conexion();
	$db->set_charset('utf8');
	$sql = "select respuesta from respuestas where id_curso=$id_prueba and id_alumno=$id_alumno";
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
	{
		while($row = $consulta->fetch_array())
		{
			if(isset($row[0]))
				return 1;
			else 
				return 0;
		}
	}
}
function editar_estudiante($n1,$n2=NULL,$a1,$a2=NULL,$ced,$exp,$tel=NULL,$email=NULL,$emp)
{
	
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "UPDATE alumno SET nombre1 = '$n1', nombre2 = '$n2', apellido1 = '$a1', apellido2 = '$a2', cedula = '$ced', lugar_expedicion = '$exp', telefono = '$tel', email = '$email', id_empresa = '$emp' WHERE cedula = '$ced'";
	if($db->query($sql))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function eliminar_estudiante($id)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "DELETE FROM alumno WHERE id = '$id'";
	if($db->query($sql))
	{
		$sql2 = "DELETE FROM alumnocurso WHERE id_alumno = '$id'";
		if($db->query($sql))
			return true;
		else 
			return false;
	}
	else
		return false;		
}
function getInscripcion($id)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "SELECT *  FROM inscripciones WHERE id = $id";
	$resultado = array();
	$consulta = $db->query($sql);

	$datos = $consulta->fetch_array();
	return $datos;
	
}
function alumnocurso($id)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "SELECT *  FROM inscripciones WHERE id = $id";
	$resultado = array();
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
	{
		while($datos = $consulta->fetch_array())
		{
			$resultado['dia'] = $datos['dia'];
			$resultado['mes'] = $datos['mes'];
			$resultado['año'] = $datos['año'];
			$resultado['estado'] = $datos['estado'];
		}
		return $resultado;
	}
	else
	{
		return false;		
	}
}
function estudiante($id,$ced)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	 $sql = "SELECT *  FROM users WHERE id = $id";
	
	$result = array();
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
		return $consulta;
	else
		return false;		
}

function get_preguntas($id_curso)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "select * from preguntasxpruebas where id_prueba=$id_curso order by id_pregunta";
	$resultado = array();
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
		return $consulta;
	else
		return false;
	   
}
function get_opc_preguntas($id_curso)
{
    $db = new Conexion();
	$db->set_charset('utf8');
	$sql = "select * from preguntas_pruebas where prueba=$id_curso order by id_pregunta,orden";
	$consulta = $db->query($sql);
	$preguntas=array();
	while($fila = $consulta->fetch_array())
	{
        $preguntas[$fila['id_pregunta']][$fila['id_pp']]=$fila;
    }
    return $preguntas;
}
function cursos()
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "SELECT *  FROM cursos";
	$consulta = $db->query($sql);
	return $consulta;
		
} 
function curso($curso)
{	
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "SELECT *  FROM cursos where id = ".$curso."";
	$consulta = $db->query($sql);
	return $consulta;
	
}
function get_respuestas_prueba($id_prueba,$id_alumno)
{
    $db = new Conexion();
	$db->set_charset('utf8');
	$sql = "select * from respuestas where id_alumno=$id_alumno and id_curso=$id_prueba";
	$consulta = $db->query($sql);
	$respuestas_p=array();
    while($fila = $consulta->fetch_array())
	{       
        $respuestas_p[$fila['pregunta']]=$fila['respuesta'];
    }
    return $respuestas_p;
}

function crear_estudiante($n1,$n2=NULL,$a1,$a2=NULL,$ced,$exp,$tel=NULL,$email=NULL,$fec,$emp)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "INSERT INTO `alumno`(`cedula`, `lugar_expedicion`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `telefono`, `email`, `fecha_crea`, `id_empresa`) VALUES ('$ced', '$exp', '$n1', '$n2','$a1','$a2', '$tel', '$email', '$fec', '$emp')";
	if($db->query($sql))
		return true;
	else
		echo "no se pudo crear el estudiante";		
}
function listarestudiantes()
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "SELECT *  FROM alumno ORDER BY id DESC";
	$consulta = $db->query($sql);
	return $consulta;		
}
function listar_incripciones($fecha_ini,$fecha_fin, $estado)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$filt_est="";
	
	if($estado!=""){$filt_est="and estado = '$estado'";}
	
	$sql = "SELECT CAST(dia as int) as dia, CAST(mes AS int) as mes, CAST(año AS int) as año, estado, nombre1, nombre2, apellido1, apellido2, cedula, fec_crea ,curso
	FROM alumnocurso,alumno  , cursos
	WHERE id_alumno = alumno.id and cursos.id = alumnocurso.id_curso and año !='' and dia!='' and mes!='' and año > 2000 and dia>0  and cast(CONCAT(año,'-',mes,'-',dia) as date) >= '$fecha_ini'
	and cast(CONCAT(año,'-',mes,'-',dia) as date) <= '$fecha_fin' $filt_est
	order by año desc, mes desc, dia desc, cedula, apellido1, apellido2, nombre1, nombre2";
	
	//echo $sql;
	$consulta = $db->query($sql);
	return $consulta;		
}
function getEstados()
{
    $db = new Conexion();
	$db->set_charset('utf8');
	$cons="select estado from alumnocurso where estado!='' group by estado order by estado ";
	
	$consulta = $db->query($cons);
	return $consulta;		
}
function validar_accesos_estudiante($usu,$psw)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$token = MD5($usu);
	$psw_md5 = MD5($psw);	
	$sql = 'SELECT `cedula`, `clave` FROM `alumno` WHERE cedula = "'.$usu.'"';
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
	{
		session_start();
		while($row = $consulta->fetch_array())
		{
			if(($row['clave'] == ''))
			{
				$cons='UPDATE alumno SET clave="'.$token.'" WHERE cedula = "'.$usu.'"';
				
				if($consulta2 = $db->query($cons))
				{
					return $_SESSION['alumno'] = $usu;
					return true;
				}
				else
				{
					echo 'no update';
				}
			}
			else if($row['clave'] == $psw_md5)
			{
					return $_SESSION['alumno'] = $usu;
					return true;
			}
		}	
	}
	
}

function consultarAlumno($alumno)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = 'SELECT * FROM alumno WHERE cedula="'.$alumno.'"';
	$consulta = $db->query($sql);
	$array = array();
	while($row = $consulta->fetch_array())
	{
		$array = $row;
	}	
	return $array;	
}

function resultadoPrueba($id_alumno, $curso, $resultado)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = 'SELECT * FROM `resultados_pruebas` WHERE `id_alumno`="'.$id_alumno.'" AND `curso`="'.$curso.'"';
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
	{
		$sql2 = 'UPDATE `resultados_pruebas` SET `resultado`="'.$resultado.'" WHERE `id_alumno`="'.$id_alumno.'" AND `curso`="'.$curso.'"';
		$consulta2 = $db->query($sql2);
		return $consulta2;
	}
	else
	{
		$sql3 = "INSERT INTO `resultados_pruebas`(`id_alumno`, `curso`, `resultado`) VALUES ('$id_alumno', '$curso', '$resultado')";
		$consulta3 = $db->query($sql3);
		return $consulta3;
	}
}
function respuestasPrueba($id_alumno,$id_prueba,$respuestas)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "delete from respuestas where id_curso=$id_prueba and id_alumno=$id_alumno";
	$res = $db->query($sql);
	foreach($respuestas as $clave=>$resp)
	{
		$sql2="insert into respuestas (id_alumno,id_curso,pregunta,respuesta) values ($id_alumno,$id_prueba,'$clave','$resp')";
		$res2=$db->query($sql2);
	}
}
function consultarResultadoPrueba($id_alumno, $curso)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = 'SELECT * FROM `resultados_pruebas` WHERE `id_alumno`="'.$id_alumno.'" AND `curso`="'.$curso.'"';
	$res = $db->query($sql);
	$row = $res->fetch_array();
	return $row;
}

function listar_empresas()
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = 'SELECT *  FROM empresa ORDER BY empresa ASC';
	$res = $db->query($sql);
	return $res;
}
function consultar_empresa($id)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = 'SELECT *  FROM empresa WHERE id= "'.$id.'"';
	$res = $db->query($sql);
	return $res;
}
function crear_empresa($n_emp,$nit_emp,$tel_emp){
	
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = "INSERT INTO `empresa`(`empresa`, `nit_empresa`, `telefono_empresa`) VALUES ('$n_emp', '$nit_emp', '$tel_emp')";
	if($res = $db->query($sql))
		return true;
	else
		echo "no se pudo crear la empresa";
}
function validar_accesos($usu,$psw)
{
	$psw = MD5($psw);
	$db = new Conexion();
	$db->set_charset('utf8');
	$sql = 'SELECT * FROM users WHERE username = "'.$usu.'" AND password = "'.$psw.'" AND activate = "1"';
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result <=0)
		return false;
	else
		return true;
				
}

function datosusuario($usu)
{
	$db = new Conexion();
	$db->set_charset('utf8');
	$arr = array();
	$sql = "SELECT * FROM users WHERE username = '".$usu."'";
	$consulta = $db->query($sql);
	$result = mysqli_num_rows($consulta);
	if($result > 0)
	{
		
		while($data = $consulta->fetch_array())
		{
			$arr['primer_nombre']= $data['primer_nombre'];
			$arr['segundo_nombre']= $data['segundo_nombre'];
			$arr['primer_apellido']= $data['primer_apellido'];
			$arr['segundo_apellido']= $data['segundo_apellido'];
			$arr['ceula']= $data['cedula'];
			$arr['id_roll']= $data['id_roll'];
			$arr['direccion']= $data['direccion'];
			$arr['telefono']= $data['telefono'];
			$arr['email']= $data['email'];
		}
	}	
	return $arr;
}

function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }
 
    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }
 
            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                             
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                             
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                             
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO
 
        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
					
						if ($xdecimales != '00')
							$xcadena = "CERO $xdecimales/100 M.N.";
						else
							$xcadena = "CERO";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
						if ($xdecimales != '00')
						    $xcadena = "UN $xdecimales/100 M.N. ";
						else
							$xcadena = "UN";	
                    }
                    if ($xcifra >= 2) {
						if ($xdecimales != '00')
						    $xcadena.= " $xdecimales/100 M.N. "; //
						else
							$xcadena .= "";	
                       
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}
 
// END FUNCTION
 
	function subfijo($xx)
	{ // esta función regresa un subfijo para la cifra
		$xx = trim($xx);
		$xstrlen = strlen($xx);
		if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
			$xsub = "";
		//
		if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
			$xsub = "MIL";
		//
		return $xsub;
	}
	function listado_general_xls(){
		
		$db = new Conexion();
		$db->set_charset('utf8');
		
		$sql = 'select alumno.id, alumno.cedula,  alumno.lugar_expedicion, alumno.nombre1, alumno.nombre2, alumno.apellido1, alumno.apellido2, alumno.telefono, alumno.email, alumno.fecha_crea, empresa.empresa, empresa.nit_empresa, empresa.telefono_empresa, cursos.curso, alumnocurso.dia, alumnocurso.mes, alumnocurso.año, alumnocurso.estado
	from alumno 
	left join alumnocurso 
			on alumno.id = alumnocurso.id_alumno
	left join cursos
		on alumnocurso.id_curso = cursos.id
	left join empresa
			on empresa.id = alumno.id_empresa';
		$consulta = $db->query($sql);
		$result = mysqli_num_rows($consulta);
		if($result > 0)
			return $consulta;
		else
			return false;
	}
?>