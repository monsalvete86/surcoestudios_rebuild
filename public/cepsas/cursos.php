<?php 
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include('tools/controlador.php');
session_start();
$row=array();
if(isset($_SESSION['alumno']))
{
	$alumno = $_SESSION['alumno'];
	$row = consultarAlumno($alumno);
	$id_alumno = $row['id'];
	$curso1 = consultarResultadoPrueba($id_alumno, '1');	
	$curso2 = consultarResultadoPrueba($id_alumno, '2');
	$curso3 = consultarResultadoPrueba($id_alumno, '3');
	$curso4 = consultarResultadoPrueba($id_alumno, '4');
	$curso5 = consultarResultadoPrueba($id_alumno, '5');
	$curso6 = consultarResultadoPrueba($id_alumno, '6');
	$curso7 = consultarResultadoPrueba($id_alumno, '7');
	$curso8 = consultarResultadoPrueba($id_alumno, '8');
	$curso9 = consultarResultadoPrueba($id_alumno, '9');
	$curso10 = consultarResultadoPrueba($id_alumno, '10');
	$curso11 = consultarResultadoPrueba($id_alumno, '11');	
	$curso14 = consultarResultadoPrueba($id_alumno, '14');	
	$curso15 = consultarResultadoPrueba($id_alumno, '15');	
	$curso16 = consultarResultadoPrueba($id_alumno, '16');	
	$curso17 = consultarResultadoPrueba($id_alumno, '17');	
	$curso18 = consultarResultadoPrueba($id_alumno, '18');	
	$curso19 = consultarResultadoPrueba($id_alumno, '19');	
	$curso20 = consultarResultadoPrueba($id_alumno, '20');
	$curso21 = consultarResultadoPrueba($id_alumno, '21');
	$curso22 = consultarResultadoPrueba($id_alumno, '22');
	$curso23 = consultarResultadoPrueba($id_alumno, '23');
	$curso24 = consultarResultadoPrueba($id_alumno, '24');
	$curso25 = consultarResultadoPrueba($id_alumno, '25');
	$curso26 = consultarResultadoPrueba($id_alumno, '26');
	$curso27 = consultarResultadoPrueba($id_alumno, '27');
	$curso28 = consultarResultadoPrueba($id_alumno, '28');
	$curso29 = consultarResultadoPrueba($id_alumno, '29');
	$curso30 = consultarResultadoPrueba($id_alumno, '30');
	$curso31 = consultarResultadoPrueba($id_alumno, '31');
	$curso32 = consultarResultadoPrueba($id_alumno, '32');
	
	//FALTA AGREGAR AQUI LOS CURSOS REGISTRADOS EL 2018-03-09
{	
	$curso = 1;
	$consulta2 = consultarResultadoPrueba($id_alumno, $curso);
}
}
//print_r($consulta2);

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
		<title>C.E.P.S.A.S. | Cursos</title>
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
			  LISTADO CURSOS 
			  <span><?php if(isset($_SESSION['alumno'])) echo $_SESSION['alumno']; ?></span>
			</h1>
			<ol class="breadcrumb">
			  <li><a href="index.html"><i class="fa fa-dashboard"></i>Home</a></li>
			  <li><a href="cursos.php">Cursos</a></li>						  
			</ol>
		  </section>
		<div class="col-xs-10">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h4 class="box-title">Nuestros Cursos</h4>
				</div>
				<span><?php //echo $row2['curso']; ?></span>
				<div class="box-body">
					<div class="box-group" id="accordion">
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso1.php">
										1 - MANEJO DEFENSIVO
								<?php 
										if($curso1['curso'] == 1){ 
											$MsjResult="aprob&oacute;";
											if($curso1['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso1['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>	
							<?php
							        if($curso1['curso'] == 1&&hayRespuestas($id_alumno,1)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=1">Ver Resultados</a>    
					        <?php   }
							?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										1 - MANEJO DEFENSIVO														
									</a>
						<?php	}?>			
								</h4>
								<!-- ESTE CURSO TIENE DIPLOMA DE 8 HORAS-->
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso2.php">
										2 - SEGURIDAD VIAL	
								<?php 
										if($curso2['curso'] == 2){ 
											$MsjResult="aprob&oacute;";
											if($curso2['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso2['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>	
								<?php
							        if($curso2['curso'] == 2&&hayRespuestas($id_alumno,2)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=2">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										2 - SEGURIDAD VIAL														
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso3.php">
										3 - MECANICA BASICA
								<?php 
										if($curso3['curso'] == 3){ 
											$MsjResult="aprob&oacute;";
											if($curso3['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso3['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>		
								<?php
							        if($curso3['curso'] == 3&&hayRespuestas($id_alumno,3)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=3">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										3 - MECANICA BASICA
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso4.php">
										4 - MANEJO DE EXTINTORES Y CONTRA INCENDIOS	
								<?php 
										if($curso4['curso'] == 4){ 
											$MsjResult="aprob&oacute;";
											if($curso4['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso4['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>
							<?php
							        if($curso4['curso'] == 4&&hayRespuestas($id_alumno,4)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=4">Ver Resultados</a>    
					        <?php   }   ?>
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										4 - MANEJO DE EXTINTORES Y CONTRA INCENDIOS														
									</a>
						<?php	}?>
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso5.php">
										5 - PRIMEROS AUXILIOS
								<?php 
										if($curso5['curso'] == 5){ 
											$MsjResult="aprob&oacute;";
											if($curso5['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso5['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>
								<?php
							        if($curso5['curso'] == 5&&hayRespuestas($id_alumno,5)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=5">Ver Resultados</a>    
					        <?php   }   ?>	
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										5 - PRIMEROS AUXILIOS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso6.php">
										6 - TRANSPORTE DE SUSTANCIAS Y MERCANCIAS PELIGROSAS, PLAN DE CONTINGENCIA ANTE DERRAME, CLASIFICACION, ETIQUETADO Y ROTULADO DE NACIONES UNIDAS
								<?php 
										if($curso6['curso'] == 6){ 
											$MsjResult="aprob&oacute;";
											if($curso6['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso6['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>	
								<?php
							        if($curso6['curso'] == 6&&hayRespuestas($id_alumno,7)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=6">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										6 - TRANSPORTE DE SUSTANCIAS Y MERCANCIAS PELIGROSAS, PLAN DE CONTINGENCIA ANTE DERRAME, CLASIFICACION, ETIQUETADO Y ROTULADO DE NACIONES UNIDAS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso7.php">
										7 - ALISTAMIENTO VEHICULAR
								<?php 
										if($curso7['curso'] == 7){ 
											$MsjResult="aprob&oacute;";
											if($curso7['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso7['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>
								<?php
							        if($curso7['curso'] == 7&&hayRespuestas($id_alumno,7)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=7">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										7 - ALISTAMIENTO VEHICULAR
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso8.php">
										8 - CONTROL DE EMERGENCIAS EN DERRAME DE HIDROCARBUROS
								<?php 
										if($curso8['curso'] == 8){ 
											$MsjResult="aprob&oacute;";
											if($curso8['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso8['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>			
								<?php
							        if($curso8['curso'] == 8&&hayRespuestas($id_alumno,8)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=8">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										8 - CONTROL DE EMERGENCIAS EN DERRAME DE HIDROCARBUROS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso9.php">
										9 - ATENCION AL CLIENTE
								<?php 
										if($curso9['curso'] == 9){ 
											$MsjResult="aprob&oacute;";
											if($curso9['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso9['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>										
								<?php
							        if($curso9['curso'] == 9&&hayRespuestas($id_alumno,9)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=9">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										9 - ATENCION AL CLIENTE
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso10.php">
										10 - COOPERATIVISMO
								<?php 
										if($curso10['curso'] == 10){ 
											$MsjResult="aprob&oacute;";
											if($curso10['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso10['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>
								<?php
							        if($curso10['curso'] == 10&&hayRespuestas($id_alumno,10)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=10">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										10 - COOPERATIVISMO
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso11.php">
										11 - ESPACIOS CONFINADOS
								<?php 
										if($curso11['curso'] == 11){ 
											$MsjResult="aprob&oacute;";
											if($curso11['resultado']<60){		$MsjResult="No aprob&oacute";		}
											echo "<span>(Ultimo resultado: ".$curso11['resultado']." % <b>$MsjResult!!!<b>)</span>";
										}
									?>
									</a>
								<?php
							        if($curso11['curso'] == 11&&hayRespuestas($id_alumno,11)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=11">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										11 - ESPACIOS CONFINADOS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso14.php">
										14 - BRIGADISTAS (CONTRA INCENDIOS)
										
								<?php 
										if($curso14['curso'] == 14){ 
											$MsjResult="aprob&oacute;";
											if($curso14['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso14['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso14['curso'] == 14&& hayRespuestas($id_alumno,14)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=14">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										14 - BRIGADISTAS (CONTRA INCENDIOS)
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso15.php">
										15 - BRIGADISTAS (EVACUACION Y RESCATE)
										
								<?php 
										if($curso15['curso'] == 15){ 
											$MsjResult="aprob&oacute;";
											if($curso15['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso15['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso15['curso'] == 15&& hayRespuestas($id_alumno,15)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=15">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										15 - BRIGADISTAS (EN ALTURAS)
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso16.php">
										16 - BRIGADISTAS (PRIMEROS AUXILIOS)
										
								<?php 
										if($curso15['curso'] == 16){ 
											$MsjResult="aprob&oacute;";
											if($curso16['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso16['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso16['curso'] == 16&& hayRespuestas($id_alumno,16)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=16">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										16 - BRIGADISTAS (PRIMEROS AUXILIOS)
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso17.php">
										17 - SEGURIDAD VIAL Y NORMAS DE TRANSITO
										
								<?php 
										if($curso17['curso'] == 17){ 
											$MsjResult="aprob&oacute;";
											if($curso17['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso17['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso17['curso'] == 17&& hayRespuestas($id_alumno,17)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=17">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										17 - SEGURIDAD VIAL Y NORMAS DE TRANSITO
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso18.php">
										18 - RESPUESTA Y ATENCION DE EMERGENCIAS
										
								<?php 
										if($curso18['curso'] == 18){ 
											$MsjResult="aprob&oacute;";
											if($curso18['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso18['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso18['curso'] == 18&& hayRespuestas($id_alumno,18)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=18">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										18 - RESPUESTA Y ATENCION DE EMERGENCIAS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso20.php">
										20 - ACTUALIZACION DE NORMAS DE TRANSITO
										
								<?php 
										if($curso21['curso'] == 20){ 
											$MsjResult="aprob&oacute;";
											if($curso20['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso20['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso20['curso'] == 20&& hayRespuestas($id_alumno,20)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=20">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										20 - ACTUALIZACION DE NORMAS DE TRANSITO
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso21.php">
										21 - PRIMEROS AUXILIOS - NIVEL AVANZADO
										
								<?php 
										if($curso21['curso'] == 21){ 
											$MsjResult="aprob&oacute;";
											if($curso21['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso21['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso21['curso'] == 21&& hayRespuestas($id_alumno,21)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=21">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										21 - PRIMEROS AUXILIOS - NIVEL AVANZADO
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso23.php">
										23 - PRIMEROS AUXILIOS Y ERGONOMIA EN EL TRANSPORTE
										
								<?php 
										if($curso213['curso'] == 23){ 
											$MsjResult="aprob&oacute;";
											if($curso23['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso23['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso23['curso'] == 23&& hayRespuestas($id_alumno,23)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=23">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										23 - PRIMEROS AUXILIOS Y ERGONOMIA EN EL TRANSPORTE
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso24.php">
										24 - RESCATE VERTICAL EN ALTURAS
										
								<?php 
										if($curso24['curso'] == 24){ 
											$MsjResult="aprob&oacute;";
											if($curso24['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso24['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso24['curso'] == 24&& hayRespuestas($id_alumno,24)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=24">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										24 - RESCATE VERTICAL EN ALTURAS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso25.php">
										25 -  ENTRENAMIENTO EN SISTEMAS DE COMANDO E INCIDENTES
										
								<?php 
										if($curso25['curso'] == 25){ 
											$MsjResult="aprob&oacute;";
											if($curso25['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso25['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso25['curso'] == 25&& hayRespuestas($id_alumno,25)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=25">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										25 -  ENTRENAMIENTO EN SISTEMAS DE COMANDO E INCIDENTES
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso26.php">
										26 - PRIMERA RESPUESTA DE INCIDENTES CON MATERIALES PELIGROSOS
										
								<?php 
										if($curso26['curso'] == 26){ 
											$MsjResult="aprob&oacute;";
											if($curso26['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso26['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso26['curso'] == 26&& hayRespuestas($id_alumno,13)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=26">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										26 - PRIMERA RESPUESTA DE INCIDENTES CON MATERIALES PELIGROSOS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso27.php">
										27 - RESPUESTA Y ATENCION DE EMERGENCIAS CON MATERIALES PELIGROSOS
										
								<?php 
										if($curso27['curso'] == 27){ 
											$MsjResult="aprob&oacute;";
											if($curso27['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso27['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso27['curso'] == 27&& hayRespuestas($id_alumno,17)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=27">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										27 - RESPUESTA Y ATENCION DE EMERGENCIAS CON MATERIALES PELIGROSOS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso28.php">
										28 - ACONDICIONAMIENTO DE ANDAMIOS PARA TRABAJO EN ALTURAS
										
								<?php 
										if($curso28['curso'] == 28){ 
											$MsjResult="aprob&oacute;";
											if($curso28['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso28['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso28['curso'] == 28&& hayRespuestas($id_alumno,28)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=28">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										28 - ACONDICIONAMIENTO DE ANDAMIOS PARA TRABAJO EN ALTURAS
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso29.php">
										29 - ERGONOMIA
										
								<?php 
										if($curso29['curso'] == 29){ 
											$MsjResult="aprob&oacute;";
											if($curso29['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso29['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso29['curso'] == 29&& hayRespuestas($id_alumno,29)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=29">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										29 - ERGONOMIA
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						
						
						
						
						
						
						
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso30.php">
										30 - OFFICE - WORD
										
								<?php 
										if($curso30['curso'] == 30){ 
											$MsjResult="aprob&oacute;";
											if($curso30['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso30['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso30['curso'] == 30&& hayRespuestas($id_alumno,30)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=30">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										30 - OFFICE - WORD
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso31.php">
										31 - OFFICE - EXCEL
										
								<?php 
									if($curso31['curso'] == 31){ 
											$MsjResult="aprob&oacute;";
											if($curso31['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso31['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso31['curso'] == 31&& hayRespuestas($id_alumno,31)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=31">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										31 - OFFICE - EXCEL
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
						<?php	if(isset($_SESSION['alumno']))
								{ ?>
									<a data-toggle="collapse" data-parent="#accordion" href="Curso32.php">
										32 - OFFICE - POWER POINT
										
								<?php 
										if($curso32['curso'] == 32){ 
											$MsjResult="aprob&oacute;";
											if($curso32['resultado']<60){ $MsjResult="No aprob&oacute"; }
									        echo "<span>(Ultimo resultado: ".$curso32['resultado']." % <b>$MsjResult!!!<b>)</span>";
									    }
									?>
									</a>
								<?php
							        if($curso32['curso'] == 32 && hayRespuestas($id_alumno,32)){ ?>
							            <br><a data-toggle="collapse" target="_blank" data-parent="#accordion" 
							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=32">Ver Resultados</a>    
					        <?php   }   ?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
						<?php	}
								else{?>
									<!--<a class="diploma" href="diploma.php?id=1&amp;curso=1" target="_blank">-->
									<a data-toggle="collapse" data-parent="#accordion" href="LoginEstudiante.php">
										32 - OFFICE - POWER POINT
									</a>
						<?php	}?>			
								</h4>
							</div>
						</div>
					</div>
				</div>
				<div>
					<a href="index.html" class="btn btn-default">Regresar</a>
					
				</div>
			</div>
			
		</div>
	
		<BR><BR><BR>
		
			
	</body>
</html>