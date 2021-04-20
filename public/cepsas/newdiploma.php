<?php 
include('defines.php');
include('tools/fpdf.php');
include('tools/controlador.php');

header('Content-Type: text/html; charset=UTF-8'); 
$id = $_GET['id'];
$curso = $_GET['curso'];
$id_inscrip = $_GET['inscripcion'];

$estudiante = estudiante($id, '');

$datoscurso = curso($id_inscrip);

$alumnocurso = getInscripcion($curso);

$nombre_curso ="";

$auxFecTermina = explode("-",$alumnocurso['fec_termina']);

if (count($auxFecTermina)>1)
{
	$mes = $auxFecTermina[1];
	$dia_term = $auxFecTermina[2];
	$anio_term = $auxFecTermina[0];
}
else {
	$mes = '';
	$dia_term = '';
	$anio_term = '';
}
//$mes="06";
switch($mes) 
{
	case "01" :  $mes = "ENERO";
				break;
	case "02" :  $mes = "FEBRERO";
				break;
	case "03" :  $mes = "MARZO";
				break;
	case "04" :  $mes = "ABRIL";
				break;
	case "05" :  $mes = "MAYO";
				break;
	case "06" :  $mes = "JUNIO";
				break;
	case "07" :  $mes = "JULIO";
				break;
	case "08" :  $mes = "AGOSTO";
				break;
	case "09" :  $mes = "SEPTIEMBRE";
				break;
	case "10" :  $mes = "OCTUBRE";
				break;
	case "11" :  $mes = "NOVIEMBRE";
				break;
	case "12" :  $mes = "DICIEMBRE";
}

