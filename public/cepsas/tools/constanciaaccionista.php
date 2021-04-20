<?php 
include('controlador.php');
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$fecha1=$fecha1->format('Y-m-d');
$documento = $_GET['documento'];
$id_firmante = $_GET['id_firmante']; 

$datos_accionista=datosaccionista($documento);
$accionista = $datos_accionista['nombre1'].' '.$datos_accionista['nombre2'].' '.$datos_accionista['apellido1'].' '.$datos_accionista['apellido2'];
$accionista = strtoupper ($accionista);

//firmante
$datos_firmantes = firmantes($id_firmante);
$firmante = $datos_firmantes['nombre'];
$firmante = strtoupper ($accionista);
$cargo_titulo = $datos_firmantes['cargo_titulo'];
$cargo_titulo = strtoupper ($cargo_titulo);

$datos = totalaccionesaccionista($documento);
$cantidad_acciones = 0;

while($cantidad= mysql_fetch_row($datos))
{
	$cantidad_acciones = $cantidad[0];
}

$cantidad_accionesletras = numtoletras($cantidad_acciones); 
$cantidad_acciones =number_format($cantidad_acciones, 0, ",", ".");

$date = explode('-', $fecha1);

$año = $date[0];
$mes = $date[1];
$dia = $date[2];
$dialetras = numtoletras($dia);
$añoletras = numtoletras($año);
switch($mes)
{
	case "01" :  $mes = "Ene.";
				break;
	case "02" :  $mes = "Feb.";
				break;
	case "03" :  $mes = "Mar.";
				break;
	case "04" :  $mes = "Abr.";
				break;
	case "05" :  $mes = "May.";
				break;
	case "06" :  $mes = "Jun.";
				break;
	case "07" :  $mes = "Jul.";
				break;
	case "08" :  $mes = "Ago.";
				break;
	case "09" :  $mes = "Sep.";
				break;
	case "10" :  $mes = "Oct.";
				break;
	case "11" :  $mes = "Nov.";
				break;
	case "12" :  $mes = "Dic.";
}

$nuevafecha = $dia." de ".$mes." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".$año;


//$datos_liquidacion_dividendos = datosliquidaciondividendos($añodividendos);


/*
$accionesletras = numtoletras($datos_venta['no_acciones']); 
$accionesletras = strtoupper ($accionesletras );
$accionesformato =number_format($datos_venta['no_acciones'], 0, ",", ".");

*/



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="../web/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../web/css/font-awesome.min.css">
	<link rel="stylesheet" href="../web/css/ionicons.min.css">
	<link rel="stylesheet" href="../web/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="../web/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="../web/dist/css/skins/_all-skins.min.css">
	<script>
	
</script>
<style>
	
	#noaccionies {
		font-size: 16px;
		font-weight: bold;
		left: 300px;
		position: absolute;
		top: 248px;
	}	
	#valoracciones {
		font-size: 16px;
		font-weight: bold;
		left: 550px;
		position: absolute;
		top: 248px;
	}
	#titulo {
		background: #fff none repeat scroll 0 0;
		font-size: 17px;
		font-weight: bold;
		left: 817px;
		padding: 2px;
		position: absolute;
		text-align: center;
		top: 248px;
		width: 100px;
		color:red;
	}
	#fecha {
		font-size: 17px;
		font-weight: bold;
		left: 662px;
		position: absolute;
		top: 545px;
	}
	#claseb {
		font-size: 17px;
		font-weight: bold;
		left: 694px;
		position: absolute;
		top: 304px;
	}
	#accionista{
		font-size: 17px;
		font-weight: bold;
		left: 243px;
		position: absolute;
		top: 361px;
	}
	#documento{
		font-size: 17px;
		font-weight: bold;
		left: 780px;
		position: absolute;
		top: 360px;
	}
	#por {
		font-size: 17px;
		font-weight: bold;
		left: 190px;
		position: absolute;
		top: 395px;
	}
	
	
</style>
</head>
<body>
	<div class="row">
		<div class="col-md-8 content">
			<img src="../web/uploads/fondoconstancia.jpg"  height="1200px" />
			<div class="contenido">
			<h3>LA  SUSCRITA JEFE FINANCIERA DE   LA EMPRESA DE ENERGÍA DEL BAJO</h3>
			<h3>PUTUMAYO S.A. E.S.P.</h3>
			<h3>CERTIFICA:</h3>
			<p>
				Que revisados los archivos y el libro de accionistas de la Empresa de Energía del Bajo Putumayo S.A. E.S.P. El señor(a)  <?=$accionista?>, identificado (a) con  <?= $datos_accionista['tipo_documento']?> No.  <?=$datos_accionista['documento']?> Expedida en  , a <?=$dia?> de <?=$mes?>  de <?=$año?> contaba con <?=$cantidad_accionesletras?> (  <?=$cantidad_acciones ?>  )  acciones, por un valor nominal de <?=$dia ?> ($<?= $dia?>) cada una, para una inversión total de  <?=$dia ?>($<?=$dia ?>).
			</p>
			<p>
				Las anteriores acciones para el año <?=$dia ?>, obtuvieron utilidades de $696.50 por acción para un total de                                                                                                                   ($                     ) los cuales se pagaran a partir del 4 de mayo de 2015 la siguiente manera: 
			</p>
			
			
			Que revisados los archivos y el libro de accionistas de la Empresa de Energía del Bajo Putumayo S.A. E.S.P. El señor(a)  <?=$accionista?>, identificado (a) con  <?= $datos_accionista['tipo_documento']?> No.  <?=$datos_accionista['documento']?> Expedida en  , a <?=$dia?> de <?=$mes?>  de <?=$año?> contaba con    (        )  acciones, por un valor nominal de VEINTE MIL PESOS MONEDA CORRIENTE ($20.000) cada una, para una inversión total de    ($   		                        ).  Las anteriores acciones para el año 2014, obtuvieron utilidades de $696.50 por acción para un total de  ($                     ) los cuales se pagaran a partir del 4 de mayo de 2015 la siguiente manera: 
			</p>


			</div>
			
			<div id="noaccionies"><?=$datos_venta['no_acciones']?></div>
			<div id="valoracciones"><?= $total ?></div>
			<div id="titulo"><span><?= $datos_titulo['no_titulo'] ?></span></div>
			<div id="fecha"><?= $nuevafecha?></div>
			<div id="claseb">X</div>
			<div id="accionista"></div>
			<div id="documento"><?=$datos_accionista['documento']?></div>
			<div id="por"><?= $totalletras?> PESOS M/CTE</div>
		</div>
	</div>
	
	<a class="btn btn-app" href="javascript:window.print()">
		<i class="fa fa-print"></i>Imprimir
	</a>				

</body>
<script src="../web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../web/bootstrap/js/bootstrap.min.js"></script> 
<script src="../web/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../web/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../web/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../web/plugins/fastclick/fastclick.min.js"></script>
<script src="../web/dist/js/app.min.js"></script>
<script src="../web/dist/js/demo.js"></script>