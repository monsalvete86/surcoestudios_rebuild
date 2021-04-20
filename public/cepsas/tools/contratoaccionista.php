<?php 
require('fpdf.php');
include('controlador.php');
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$ahora=$fecha1->format('Y-m-d H:i:s');
$id_venta = $_GET['id_venta'];
$precioacc = $_GET['precioacc'];

$valnominal = $_GET['valnominal'];

$datos_venta = datosventa($id_venta);
$total = $datos_venta['total'];


$precioletras = numtoletras($precioacc); 
$precioletras = strtoupper ($precioletras );
$precioacc =number_format($precioacc, 2, ",", ".");

$totalletras = numtoletras($total); 
$totalletras = strtoupper ($totalletras );
$total =number_format($total, 2, ",", ".");

$valnominalletras = numtoletras($total); 
$valnominalletras = strtoupper ($valnominalletras );
$valnominal =number_format($valnominal, 2, ",", ".");


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

$datosfirmante=datosfirmante();
$tipoventa = '';

if($datos_venta['total_contado'] == $datos_venta['total'])
{
	$datos_titulo=datostitulo($id_venta);
	$tipoventa = 'contado';
	
}
$accionesletras = numtoletras($datos_venta['no_acciones']); 
$accionesletras = strtoupper ($accionesletras );
$accionesformato =number_format($datos_venta['no_acciones'], 0, ",", ".");

$objeto = 'VENTA DE '.$accionesformato.' ACCIONES';

$fecha = explode(' ', $datos_venta['fecha_venta']);
$date = explode('-', $fecha[0]);

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

