<?php 
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/fpdf.php');
include(B_TOOLS .'/controlador.php');

header('Content-Type: text/html; charset=UTF-8'); 
$id = $_GET['id'];
$curso = $_GET['curso'];
$estudiante = estudiante($id);
$datoscurso = curso($curso);
$alumnocurso = alumnocurso($curso,$id);

$mes = $alumnocurso['mes'];
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
        //$this->SetY(-15);
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

$pdf->Image('images/a5fondodiploma2.jpg',8,10,194,130,'JPG');
$pdf->Ln(26);


$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', 'Certifica que:'),0,0,'C');	
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0,0,0);
$pdf->Ln(8);
$codigoseguridad = '';
while($datos = $estudiante->fetch_array())
{
	
	$txt = $datos['nombre1'].' '.$datos['nombre2'].' '.$datos['apellido1'].' '.$datos['apellido2'];
	
	$pdf->Cell(0,5,utf8_decode($txt),0,0,'C');
	$pdf->Ln(5);
	$pdf->Cell(35,5,'','',0,'L');
	$pdf->Cell(120,5,'','T',0,'L');
	$pdf->Cell(35,5,'','',0,'L');	
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',10);
	$txt = 'Con Cédula de Ciudadanía No. '.$datos['cedula'].' de '.$datos['lugar_expedicion'].'';  
	$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
	$codigoseguridad = $datos['cedula'];
}
$pdf->Ln(4);	
$txt = 'Cursó y aprobó la acción de formación';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
while($datos2 = $datoscurso->fetch_array())
{
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $datos2['curso']),0,0,'C');	
	$nombre_curso = iconv('UTF-8', 'ISO-8859-2', $datos2['curso']);
}	
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$txt = 'De acuerdo a lo establecido en el Reglamento de Seguridad para Protección Contra Caidas en';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(4);
$txt = 'Trabajo Seguro en Alturas (Resolución 1409 de 2012)';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(4);

if($nombre_curso =="NIVEL BASICO - TRABAJO SEGURO EN ALTURAS"|| $curso=='19')
{
	$txt = 'Duración de 20 horas';  
	if($nombre_curso =="NIVEL BASICO - TRABAJO SEGURO EN ALTURAS")
	    $txt = 'Duración de 8 horas';  
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
}
elseif($curso=='13')
{
    $txt = 'Duración de 8 horas';  
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
}
else
{
	$txt = 'Duración de 40 horas';  
	$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
}	

$pdf->Ln(6);
$pdf->SetFont('Arial','',10);
$txt = 'En testimonio  de lo anterior, se firma el presente en Bogotá  a los '.$alumnocurso['dia'].' días del mes de '.$mes.' de '.$alumnocurso['año'].'';  
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(15);
$pdf->Cell(65,5,'','',0,'L');
$pdf->Cell(60,5,'','T',0,'L');
$pdf->Cell(65,5,'','',0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Ln(1);
$txt = 'C.C. No.52.765.999 de Bogotá D.C.';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(3);
$txt = 'L.S.S.T No 14368 de 18/11/13';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(3);
$txt = 'Entrenador y Evaluador TSA Autorizado SENA';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(4);
$codigoseguridad = $codigoseguridad.$alumnocurso['dia'].$mes.$alumnocurso['año'];
$codigoseguridad = MD5($codigoseguridad);
$codigo = 'validez Cod. '.$codigoseguridad;
$pdf->SetFont('Arial','',8);

$pdf->Cell(0,3,$codigo,0,0,'C');

$pdf->Ln(4);
$pdf->SetFont('Arial','',8);
$txt = '       La autenticidad de este documento puede ser verificada en el correo electrónico formacionenalturasptyo@gmail.com';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(3);
$txt = 'Las Resoluciones como Personas Naturales Autorizadas SENA pueden ser consultadas en la pagina web';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(3);
$txt = 'mgiportal.sena.edu.co/downloads/trabajoalturas/resoluciones/DC_linda_cabresa.pdf';  
$pdf->Cell(0,4,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
echo $pdf->Output("diploma_alumno_id_".$id.".pdf",'D');
?>
