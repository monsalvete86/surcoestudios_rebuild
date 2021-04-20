<?php 
include('controlador.php');
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$ahora=$fecha1->format('Y-m-d H:i:s');
$asamblea = $_GET['asamblea'];
$votos = 0;
$votaciones = votaciones($asamblea);
		
	

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

	
</style>
</head>
<body>
	<div class="row">
		 <?php 
			if($votaciones==false)
			{
			?>
				<div class="col-md-12">
					<div class="box box-widget widget-user-2">
						<div class="widget-user-header bg-yellow">
							<h3 class="widget-user-username">SIN VOTACIONES</h3>						
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">								
							</ul>
						</div>
					</div>
				</div>			
			<?php							
				else
				{
					while($datos= mysql_fetch_array($votaciones))
					{	
						/*$si = round(($datos['si'] * 100) / $datos['votantes']);
						$no = round(($datos['no'] * 100) / $datos['votantes']);*/
					?>
						<div class="col-md-12">
							<div class="box box-widget widget-user-2">
								<div class="widget-user-header bg-yellow">
									<h3 class="widget-user-username"><?=$datos['pregunta']?></h3>						
								</div>
								<div class="box-footer no-padding">
									<ul class="nav nav-stacked">
										<?php 
											$respuestas = respuestas($datos['id']);
											if($respuestas == false)
												echo '<li>Sin votaciones hasta el momento</li>';
											else
												while($datos2= mysql_fetch_array($respuestas))
												{
													echo '<li>'.item($datos2['valor_respuesta'])'.<span class="pull-right badge bg-blue">'.$datos2['suma'].'</span></li>';
												}	
										?>
									</ul>
								</div>
							</div><!-- /.widget-user -->
						</div>
					<?php
					}
				}		
			?>                                        
                  
                </div><!-- /.box-body -->
            </div><!-- /.box -->			
		</div>
	</div>				

</body>
<script src="../web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../web/bootstrap/js/bootstrap.min.js"></script> 
<script src="../web/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../web/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../web/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../web/plugins/fastclick/fastclick.min.js"></script>
<script src="../web/dist/js/app.min.js"></script>
<script src="../web/dist/js/demo.js"></script>