$nuevafecha = $dia." de ".$mes." de ".$año;

				
$datos_accionista=datosaccionista($datos_venta['id_accionista']);
if($datos_accionista['tipo_documento'] == 'Cédula')
{
	$accionista = $datos_accionista['nombre1'].' '.$datos_accionista['nombre2'].' '.$datos_accionista['apellido1'].' '.$datos_accionista['apellido2'];
	$accionista = strtoupper ($accionista);
	$comprador = $accionista;
	if($datos_venta['id_representante'] == '')
	{			
		$comprador.=',  identificado (a) con cedula de ciudadanía N. '.$datos_accionista['documento'].'  expedida en '.$datos_accionista['lugar_expedicion_doc'].',  Colombiano (a), mayor de edad, vecino (a) de la ciudad Puerto Asís, quien para efectos del presente contrato se llamara el COMPRADOR (a)';
	}
	else
	{
		$datos_representante=datosrepresentante($datos_venta['id_representante']);
		$representante = $datos_representante['nombre1'].' '.$datos_representante['nombre2'].' '.$datos_representante['apellido1'].' '.$datos_representante['apellido2']; 
		$representante = strtoupper ($representante);
		$comprador.=' Y/O '.$representante.' identificados con '.$datos_accionista['tipo_documento'].' N. '.$datos_accionista['documento'].' expedida en '.$datos_accionista['lugar_expedicion_doc'].' y '.$datos_representante['tipo_identificacion'].' N. '.$datos_representante['identificacion'].' expedida en '.$datos_representante['lugar_expedicion_doc'].' respectivamente, quien actua en este acto como el COMPRADOR, que para efectos de este contrato el Señor '.$accionista.' estará representado por el señor(a) '.$representante.'.';    
	}
}
if($datos_accionista['tipo_documento'] == 'Nit')
{
	$accionista = $datos_accionista['razon_social'];
	$accionista = strtoupper ($accionista);
	
	$datos_representante=datosrepresentante($datos_venta['id_representante']);
	$representante = $datos_representante['nombre1'].' '.$datos_representante['nombre2'].' '.$datos_representante['apellido1'].' '.$datos_representante['apellido2']; 
	$representante = strtoupper ($representante);
	$comprador= 'el señor(a)'.$representante.' identificado(a) con '.$datos_representante['tipo_identificacion'].' N. '.$datos_representante['identificacion'].' expedida en '.$datos_representante['lugar_expedicion_doc'].', quien actúa en calidad de Representante Legal de la '.$accionista.' identificado (a)  con '.$datos_accionista['tipo_documento'].' No. '.$datos_accionista['documento'].' quien para efectos del presente contrato se llamarán COMPRADOR (A)';  
}
if($datos_accionista['tipo_documento'] == 'Tarjeta de Identidad')
{
	$accionista = $datos_accionista['nombre1'].' '.$datos_accionista['nombre2'].' '.$datos_accionista['apellido1'].' '.$datos_accionista['apellido2'];
	$accionista = strtoupper ($accionista);
	$comprador = $accionista;
	
	$datos_representante=datosrepresentante($datos_venta['id_representante']);
	$representante = $datos_representante['nombre1'].' '.$datos_representante['nombre2'].' '.$datos_representante['apellido1'].' '.$datos_representante['apellido2']; 
	$representante = strtoupper ($representante);
	$comprador.=' Y/O '.$representante.' identificados con '.$datos_accionista['tipo_documento'].' N. '.$datos_accionista['documento'].' expedida en '.$datos_accionista['lugar_expedicion_doc'].' y '.$datos_representante['tipo_identificacion'].' N. '.$datos_representante['identificacion'].' expedida en '.$datos_representante['lugar_expedicion_doc'].' respectivamente, quien actua en este acto como el COMPRADOR, que para efectos de este contrato el menor estará representando por el señor(a) '.$representante.'.';    
	
}
if($datos_accionista['tipo_documento'] == 'Registro Civil')
{
	$accionista = $datos_accionista['nombre1'].' '.$datos_accionista['nombre2'].' '.$datos_accionista['apellido1'].' '.$datos_accionista['apellido2'];
	$accionista = strtoupper ($accionista);
	$comprador = $accionista;
	
	$datos_representante=datosrepresentante($datos_venta['id_representante']);
	$representante = $datos_representante['nombre1'].' '.$datos_representante['nombre2'].' '.$datos_representante['apellido1'].' '.$datos_representante['apellido2']; 
	$representante = strtoupper ($representante);
	$comprador.=' Y/O '.$representante.' identificados con '.$datos_accionista['tipo_documento'].' N. '.$datos_accionista['documento'].' expedida en '.$datos_accionista['lugar_expedicion_doc'].' y '.$datos_representante['tipo_identificacion'].' N. '.$datos_representante['identificacion'].' expedida en '.$datos_representante['lugar_expedicion_doc'].' respectivamente, quien actua en este acto como el COMPRADOR, que para efectos de este contrato el menor estará representando por el señor(a) '.$representante.'.';    
}
if($datos_accionista['tipo_documento'] == 'Cédula Extranjería')
{
	$comprador ='NO EXISTE MODELO DE CONTRATO PARA ESTA OPCIÓN';
}

