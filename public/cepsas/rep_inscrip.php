<?php 
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');

$usu = $_GET['usu'];
$usuario = datosusuario($usu);

if($usuario['id_roll'] == 1)
	$roll = 'ADMINISTRADOR';
else
	$roll = 'ASISTENTE';

if(!isset($_POST['estado'])) $estado=""; else $estado = $_POST['estado'];
if(!isset($_POST['token'])) $token = $_GET['token']; else $token = $_POST['token'];

$ND = getdate();

if(!isset($_POST['fecha_fin'])) {
    $c1=""; $c2=""; if($ND['mday']<10){$c2="0";}  if($ND['mon']<10){$c1="0";}
    $fecha_fin = $ND['year']."-".$c1.$ND['mon']."-".$c2.$ND['mday'];
    $fecha_ini = $ND['year']."-".$c1.$ND['mon']."-01";
}
else{
     $fecha_fin = $_POST['fecha_fin'];
     $fecha_ini = $_POST['fecha_ini'];
}

//echo "fecha_ini = $fecha_ini fecha_fin =$fecha_fin";

$estudiantes = listar_incripciones($fecha_ini,$fecha_fin, $estado);

$aux_estados = getEstados();    $estados_aux2=array(); $estados = array();


$url_actual= $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>C.E.P.S.A.S. | Aministrador</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" type="text/css" href="<?= B_JQ ?>jquery.confirm.css" />
		<link rel="stylesheet" href="<?= B_TOOLS_JS ?>web/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= B_TOOLS_JS ?>web/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= B_TOOLS_JS ?>web/css/ionicons.min.css">
	   <!-- Theme style -->
		<link rel="stylesheet" href="<?= B_TOOLS_JS ?>web/dist/css/AdminLTE.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?= B_TOOLS_JS ?>web/dist/css/skins/_all-skins.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

		<![endif]-->
<style>
	#dialog-confirm{
		display:none;
	}
