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
}

if (isset($_POST['cerrar_sesion']))
{
	session_destroy();
	header('Location: cursos.php');
}
$BanFalta=0;
$res1=$res2=$res3=$res4=$res5=$r6=$r7=$res8=$res9=$res10=0;
if(isset($_POST['Enviar']))
{
	$correctas = 0;
	$respuestas=array();
	
	$res1 = $_POST['res1'];
	if(count($res1)>0)
	{
		if($res1 == "a" || $res1 == "A")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	
	$respuestas[1]=$res1;
	$res2 = $_POST['res2'];
	if(count($res2)>0)
	{
		if($res2 == "b" || $res2 == "B")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[2]=$res2;
	
	$res3 = $_POST['res3'];
	if(count($res3)>0)
	{
		if($res3 == "c" || $res3 == "C")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[3]=$res3;
	
	$res4 = $_POST['res4'];
	if(count($res4)>0)
	{
		if($res4 == "d" || $res4 == "D")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[4]=$res4;
	
	$res5 = $_POST['res5'];
	if(count($res5)>0)
	{
		if($res5 == "k" || $res5 == "K")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[5]=$res5;
	$res6 = $_POST['res6'];
	if(count($res6)>0)
	{
		foreach($res6 as $r6){}
		if($r6 == "a")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[6]=$r6;
	$res7 = $_POST['res7'];
	if(count($res7)>0)
	{
		foreach($res7 as $r7){}
		if($r7 == "a")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[7]=$r7;
	$res8 = $_POST['res8'];
	if(count($res8)>0)
	{
		if($res8 == 3)
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[8]=$res8;
	$res9 = $_POST['res9'];
	if(count($res9)>0)
	{
		if($res9 == 1)
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[9]=$res9;
	$res10 = $_POST['res10'];
	if(count($res10)>0)
	{
		if($res10 == 2)
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[10]=$res10;
	$resultado = (($correctas / 10) * 100);
	
	
	if(isset($_SESSION['alumno']))
	{
		$alumno = $_SESSION['alumno'];
		$row = consultarAlumno($alumno);
		
		$id_alumno = $row['id'];
		$curso = 4;	
	}
	if($BanFalta==0)
	{
		$resultado = resultadoPrueba($id_alumno, $curso, $resultado);
		respuestasPrueba($id_alumno,$curso,$respuestas);
		header ("location: Curso4.php");
	}
	else
	{?>
		<script>
			alert("Se deben responder todas las preguntas!!!");
		</script>
<?php	
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>C.E.P.S.A.S. | Curso 2</title>
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
		<style>
			table{
			    margin: 0 auto;
			}
		</style>		
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
		<div>
			<form action="" method="POST">
				<table border='1' style="width:800px">
					<thead>
						<th colspan="4" style="text-align:center">Curso 4 : MANEJO DE EXTINTORES Y CONTRAINCENDIOS - Prueba de conocimientos</th>
					</thead>
					
					<tbody>
						<tr>
							<td colspan="4">
								<b>Escriba en el espacio del cuadro en negro de la imagen, la letra correspondiente a la clase de fuego.</b>
							</td>
						</tr>
						
						<tr>
							<td style="text-align:center"><b>No.</b></td>
							<td colspan="3" style="text-align:center"><b>Pregunta</b></td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>1.</b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<img src="images/Curso4/1.png" height="152"></td>
							<td style="text-align:center">
								<select name="res1">
									<option value="a" <?php if($res1=="a"&&$res2!="0") echo "selected";?>>A</option>
									<option value="b" <?php if($res1=="b"&&$res2!="0") echo "selected";?>>B</option>
									<option value="c" <?php if($res1=="c"&&$res2!="0") echo "selected";?>>C</option>
									<option value="d" <?php if($res1=="d"&&$res2!="0") echo "selected";?>>D</option>
									<option value="k" <?php if($res1=="k"&&$res1!="0") echo "selected";?>>K</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>2.</b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<img src="images/Curso4/2.png" height="152"></td>
							<td style="text-align:center">
								<select name="res2">
									<option value="a" <?php if($res2=="a"&&$res2!="0") echo "selected";?>>A</option>
									<option value="b" <?php if($res2=="b"&&$res2!="0") echo "selected";?>>B</option>
									<option value="c" <?php if($res2=="c"&&$res2!="0") echo "selected";?>>C</option>
									<option value="d" <?php if($res2=="d"&&$res2!="0") echo "selected";?>>D</option>
									<option value="k" <?php if($res2=="k"&&$res2!="0") echo "selected";?>>K</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>3.</b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<img src="images/Curso4/3.png" height="152" >
							</td>
							<td style="text-align:center">
								<select name="res3">
									<option value="a" <?php if($res3=="a"&&$res3!="0") echo "selected";?>>A</option>
									<option value="b" <?php if($res3=="b"&&$res3!="0") echo "selected";?>>B</option>
									<option value="c" <?php if($res3=="c"&&$res3!="0") echo "selected";?>>C</option>
									<option value="d" <?php if($res3=="d"&&$res3!="0") echo "selected";?>>D</option>
									<option value="k" <?php if($res3=="k"&&$res3!="0") echo "selected";?>>K</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>4.</b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<img src="images/Curso4/4.png" height="152">
							</td>
							<td style="text-align:center">
								<select name="res4">
									<option value="a" <?php if($res4=="a"&&$res4!="0") echo "selected";?>>A</option>
									<option value="b" <?php if($res4=="b"&&$res4!="0") echo "selected";?>>B</option>
									<option value="c" <?php if($res4=="c"&&$res4!="0") echo "selected";?>>C</option>
									<option value="d" <?php if($res4=="d"&&$res4!="0") echo "selected";?>>D</option>
									<option value="k" <?php if($res4=="k"&&$res4!="0") echo "selected";?>>K</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>5.</b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<img src="images/Curso4/5.png" height="152" >
							</td>
							<td style="text-align:center">
								<select name="res5">
									<option value="a" <?php if($res5=="a"&&$res5!="0") echo "selected";?>>A</option>
									<option value="b" <?php if($res5=="b"&&$res5!="0") echo "selected";?>>B</option>
									<option value="c" <?php if($res5=="c"&&$res5!="0") echo "selected";?>>C</option>
									<option value="d" <?php if($res5=="d"&&$res5!="0") echo "selected";?>>D</option>
									<option value="k" <?php if($res5=="k"&&$res5!="0") echo "selected";?>>K</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="4" ><b>6.</b></td>
							<td colspan="3">&iquest;Cada cu&aacute;nto tiempo se debe hacer mantenimiento a los extintores?</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>1 a&ntilde;o</td>
							<td><input type="radio" name="res6[]" <?php if($r6=="a"&&$r6!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>2 a&ntilde;os</td>
							<td><input type="radio" name="res6[]" <?php if($r6=="b"&&$r6!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>3 a&ntilde;os</td>
							<td><input type="radio" name="res6[]" <?php if($r6=="c"&&$r6!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						
						<tr>
							<td rowspan="4"><b>7.</b></td>
							<td colspan="3">&iquest;Cu&aacute;l es la distancia m&iacute;nima - m&aacute;xima en cms, desde el piso hasta la base del extintor, en cuanto a su ubicaci&oacute;n?</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>20cm &#8211; 130cm</td>
							<td><input type="radio" name="res7[]" <?php if($r7=="a"&&$r7!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>50cm &#8211; 170cm</td>
							<td><input type="radio" name="res7[]" <?php if($r7=="b"&&$r7!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>10cm &#8211; 100cm</td>
							<td><input type="radio" name="res7[]" <?php if($r7=="c"&&$r7!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>8.</b></td>
						</tr>
						<tr>
							<td colspan="2">Accionar el gatillo es el  Paso N&ordm;</td>
							<td style="text-align:center">
								<select name="res8">
									<option value="1" <?php if($res8=="1"&&$res8!="0") echo "selected";?>>1</option>
									<option value="2" <?php if($res8=="2"&&$res8!="0") echo "selected";?>>2</option>
									<option value="3" <?php if($res8=="3"&&$res8!="0") echo "selected";?>>3</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>9.</b></td>
						</tr>
						<tr>
							<td colspan="2">Retirar el pasador del extintor es el Paso N&ordm;</td>
							<td style="text-align:center">
								<select name="res9">
									<option value="1" <?php if($res9=="1"&&$res9!="0") echo "selected";?>>1</option>
									<option value="2" <?php if($res9=="2"&&$res9!="0") echo "selected";?>>2</option>
									<option value="3" <?php if($res9=="3"&&$res9!="0") echo "selected";?>>3</option>
								</selected>
							</td>
						</tr>
						
						<tr>
							<td rowspan="2"><b>10.</b></td>
						</tr>
						<tr>
							<td colspan="2">Dirigir la boquilla del extintor a la base del fuego, es el Paso N&ordm;</td>
							<td style="text-align:center">
								<select name="res10">
									<option value="1" <?php if($res10=="1"&&$res10!="0") echo "selected";?>>1</option>
									<option value="2" <?php if($res10=="2"&&$res10!="0") echo "selected";?>>2</option>
									<option value="3" <?php if($res10=="3"&&$res10!="0") echo "selected";?>>3</option>
								</selected>
							</td>
						</tr>
						
						<tr align="center">
							<td colspan="4">
								<input type="submit" value="Enviar" name="Enviar" class="btn btn-success">
								<a href="Curso4.php" class="btn btn-default">Regresar</a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>		
</html>	