class PDF extends FPDF
	{
		function Footer() // Pie de página
		{
			// Posición: a 1,5 cm del final
			//$this->SetY(0);
			$this->SetXY(0,0);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			/* Cell(ancho, alto, txt, border, ln, alineacion)
				* ancho=0, extiende el ancho de celda hasta el margen de la derecha
				* alto=10, altura de la celda a 10
				* txt= Texto a ser impreso dentro de la celda
				* border=T Pone margen en la posición Top (arriba) de la celda
				* ln=0 Indica dónde sigue el texto después de llamada a Cell(), en este caso con 0, enseguida de nuestro texto
				* alineación=C Texto alineado al centro
			*/
		}
		
		function Header() //Encabezado
		{
			//Define tipo de letra a usar, Arial, Negrita, 15
			//$this->SetFont('Arial','B',8);

			/* Líneas paralelas
			* Line(x1,y1,x2,y2)
			* El origen es la esquina superior izquierda
			* Cambien los parámetros y chequen las posiciones
			* */
		// $this->Line(10,10,266,10);
		// $this->Line(10,35.5,266,35.5);

			/* Explicaré el primer Cell() (Los siguientes son similares)
			* 30 : de ancho
			* 25 : de alto
			* ' ' : sin texto
			* 0 : sin borde
			* 0 : Lo siguiente en el código va a la derecha (en este caso la segunda celda)
			* 'C' : Texto Centrado
			* $this->Image('images/logo.png', 152,12, 19) Método para insertar imagen
			*     'images/logo.png' : ruta de la imagen
			*     152 : posición X (recordar que el origen es la esquina superior izquierda)
			*     12 : posición Y
			*     19 : Ancho de la imagen (w)
			*     Nota: Al no especificar el alto de la imagen (h), éste se calcula automáticamente
			* */


			//$this->Image($_SERVER['DOCUMENT_ROOT'].'/modules/remesastcc/images/logo-1.jpg',10,27,20);
				//$this->Cell(260,5,iconv('UTF-8', 'ISO-8859-2', 'RELACIÓN DE DESPACHOS DIARIOS CON TCC'),1,0,'C');
			// $this->Cell(70,5,'Fecha del despacho: '.$ahora,1,0,'L');

			$this->Ln(7);//Se da un salto de línea de 7
					
		}
	}
	$pdf = new PDF('L','mm','A5');
	$pdf->AliasNbPages();
	$pdf->AddPage('', 'A5');
	$pdf->SetFont('Arial','',10);

	$pdf->Image('images/a5fondodiploma.jpg',8,10,194,130,'JPG');
	$pdf->Ln(34);


	$pdf->SetFont('Arial','B',14);
	$pdf->SetTextColor(79,98,40);
	$pdf->Cell(189,5,iconv('UTF-8', 'ISO-8859-2', 'HACE CONSTAR QUE'),0,0,'C');	
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(0,0,0);
	$pdf->Ln(8);
	$codigoseguridad = '';
	$aux_ced="";
	while($datos = $estudiante->fetch_array())
	{
		
		$txt = strtoupper($datos['name']);
		
		$pdf->Cell(0,5,utf8_decode($txt),0,0,'C');
		$pdf->Ln(5);	
		$pdf->Cell(30,5,'','',0,'L');
		$pdf->Cell(130,5,'','T',0,'L');
		$pdf->Cell(30,5,'','',0,'L');
		$pdf->Ln(3);
		$pdf->SetFont('Arial','',10);
		$txt = 'Identificado(a) con '.$datos['tipo_id'].' No. '.$datos['documento'].' de '.$datos['lugar_expe'].'';  
		$pdf->Cell(0,5,utf8_decode($txt),0,0,'C');
			
		$codigoseguridad = $datos['documento'];
		
	}		
	$pdf->Ln(5);
	$datos2 = $datoscurso->fetch_array();
	$validez="";    $tipo_validez="horas"; $tipo_curso='curso';
	if($datos2['tipo_duracion']=='2')  $tipo_validez="días";
	if($datos2['tipo_duracion']=='3')  $tipo_validez="meses";
	if($datos2['tipo']=='2') $tipo_curso = 'diplomado';
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', 'Asistió y aprobó el '.$tipo_curso.' de'),0,0,'C');
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',14);


			//print_r($datos2); exit; die;

		$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $datos2['nombre']),0,0,'C');	
		$nombre_curso = iconv('UTF-8', 'ISO-8859-2', $datos2['nombre']);
			$validez = $datos2['validez'];
			

	$pdf->Ln(5);
	$pdf->Cell(65,5,'','',0,'L');
	$pdf->Cell(60,5,'','T',0,'L');
	$pdf->Cell(65,5,'','',0,'L');	
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',10);

	if($alumnocurso['duracion_tipo'] != '' & $alumnocurso['duracion_nro'] != 0) {
		$txt = 'Con una intensidad horaria de '.$alumnocurso['duracion_nro'].' '.$alumnocurso['duracion_tipo'];
	}
	else{

		$txt = 'Con una intensidad horaria de '.$datos2['duracion'].' '.$tipo_validez;
		if(($codigoseguridad=="1075208230"||$codigoseguridad=="7719192"||$codigoseguridad=="1082214930"||$codigoseguridad=="88032984"||$codigoseguridad=="93131167"||$codigoseguridad=="74856793"||$codigoseguridad=="1018435084"||$codigoseguridad=="12133698"||$codigoseguridad=="1108930773"||$codigoseguridad=="74861341"||$codigoseguridad=="7696663"||$codigoseguridad=="1072648457"||$codigoseguridad=="1123307963"||$codigoseguridad=="80213513"||$codigoseguridad=="12274238")&&($nombre_curso=="MANEJO DEFENSIVO"||$nombre_curso=="MECANICA BASICA"||$nombre_curso=="PRIMEROS AUXILIOS")){
			$txt = 'Con una intensidad horaria de (16) horas.';
		}
	}
	
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
	$pdf->Ln(5);
	//echo "dia_term = $dia_term";
	$txtFirma = 'Se firma en Puerto Asís (Putumayo) a los '.$dia_term.' días de mes de '.$mes.'  de '.$anio_term.'';
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txtFirma),0,0,'C');
	$pdf->Ln(5);
	$año2 = $anio_term + 1;
	//$año2 = 2021;

	if($curso!=15 && $curso!=16 && $curso!=14){
		if($datos2['tipo']=='1'){
			$txtVigencia = 'Vigencia hasta el '.$dia_term.' de '.$mes.' de '.$año2.''; 
		}
	}
	else{
		$txtVigencia="";
	}
			
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txtVigencia),0,0,'C');
	$pdf->Ln(16);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(260,5,'',0,0,'L');
	$pdf->Ln(7);
	$pdf->Cell(65,5,'','',0,'L');
	$pdf->Cell(60,5,'','T',0,'L');
	$pdf->Cell(65,5,'','',0,'L');	
	$pdf->Ln(1);
	$pdf->Cell(0,3,'REPRESENTANTE LEGAL',0,0,'C');
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',8);
	//$codigoseguridad = $codigoseguridad.$alumnocurso['dia'].$mes.$alumnocurso['año'];
	$codigoseguridad = $codigoseguridad.'15'.$mes.'2020';
	$codigoseguridad = MD5($codigoseguridad);
	$codigo = 'Cod. '.$codigoseguridad;
	$txt = 'Validez '.$codigo;
	$pdf->Cell(0,3,$txt,0,0,'C');

	

	echo $pdf->Output("diploma_alumno_id_".$id.".pdf",'D');
?>
