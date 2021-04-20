<?php 
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
$token = $_GET['token'];
$usu = $_GET['usu'];
$fecha1 = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$ahora=$fecha1->format('Y-m-d H:i:s');
$usuario = datosusuario($usu);
if($usuario['id_roll'] == 1)
	$roll = 'ADMINISTRADOR';
else
	$roll = 'ASISTENTE';

$estudiantes = listarestudiantes();
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
						  LISTADO GENERAL 
						  <small>Estudiantes</small>
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
									  <table id="example1" class="table table-bordered table-striped">
										<thead>
										  <tr>
											<th>ID</th>
											<th>DOCUMENTO</th>
											<th>NOMBRE 1</th>
											<th>NOMBRE 2</th>
											<th>APELLIDO 1</th>
											<th>APELLIDO 2</th>
											<th>FECHA INGRESO</th>
											<th>VER</th>
											<th>ELIMINAR</th>
										  </tr>
										</thead>
										<tbody>
										<?php 
											while($datos = $estudiantes->fetch_array())
											{
										?>		
												<tr>
													<td><?=$datos['id']?></td>
													<td><?=$datos['cedula']?></td>
													<td><?=$datos['nombre1']?></td>
													<td><?=$datos['nombre2']?></td>
													<td><?=$datos['apellido1']?></td>
													<td><?=$datos['apellido2']?></td>
													<td><?=$datos['fecha_crea']?></td>
													<td><a class="btn btn-info btn-flat" href="editar.php?usu=<?=$usu?>&token=<?=$token?>&id=<?=$datos['id']?>" type="button"><i class="fa fa-edit"></i></a></td>
													<td><a class="btn btn-danger btn-flat" href="javascript:void(0);" onclick="Eliminar_estudiante('<?=$datos['id']?>');" type="button"><i class="fa fa-remove"></i></a></td>
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