</style>		
		
	</head>
	<body class="skin-blue sidebar-mini">
		<?php if(isset($token) AND $token != '')
			{
		?>		
		<div class="wrapper">

			  <header class="main-header">
				<nav class="navbar navbar-static-top">
				  <div class="container">
					<div class="navbar-header">
					  <a class="navbar-brand" href="/index.html"><b>C.E.P.</b>S.A.S.</a>
					  <button data-target="#navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
						<i class="fa fa-bars"></i>
					  </button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div id="navbar-collapse" class="collapse navbar-collapse pull-left">
					  <ul class="nav navbar-nav">
						<li class="active"><a href="crear.php?usu=<?=$usu?>&token=<?=$token?>">CREAR ESTUDIANTE<span class="sr-only">(current)</span></a></li>
					    <li>&nbsp;</li>
						<li class="active"><a href="rep_inscrip.php?usu=<?=$usu?>&token=<?=$token?>">REPORTE INSCRIPCIONES<span class="sr-only">(current)</span></a></li>
					  </ul>             
					</div><!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
					  <ul class="nav navbar-nav">
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
						  <!-- Menu Toggle Button -->
						  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<!-- The user image in the navbar-->
							<img alt="User Image" class="user-image" src="<?= B_TOOLS_JS ?>/web/dist/img/user.png">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?=$usuario['primer_nombre']?> <?=$usuario['segundo_nombre']?> <?=$usuario['primer_apellido']?> <?=$usuario['segundo_apellido']?> - <?= $roll ?></span>
						  </a>
						  
						</li>
					  </ul>
					</div><!-- /.navbar-custom-menu -->
				  </div><!-- /.container-fluid -->
				</nav>
			  </header>
			  <!-- Full Width Column -->
			  <div class="content-wrapper" style="min-height: 242px;">
				<div class="container">
				  <!-- Content Header (Page header) -->
					  <section class="content-header">
						<h1>
						  REPORTE INSCRIPCIONES
						 
						</h1>
						<ol class="breadcrumb">
						  <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
						  <li><a href="login.php">login</a></li>
						  <li class="active">Administrador</li>
						</ol>
					  </section>

				  <!-- Main content -->
					<section class="content">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
									  <h3 class="box-title">Base de datos ESTUDIANTES</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
									    <form name="FORMA" method="POST">
									    <table border="0">
									           <th>Desde:</th>
									           <td>
									               <input type="date" name="fecha_ini" value="<?= $fecha_ini?>" required>
									           </td>
									           <th>Hasta:</th>
									           <td>
									               <input type="date" name="fecha_fin" value="<?= $fecha_fin?>" required></td>
									           <th>Estado</th>
									           <td>
									               <select name="estado">
									                   <option value="">-Seleccionar</option>
									       <?php    while($estados = $aux_estados->fetch_array())
                                                    {?>
                                                        <option value="<?= $estados['estado']?>" <?php if($estado==$estados['estado']) echo 'selected'; ?> >
                                                            <?= $estados['estado']?>
                                                        </option>
                                            <?php   } ?>
									               </select>
									           </td>
									           <td>
									               <input type="submit" value="Filtrar" name="Filtrar">
									           </td>
									    </table><br>
									        <input type="hidden" name="token" value="<?= $token?>">
									    </form>
									  <table id="example1" class="table table-bordered table-striped">
										<thead>
										  <tr>
											<th>#</th>
											<th>DOCUMENTO</th>
											<th>APELLIDO 1</th>
											<th>APELLIDO 2</th>
											<th>NOMBRE 1</th>
											<th>NOMBRE 2</th>
											<th>CURSO</th>
											<th>FEC. MODIFICA</th>
											<th>ESTADO</th>
											<th>FEC. CREA</th>
										  </tr>
										</thead>
										<tbody>
										<?php 
										    $cont=0; 
											while($datos = $estudiantes->fetch_array())
											{
											    $cont++;	$c1=""; $c2="";
											    if($datos['dia']<10){$c2="0";}  if($datos['mes']<10){$c1="0";}
											   // echo "<pre>"; print_r($datos); echo "</pre>";?>		
												<tr>
												    <td><?= $cont?></td>
													<td><?=$datos['cedula']?></td>
													<td><?=$datos['apellido1']?></td>
													<td><?=$datos['apellido2']?></td>
													<td><?=$datos['nombre1']?></td>
													<td><?=$datos['nombre2']?></td>
													<td><?=$datos['curso']?></td>
													<td><?= $datos['año']."-".$c1.$datos['mes']."-".$c2.$datos['dia']?></td>
													<td><?=$datos['estado']?></td>
													<td><?=$datos['fec_crea']?></td>
												  </tr>
										<?php		  
											}
										?>	
										  
										</tbody>
										<tfoot>
										  <tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										  </tr>
										</tfoot>
									  </table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
								<a href="listado_general_xls.php">Exportar listado</a>								
							</div>
						</div>
					</section><!-- /.content -->
				</div><!-- /.container -->
			  </div><!-- /.content-wrapper -->
			<footer class="main-footer ">
				<div class="container">
				  <div class="pull-right hidden-xs">
					<b>Version</b> 1.0
				  </div>
				  <strong>Copyright &copy; MBC-Partners S.A.S  -  2016   <a href="http://www.mbc-partners.com.co">www.mbc-partners.com.co</a></strong>    All rights reserved.
				</div><!-- /.container -->
			</footer>			
		</div>	

    <!-- jQuery 2.1.4 -->
    <script src="<?= B_TOOLS_JS ?>web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= B_TOOLS_JS ?>web/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
	<script src="<?= B_TOOLS_JS ?>web/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= B_TOOLS_JS ?>web/plugins/datatables/dataTables.bootstrap.min.js"></script>
 	<script src="<?= B_TOOLS_JS ?>mbcaccionistas.js"></script>
	<script src="<?= B_JQ ?>jquery.confirm.js"></script>
    <!-- page script -->
    <script>
		 $(function () {
			//$("#example1").DataTable();	
			 $("#example1").DataTable({
			"lengthMenu": [[20, 30, 40, -1], [20, 30, 40, "All"]]
			});
			});
		function Eliminar_estudiante(id){			
		
			$.confirm({
				'title'		: 'Por favor confirme',
				'message'	: 'Está seguro que desea eliminar el registro?',
				'buttons'	: {
					'SI'	: {
						'class'	: 'blue',
						'action': function(){
							$.ajax({
							type:"POST",
							url:"eliminar_estudiante.php",
							data:{'id':id},
							success: function(msg){
									location.reload();							
								}
							});	
													
						}
					},
					'NO'	: {
						'class'	: 'gray',
						'action': function(){}	
					}
				}
			});
		} 
    </script>
	<?php
		}
		else
			echo "<h1>ACCESO NO AUTORIZADO</h1>";	
	?>
  </body>
</html>
