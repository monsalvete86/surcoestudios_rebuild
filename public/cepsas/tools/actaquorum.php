<?php 
require('fpdf.php');
include('controlador.php');

$asamblea = $_GET['asamblea'];
$quorum = quorum($asamblea);
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$ahora=$fecha1->format('Y-m-d H:i:s');
class PDF extends FPDF
{
 	function Footer() // Pie de página
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
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
        $this->Cell(0,10,'www.eebp.com.co','T',0,'C');
		$this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C'); // Número de página
    	
		
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
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('', 'Letter');
$pdf->SetFont('Arial','',10);

$fecha = explode(' ', $ahora);
$date = explode('-', $fecha[0]);
$date2 = explode(':', $fecha[1]);

$hora = $date2[0];
$minuto = $date2[1];
$año = $date[0];
$mes = $date[1];
$dia = $date[2];
$dialetras = numtoletras($dia);
$añoletras = numtoletras($año);
switch($mes)
{
	case "01" :  $mes = "Enero";
				break;
	case "02" :  $mes = "Febrero";
				break;
	case "03" :  $mes = "Marzo";
				break;
	case "04" :  $mes = "Abril";
				break;
	case "05" :  $mes = "Mayo";
				break;
	case "06" :  $mes = "Junio";
				break;
	case "07" :  $mes = "Julio";
				break;
	case "08" :  $mes = "Agosto";
				break;
	case "09" :  $mes = "Septiembre";
				break;
	case "10" :  $mes = "Octubre";
				break;
	case "11" :  $mes = "Noviembre";
				break;
	case "12" :  $mes = "Diciembre";
}

if($quorum['quorum'] > 50)
	$valida_quorum = 'SI';
else
	$valida_quorum = 'NO';	
$nuevafecha = $dia." de ".$mes." de ".$año;
$pdf->SetFont('Arial','B',10);
$pdf->Cell(195,5,iconv('UTF-8', 'ISO-8859-2', 'EMPRESA DE ENERGÍA DEL BAJO PUTUMAYO S.A.E.S.P'),0,0,'C');	
$pdf->Ln(5);
$pdf->Cell(195,5,iconv('UTF-8', 'ISO-8859-2', 'VERIFICACIÓN DE QUORUM ASAMBLEA'),0,0,'C');	
$pdf->Ln(20);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(93,5,'ASAMBLEA',1,0,'L');
$pdf->Cell(97,5,$asamblea,1,0,'C');
$pdf->Ln(5);
$pdf->Cell(93,5,'TOTAL ASISTENCIA',1,0,'L');
$pdf->Cell(97,5,$quorum['asistencia'],1,0,'C');
$pdf->Ln(5);$pdf->Cell(93,5,'ACCIONES ASAMBLEA',1,0,'L');
$pdf->Cell(97,5,$quorum['acciones_asamblea'],1,0,'C');
$pdf->Ln(5);$pdf->Cell(93,5,'TOTAL ACCIONES',1,0,'L');
$pdf->Cell(97,5,$quorum['total_acciones'],1,0,'C');
$pdf->Ln(5);$pdf->Cell(93,5,'QUORUM',1,0,'L');
$pdf->Cell(97,5,$valida_quorum,1,0,'C');
$pdf->Ln(10);

$txt = 'En constancia de lo anterior se firma en Puerto Asís, a los  veintidos  ('.$dia.') dias del mes de '.$mes.' de '.$año.', siendo las '.$hora.':'.$minuto.' horas.';
$pdf->MultiCell(0,5,iconv('UTF-8','',$txt));
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'','T',0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'V.B. REVISOR FISCAL',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
echo $pdf->Output("Acta_poderes_asamblea_general_".$año.".pdf",'D');
?>
?>