if($tipoventa == 'contado')
{
	$clausulas = 'CLAUSULA SEGUNDA- El valor total del presente contrato es la suma de '.$totalletras.' PESOS M/CTE. ($'.$total.'), en razón de '.$precioletras.' PESOS M/CTE ($'.$precioacc.') por cada acción, los cuales serán  cancelados por el COMPRADOR al VENDEDOR en el momento de la firma del presente contrato.  TERCERA – EXCLUSIVIDAD.  EL VENDEDOR manifiesta al COMPRADOR no haber vendido ni total ni parcialmente las acciones que son objeto del presente contrato y que estas se encuentran totalmente pagadas y a paz y salvo por todo concepto libre de embargo y acción judicial por lo que está dispuesto a salir en defensa del  COMPRADOR (A) con motivo de cualquier reclamo que terceros presenten contra ella por cualquiera de estos conceptos.  CUARTA  – DOMICILIO.  Las partes acuerdan como domicilio contractual la ciudad de Puerto Asís Departamento del Putumayo y para sus efectos se regirá  por las leyes  de la Republica de Colombia, en constancia y aceptación de lo expuesto las partes firman el presente contrato en Puerto Asís a los '.$dialetras.' ('.$dia.') días del mes de '.$mes.' del año '.$añoletras.'  ('.$año.').';
}
else
{
	$pcontado =  ($datos_venta['total_contado']/$datos_venta['total']) * 100;
	$pcredito = 100 - $pcontado;
	$cuota = $datos_venta['total_credito'] / $datos_venta['cuotas'];
	$cuotaletra = numtoletras($cuota);
	$cuotaletra = strtoupper ($cuotaletra );
	$cuotasletra =  numtoletras($datos_venta['cuotas']);
	$cuotasletra = strtoupper ($cuotasletra );
	
	$clausulas = 'CLAUSULA SEGUNDA- EL VALOR Y FORMA DE PAGO El valor total del presente contrato es la suma de '.$totalletras.' PESOS M/CTE. ($'.$total.'), en razón de '.$precioletras.' PESOS M/CTE ($'.$precioacc.') por cada acción que el COMPRADOR cancelará: a) Un primer pago correspondiente al '.$pcontado.'% del valor total de la compra una vez se firme el presente documento; b) el '.$pcredito.'% restante será cancelado en '.$cuotasletra.' ('.$datos_venta['cuotas'].')cuotas mensuales cada una por valor de '.$cuotaletra.' M.CTE ('.$cuota.') PARAGRAFO: Cada uno de los pagos establecidos anteriormente deberán ser consignados a nombre de la Empresa de Energía del Bajo Putumayo SA ESP en la cuenta de Ahorros No. 726-09412-1 del banco BBVA. CLAUSULA TERCERA- PROCEDIMIENTO EN CASO DE MORA: En caso de que el comprador no pague el valor total pendiente de las cuotas vencidas de acciones, se entenderá que el comprador, tiene obligaciones vencidas con la EMPRESA DE ENERGIA DEL BAJO PUTUMAYO S.A. E.S.P, por concepto de cuotas de acciones suscritas, en los términos del artículo 397 del código de Comercio y, por lo tanto, el total de las sumas recibidas se imputará a liberar un número completo de acciones ofrecidas adjudicadas y que corresponderán al 80% fijo del calor pagado, y un veinte por ciento (20%) a título de indemnización de perjuicios a la EEBP S.A.E.S.P.  CLAUSULA CUARTA- CLAUSULA ACELERATORIA. Por el incumplimiento o el no pago oportuno de una o más cuotas, se entenderá el desistimiento por parte del comprador respecto a las accionies no pagadas, y en consecuencia renuncia expresamente a todos los requerimientos que exija la ley y se porcederá conforme lo estipula la clausula anterior. CLAUSULA QUINTA. Se realizará la inscripción del título nominativo en el libro de registro de acciones una vez por parte del COMPRADOR se haya cancelado el 100% de las acciones adquiridas, o se presente la mora en el pago de las cuotas convenidas, de acuerdo a las clusular tercera y cuarta; una vez verificado  los pagos realizados EL VENDEDOR entregara el titulo que acreditará al COMPRADOR como accionista de la EEBP. PARAGRAFO: Si el COMPRADOR llegare a incurrir en mora de una o más cuotas, la EEBP emitirá el titulo correspondient al número de accionies que se encontraren canceladas al momento del requerimiento. CLAUSULA QUINTA– DOMICILIO.  Para todos los efectos legales  el domicilio contractual será el Municipio de Puerto Asís Departamento del Putumayo y las notificaciones serán  recibidas por las partes en las siguientes direcciones: Por el VENDEDOR en la Carrera 26 No. 10-68 Barrio El Carmen. Por el COMPRADOR en '.$datos_accionista['direccion'].', celular '.$datos_accionista['celular'].', telefono '.$datos_accionista['telefono'].', correo electrónico '.$datos_accionista['email'].', en constancia y aceptación de lo expuesto las partes firman el presente contrato en Puerto Asís a los '.$dialetras.' ('.$dia.') días del mes de '.$mes.' del año '.$añoletras.'  ('.$año.').';	
}




