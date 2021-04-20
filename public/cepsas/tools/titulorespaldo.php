<?php 
include('controlador.php');
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$ahora=$fecha1->format('Y-m-d H:i:s');
$id_venta = $_GET['id_venta'];
$no_titulo = $_GET['no_titulo']; 
$datos_venta = datosventa($id_venta);
$datos_titulo = datostitulo($id_venta);
$total = $datos_venta['total'];

$totalletras = numtoletras($total); 
$totalletras = strtoupper ($totalletras );
$total =number_format($total, 2, ",", ".");



$accionesletras = numtoletras($datos_venta['no_acciones']); 
$accionesletras = strtoupper ($accionesletras );
$accionesformato =number_format($datos_venta['no_acciones'], 0, ",", ".");

$datos_accionista=datosaccionista($datos_venta['id_accionista']);
$accionista = $datos_accionista['nombre1'].' '.$datos_accionista['nombre2'].' '.$datos_accionista['apellido1'].' '.$datos_accionista['apellido2'];
$accionista = strtoupper ($accionista);
$fecha = explode(' ', $datos_venta['fecha_venta']);
$date = explode('-', $fecha[0]);

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

$nuevafecha = $mes." ".$dia." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".$año;



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

	#fecha{
		font-size: 13px;
		left: 729px;
		position: absolute;
		top: 339px;
	}

	
	
</style>
</head>
<body>
	<div class="row">
		<div class="col-md-10 content">
			<img src="../web/uploads/tituloback.jpg"  height="600px" />
			<div id="fecha"><?=$nuevafecha?></div>
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