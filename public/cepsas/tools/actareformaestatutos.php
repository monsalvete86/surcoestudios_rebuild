<?php 
require('fpdf.php');
include('controlador.php');

$asamblea = $_GET['asamblea'];
$votaciones = votaciones($asamblea);

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

$nuevafecha = $dia." de ".$mes." de ".$año;
$pdf->SetFont('Arial','B',10);
$pdf->Cell(195,5,iconv('UTF-8', 'ISO-8859-2', 'EMPRESA DE ENERGÍA DEL BAJO PUTUMAYO S.A.E.S.P'),0,0,'C');	
$pdf->Ln(5);
$txt = $asamblea.' ASAMBLEA GENERAL DE ACCIONISTAS '.$mes.' '.$dia.' DE '.$año;  
$pdf->Cell(195,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');
$pdf->Ln(5);
$segundoaño = $año + 1;
$txt = 'ACTA DE CIERRE DE ESCRUTINIO APROBACIÓN REFORMA DE ESTATUTOS';  
$pdf->Cell(195,5,iconv('UTF-8', 'ISO-8859-2', $txt),0,0,'C');	
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$txt = 'En las instalaciones del Auditorio Centenario de COMFAMILIAR del Municipio de Puerto Asís, siendo las '.$hora.':'.$minuto.' del día '.$dia.' de '.$mes.' de '.$año.', certificamos los resultados del escrutinio efectuado para la REFORMA DE ESTATUTOS';  
$pdf->MultiCell(0,5,iconv('UTF-8','',$txt));		
$pdf->Ln(15);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,5,'ITEM',1,0,'C');
$pdf->Cell(100,5,iconv('UTF-8', 'ISO-8859-2', 'ARTÍCULOS A REFORMAR'),1,0,'C');
$pdf->Cell(20,5, 'SI',1,0,'C');
$pdf->Cell(20,5, 'NO',1,0,'C');
$pdf->Cell(20,5, 'EN BLANCO',1,0,'C');
$pdf->Cell(25,5,iconv('UTF-8', 'ISO-8859-2', 'TOTAL VOTACIÓN'),1,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$cont = 1;
while($datos= mysql_fetch_array($votaciones))
{
	
	$pdf->Cell(10,5,$cont,1,0,'C');
	$pdf->Cell(100,5,iconv('UTF-8', 'ISO-8859-2', $datos['pregunta']),1,0,'C');
	
	$id = $datos['id'];
	$pregunta_items=pregunta_items($datos['id']);
	if($pregunta_items == false)
	{
		$pdf->Cell(20,5,'0',1,0,'C');
		$pdf->Cell(20,5,'0',1,0,'C');
		$pdf->Cell(20,5,'0',1,0,'C');
		$pdf->Cell(25,5,'0',1,0,'C');
	}
	else 
	{
		$acciones_votantes =0;
		$cont2=1;
		while($datos2= mysql_fetch_array($pregunta_items))
		{
			$respuestas = respuestas($datos2['id']);		
			if($respuestas > 0)
			{			
					$pdf->Cell(20,5,$respuestas,1,0,'C');				
					$acciones_votantes = $acciones_votantes + $respuestas;
			}
			else
			{
					$pdf->Cell(20,5,'0' ,1,0,'C');
			}			
			$cont++;	
		}
		$pdf->Cell(25,5,$acciones_votantes,1,0,'C');		
	}		
	
	$pdf->Ln(5);
}	


$pdf->Ln(5);
$txt = 'EN CONSTANCIA DE LO ANTERIOR, FIRMAMOS EL DÍA '.$dia.' DE '.$mes.' DE '.$año.' LA COMISIÓN ESCRUTADORA DESIGNADA:';
$pdf->MultiCell(0,5,iconv('UTF-8','',$txt));
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'','T',0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'','T',0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'VOBO. REVISOR FISCAL',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,iconv('UTF-8', 'ISO-8859-2','COMISIÓN ESCRUTADORA'),0,0,'L');
$pdf->Ln(25);
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'','T',0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,iconv('UTF-8', 'ISO-8859-2','COMISIÓN ESCRUTADORA'),0,0,'L');
echo $pdf->Output("Acta_junta_directiva_".$año.".pdf",'D');
?>
