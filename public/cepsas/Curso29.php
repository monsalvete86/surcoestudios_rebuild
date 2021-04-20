<?php 
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
session_start();
//$token = $_GET['token'];
//$usu = $_GET['usu'];
//print_r($_GET);

if(isset($_SESSION['usuario']))
	echo $_SESSION['usuario'];

$row=array();
if(isset($_SESSION['alumno']))
{
	$alumno = $_SESSION['alumno'];
	$row = consultarAlumno($alumno);
	$id_alumno = $row['id'];
	
	$curso = 29;
	$consulta2 = consultarResultadoPrueba($id_alumno, $curso);
}

if (isset($_POST['cerrar_sesion']))
{
	session_destroy();
	header('Location: cursos.php');
}
?>
<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>C.E.P.S.A.S. | Curso 29</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="tools/web/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="tools/web/css/font-awesome.min.css">
		<link rel="stylesheet" href="tools/web/css/ionicons.min.css">
	   <!-- Theme style -->
		<link rel="stylesheet" href="tools/web/dist/css/AdminLTE.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="tools/web/dist/css/skins/_all-skins.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->	
				
	</head>
	<body class="skin-blue sidebar-mini">
	<!-- contenido a copiar para generar la cabecera -->
		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="../../index2.html"><b>C.E.P.</b>S.A.S.</a>
						<button data-target="#navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							<i class="fa fa-bars"></i>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div id="navbar-collapse" class="collapse navbar-collapse pull-left">
						            
					</div><!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
						<!-- User Account Menu -->
							<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<!-- validar si el usuario ya esta en session y si esta mostrar el nombre en caso contrario mandarlo a la pantalla de logueo
							 de estudiantes y regresar a esta pantalla-->
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<!-- The user image in the navbar-->
									<img alt="User Image" class="user-image" src="tools/web/dist/img/user.png">
						<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<?php	
										$DatosAlumno= estudiante($id,$_SESSION['alumno']);
										if(isset($_SESSION['alumno']))
										{ ?>
											<?=$row['nombre1']?> 
											<?=$row['nombre2']?> 
											<?=$row['apellido1']?> 
											<?=$row['apellido2']?>
											
									<?php	
										}
										else
										{?>
											<a href="LoginEstudiante.php">Ingresar</a>
									<?	}?>
										
									
									<?php
									if(isset($_SESSION['alumno']))
									{
									?>
									<form action="" method="POST">
										<input type="submit" name="cerrar_sesion" value="Cerrar sesi&oacute;n">
									</form>
									<?php
									}
									else
									{
										
									}
									?>
								</a>                  
							</li>
						</ul>
					</div><!-- /.navbar-custom-menu -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<section class="content-header">
			<h1>
			  ERGONOMIA
			</h1>
			<ol class="breadcrumb">
			  <li><a href="index.html"><i class="fa fa-dashboard"></i>Home</a></li>
			  <li><a href="cursos.php">Cursos</a></li>						  
			  <li><a href="Curso9.php">Ergonomía</a></li>						  
			</ol>
		</section><br>
		<div style="position:absolute;left:30px">
			<div>
				<span>Descargar contenido del curso <a target="_blank" href="pdf/29 Ergonomia.pdf">aqu&iacute;</a>.</span>
			</div>
			<div>
			<span><strong>Material de apoyo Audiovisual:</strong></span>
				<div style="left: 61px; position: relative">
					<a target="_blank" href="https://www.youtube.com/watch?v=sojGgs0Ye-8" target="_blank">Introducción a la Ergonomía</a>
				</div>
			<div>
				<?php
				if(isset($_SESSION['alumno']))
				{
					if($consulta2['curso'] == 29)
					{
						$MsjResult="Aprob&oacute;";
						if($consulta2['resultado']<60){$MsjResult="No aprob&oacute";}
						echo "<a href='Curso29_prueba.php'><strong>Presentar prueba del curso</strong></a>
						<span> (Ultimo resultado: ".$consulta2['resultado']." % <b>$MsjResult!!!<b>)</span>";
					}
					else
					{
						echo "<a href='Curso29_prueba.php'><strong>Presentar prueba del curso</strong></a>";
					}
				}
				else
				{
					echo "<a href='LoginEstudiante.php'><strong>Presentar prueba del curso</strong></a>";
				}
				?>
			</div>
			<div>
				<a href="cursos.php" class="btn btn-default">Regresar</a>
			</div>
		</div>
	</body>		
</html>	