$contenido = " ";
$pdf->SetFont('Arial','B',10);
$pdf->Cell(195,5,iconv('UTF-8', 'ISO-8859-2', 'CONTRATO DE COMPRA  - VENTA DE ACCIONES DE LA EMPRESA DE ENERGÍA DEL BAJO PUTUMAYO'),0,0,'C');	
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,'VENDEDOR (ES):',0,0,'L');
$pdf->Cell(160,5,'EMPRESA DE ENERGIA DEL BAJO PUTUMAYO S.A. E.S.P. ',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(35,5,'COMPRADOR (ES):',0,0,'L');
$pdf->Cell(200,5,iconv('UTF-8', 'ISO-8859-2', $accionista),0,0,'L');
$pdf->Ln(5);
$pdf->Cell(35,5,'OBJETO:',0,0,'L');
$pdf->Cell(200,5,iconv('UTF-8', 'ISO-8859-2', $objeto),0,0,'L');
$pdf->Ln(5);
$pdf->Cell(35,5,'FECHA:',0,0,'L');
$pdf->Cell(200,5,iconv('UTF-8', 'ISO-8859-2', $nuevafecha),0,0,'L');
$pdf->Ln(15);

$txt = 'Entre los suscritos a saber, '.strtoupper($datosfirmante['representante_legal']).',  mayor de edad, vecino de  Puerto Asís, identificado con cédula de ciudadanía No. '.$datosfirmante['cedula_representante'].' expedida en '.$datosfirmante['expedidaen'].', actuando como Representante Legal de la EMPRESA DE ENERGIA DEL BAJO PUTUMAYO, identificada con NIT 846.000.553.0, empresa de servicios públicos domiciliarios de naturaleza privada, constituida por Escritura Pública No. 121 del 3 de febrero de 1999 de la Notaría Única del Municipio de Puerto Asís (Putumayo), registrada en la Cámara de Comercio Putumayo, el día 9 de febrero de 1999, bajo el número 1576 del Libro IX, y que en adelante se denominará el VENDEDOR, de una parte y de otra parte '.$comprador.', hemos celebrado el presente contrato de compra venta, previas las siguientes consideraciones: a)  Las acciones ofrecidas por la EEBP son acciones ordinarias y tienen un valor nominal de '.$valnominalletras.' PESOS M/CTE ($'.$valnominal.') cada una, que dándose cumplimiento a lo estipulado en el acuerdo No 002 del 27 de mayo de 2015 se procede a celebrar el presente contrato  que se regirá por las siguientes cláusulas.  CLAUSULA PRIMERA – OBJETO: EL VENDEDOR  transfiere en venta perpetua al COMPRADOR (A) quien acepta recibir en tal condición '.$accionesletras.' ('.$accionesformato.') ACCIONES de la Empresa de Energía del Bajo Putumayo S.A. E.S.P. '.$clausulas.'';

$pdf->MultiCell(0,5,iconv('UTF-8','',$txt));
$pdf->Ln(25);
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'C.C.','T',0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'C.C.','T',0,'L');
$pdf->Ln(5);
$pdf->Cell(65,5,'VENDEDOR (A)',0,0,'L');
$pdf->Cell(65,5,'',0,0,'L');
$pdf->Cell(65,5,'COMPRADOR (A)',0,0,'L');


																					
							
//$pdf->Output($_SERVER['DOCUMENT_ROOT']."/modules/remesastcc/pdf/listado.pdf","F"); para guardar en el servidor
//$pdf->Output(); para ver en la misma pagina		
//$this->_html .= $this->displayConfirmation('<a href="/modules/cpenviostcc/pdf/listado.pdf">Listado de remesas enviadas el '.$fecha.' <img src="../img/admin/AdminPdf.gif"/></a>'); para descargar cuando se guarda en el servidor
//return $this->_html;
echo $pdf->Output("contrato ".$id_venta.".pdf",'D');



?>