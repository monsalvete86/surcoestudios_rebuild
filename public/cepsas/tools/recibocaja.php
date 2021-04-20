<?php 
include('controlador.php');
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$ahora=$fecha1->format('Y-m-d H:i:s');
$id_venta = $_GET['id_venta'];

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

				
$datos_accionista=datosaccionista($datos_venta['id_accionista']);*/
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
	function seleccionar(campo,valor)
	{
		parent.document.getElementById(campo).value=valor;
		//parent.$('#accionistas').modal('hide');
		//parent.$('#accionistas2').modal('hide');
		//parent.$('#representantes').modal('hide');
		//parent.$( ".modal-backdrop" ).remove();	
		
	}
</script>
<style>
	.centrar{
		text-align: center !important;
	}
	.fondogris{
		background: #d9d9d9;
		border:1px solid #000;
		border
	}
	.lineainferior{
	border-bottom:1px solid #000;
	}
</style>
</head>
<body>
	<div class="row">
		<div class="col-md-7">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-3">	
						<img src="../web/uploads/EEBP.jpg">
					</div>
					<div class="col-md-9 centrar">	
						<h3 class="box-title">EMPRESA DE ENERGIA DEL BAJO PUTUMAYO  S.A.E.S.P.</h3>
						<p>NIT. 846.000.553-0</br>
						Carrera 26 N. 10-68 Barrio el Carmen</br>
						Tel. 4227559 ext. 120    juntadirectiva@eebpsa.com.co</p>
					</div>	
				</div>
				<div class="box-body">
					<div class="col-md-12 centrar">	
						<h4>CONSTANCIA DE RECIBIDO DE CONSIGNACION</h4>
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<p>Valor CONSIGNADO EN BANCOS: $	 225,000 </p>
					</div>
					<div class="col-md-3">
						<div class="col-md-4 fondogris">
							DIA
						</div>
						<div class="col-md-4 fondogris">
							MES
						</div>
						<div class="col-md-4 fondogris">
							AÑO
						</div>
						<div class="col-md-4 fondogris">
							28
						</div>
						<div class="col-md-4 fondogris">
							9
						</div>
						<div class="col-md-4 fondogris">
							2015
						</div>						
					</div>
					<div class="col-md-3">
						Recibimos de:
					</div>
					<div class="col-md-9 lineainferior">
						COOPERATIVA DE TRANSPORTES VELOTAX DEL PUERTO LIMITADA				C.C.	846,000,019-9	
					</div>
					<div class="col-md-3">
						La suma de:
					</div>
					<div class="col-md-9 lineainferior">
						DOSCIENTOS VEINTICINCO MIL PESOS M/CTE	
					</div>
					<div class="col-md-3">
						Por concepto de:
					</div>
					<div class="col-md-9 lineainferior">
						CANCELA 3RA. CUOTA EMISION DE ACCIONES 2015	
					</div>
					<div class="col-md-3">
						Banco:
					</div>
					<div class="col-md-9 lineainferior">
						BBVA	Cuenta No.	726-09412-1	Mov:	982	Fecha Consignación
					</div>
					<div class="col-md-12">	
						</br>	
					</div>	
					<div class="col-md-3 fondogris">
						Saldo Anterior
					</div>
					<div class="col-md-3">
						 $ 2,250,000 
					</div>
					<div class="col-md-12">						
					</div>					
					<div class="col-md-3 fondogris">
						Valor Cuota
					</div>
					<div class="col-md-3">
						 $ 225,000 	
					</div>
					<div class="col-md-12">						
					</div>					
					<div class="col-md-3 fondogris">
						Saldo Actual
					</div>
					<div class="col-md-3">
						 $ 2,025,000 
					</div>
					<div class="col-md-12">
						</br></br></br></br>
					</div>				
					<div class="col-md-12">			
						<div class="col-md-4 lineainferior">
							MARTHA LUCIA ZAMORA	
						</div>
						<div class="col-md-4">
							  
						</div>
						<div class="col-md-4 lineainferior">
							</br>
						</div>
					</div>
					<div class="col-md-12">			
						<div class="col-md-4">
							Secretaria Junta Directiva
						</div>
						<div class="col-md-4">
							  
						</div>
						<div class="col-md-4">
							FIRMA
						</div>
					</div>
					<div class="col-md-12">	
						</br>	
					</div>					
					<div class="col-md-12">
						Nota: Recomendamos por cada consignación que efectué entregar ORIGINAL en nuestras oficinas para el descargue correspondiente.	
					</div>
				</div>
			</div>
		</div>
	</div>	
<a href='javascript:window.print(); void 0;'></a> 
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