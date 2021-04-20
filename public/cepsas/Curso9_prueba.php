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
$r1=$r2=$r3=$r4=$r5=$r6=$r7=$r8=$r9=$r10=0;
if(isset($_POST['Enviar']))
{
	$correctas = 0;
	$respuestas=array();
	
	$res1 = $_POST['res1'];
	if(count($res1)>0)
	{
		foreach($res1 as $r1){}
		if($r1 == "c")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[1]=$r1;
	$res2 = $_POST['res2'];
	if(count($res2)>0)
	{
		foreach($res2 as $r2){}
		if($r2 == "b")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[2]=$r2;
	$res3 = $_POST['res3'];
	if(count($res3)>0)
	{
		foreach($res3 as $r3){}
		if($r3 == "b")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[3]=$r3;
	$res4 = $_POST['res4'];
	if(count($res4)>0)
	{
		foreach($res4 as $r4){}
		if($r4 == "b")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[4]=$r4;
	$res5 = $_POST['res5'];
	if(count($res5)>0)
	{
		foreach($res5 as $r5){}
		if($r5 == "c")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[5]=$r5;
	$res6 = $_POST['res6'];
	if(count($res6)>0)
	{
		foreach($res6 as $r6){}
		if($r6 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[6]=$r6;
	$res7 = $_POST['res7'];
	if(count($res7)>0)
	{
		foreach($res7 as $r7){}
		if($r7 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[7]=$r7;
	$res8 = $_POST['res8'];
	if(count($res8)>0)
	{
		foreach($res8 as $r8){}
		if($r8 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[8]=$r8;
	$res9 = $_POST['res9'];
	if(count($res9)>0)
	{
		foreach($res9 as $r9){}
		if($r9 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[9]=$r9;
	$res10 = $_POST['res10'];
	if(count($res10)>0)
	{
		foreach($res10 as $r10){}
		if($r10 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[10]=$r10;
	$resultado = (($correctas / 10) * 100);
	
	
	if(isset($_SESSION['alumno']))
	{
		$alumno = $_SESSION['alumno'];
		$row = consultarAlumno($alumno);
		
		$id_alumno = $row['id'];
		$curso = 9;	
	}
	if($BanFalta==0)
	{
		$resultado = resultadoPrueba($id_alumno, $curso, $resultado);
		respuestasPrueba($id_alumno,$curso,$respuestas);
		header ("location: Curso9.php");
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
		<title>C.E.P.S.A.S. | Curso 9</title>
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
						<th colspan="4" style="text-align:center"><b>Curso 9 : ATENCION AL CLIENTE - Prueba de conocimientos</b></th>
					</thead>
					
					<tbody>
						<tr>
							<td colspan="4">Marque la respuesta correcta.</td>
						</tr>
						
						<tr>
							<td style="text-align:center"><b>No.</b></td>
							<td colspan="3" style="text-align:center">Pregunta</td>
						</tr>
						
						<tr>
							<td rowspan="5"><b>1.</b></td>
							<td colspan="3">Como se llama a la persona, que demanda un producto o servicio a una organizaci&oacute;n, haciendo un acto de elecci&oacute;n voluntaria.</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>Jefe</td>
							<td><input type="radio" name="res1[]" <?php if($r1=="a"&&$r1!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>Empleado</td>
							<td><input type="radio" name="res1[]" <?php if($r1=="b"&&$r1!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>Cliente</td>
							<td><input type="radio" name="res1[]" <?php if($r1=="c"&&$r1!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						<tr>
							<td><b>d.</b></td>
							<td>Ninguna de las anteriores</td>
							<td><input type="radio" name="res1[]" <?php if($r1=="d"&&$r1!="0"){ echo "checked"; }?> value="d"></td>
						</tr>
						
						<tr>
							<td rowspan="5"><b>2.</b></td>
							<td colspan="3">Cu&aacute;l de las siguientes parejas, son tipos de clientes.</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>Cliente bueno &#45; Cliente malo</td>
							<td><input type="radio" name="res2[]" <?php if($r2=="a"&&$r2!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>Cliente Interno &#45; Cliente externo</td>
							<td><input type="radio" name="res2[]" <?php if($r2=="b"&&$r2!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>Cliente Comprador &#45; Cliente no comprador</td>
							<td><input type="radio" name="res2[]" <?php if($r2=="c"&&$r2!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						<tr>
							<td><b>d.</b></td>
							<td>Cliente alto &#45; Cliente bajo</td>
							<td><input type="radio" name="res2[]" <?php if($r2=="d"&&$r2!="0"){ echo "checked"; }?> value="d"></td>
						</tr>
						
						<tr>
							<td rowspan="5"><b>3.</b></td>
							<td colspan="3">Una Persona con baja autoestima y que teme expresar lo que desea, es:</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>Un cliente exigente</td>
							<td><input type="radio" name="res3[]" <?php if($r3=="a"&&$r3!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>Un cliente inseguro</td>
							<td><input type="radio" name="res3[]" <?php if($r3=="b"&&$r3!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>Un cliente inconforme</td>
							<td><input type="radio" name="res3[]" <?php if($r3=="c"&&$r3!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						<tr>
							<td><b>d.</b></td>
							<td>Todas las anteriores</td>
							<td><input type="radio" name="res3[]" <?php if($r3=="d"&&$r3!="0"){ echo "checked"; }?> value="d"></td>
						</tr>
						
						<tr>
							<td rowspan="5"><b>4.</b></td>
							<td colspan="3">Una persona que muestra conocimientos de los art&iacute;culos y servicios que solicita con relaci&oacute;n a calidad, marcas, precios, ventajas, desventajas y procedimientos, es:</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>Cliente inconforme</td>
							<td><input type="radio" name="res4[]" <?php if($r4=="a"&&$r4!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>Cliente informado</td>
							<td><input type="radio" name="res4[]" <?php if($r4=="b"&&$r4!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>Cliente seguro</td>
							<td><input type="radio" name="res4[]" <?php if($r4=="c"&&$r4!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						<tr>
							<td><b>d.</b></td>
							<td>Cliente indeciso</td>
							<td><input type="radio" name="res4[]" <?php if($r4=="d"&&$r4!="0"){ echo "checked"; }?> value="d"></td>
						</tr>
						
						<tr>
							<td rowspan="5"><b>5.</b></td>
							<td colspan="3">Una persona con bajo nivel de instrucci&oacute;n formal e informal, 
							 marcos de referencia y conocimientos muy limitados, es:</td>
						</tr>
						<tr>
							<td><b>a.</b></td>
							<td>Cliente inconforme</td>
							<td><input type="radio" name="res5[]" <?php if($r5=="a"&&$r5!="0"){ echo "checked"; }?> value="a"></td>
						</tr>
						<tr>
							<td><b>b.</b></td>
							<td>Cliente ideal</td>
							<td><input type="radio" name="res5[]" <?php if($r5=="b"&&$r5!="0"){ echo "checked"; }?> value="b"></td>
						</tr>
						<tr>
							<td><b>c.</b></td>
							<td>Cliente con limitaciones</td>
							<td><input type="radio" name="res5[]" <?php if($r5=="c"&&$r5!="0"){ echo "checked"; }?> value="c"></td>
						</tr>
						<tr>
							<td><b>d.</b></td>
							<td>Cliente interno</td>
							<td><input type="radio" name="res5[]" <?php if($r5=="d"&&$r5!="0"){ echo "checked"; }?> value="d"></td>
						</tr>
						
						<tr>
							<td colspan="4"><b>Marque &#34;V&#34; si es verdadero &#34;F&#34; si es falsa la afirmaci&oacute;n.</td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>6.</b></td>
							<td colspan="3">Las quejas son inconformidades e insatisfacciones que se generan al momento de recibir un servicio o producto, o luego de estar us&aacute;ndolo.</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res6[]" <?php if($r6=="f"&&$r6!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res6[]" <?php if($r6=="v"&&$r6!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>7.</b></td>
							<td colspan="3">Precaria calidad del art&iacute;culo o servicios ofrecidos, tardanza en la entrega, costo elevado, son quejas frecuentes de los clientes.</td>
						</tr>
						<tr>
							<td colspan="2">F</td> 
							<td><input type="radio" name="res7[]" <?php if($r7=="f"&&$r7!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res7[]" <?php if($r7=="v"&&$r7!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>8.</b></td>
							<td colspan="3">Calidad se define de manera pr&aacute;ctica como: 
							&#34;El conjunto de condiciones y acciones de un servicio capaz de satisfacer plenamente al cliente&#34;.</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res8[]" <?php if($r8=="f"&&$r8!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res8[]" <?php if($r9=="v"&&$r9!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>9.</b></td>
							<td colspan="3">Comunicaci&oacute;n verbal es la que se hace solo por medio de verbos.</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res9[]" <?php if($r9=="f"&&$r9!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res9[]" <?php if($r9=="v"&&$r9!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>10.</b></td>
							<td colspan="3">El lenguaje corporal es un tipo de comunicación sin palabras. Es comunicarse a trav&eacute;s de los gestos, la postura, la mirada, la entonaci&oacute;n.</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res10[]" <?php if($r10=="f"&&$r10!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res10[]" <?php if($r10=="v"&&$r10!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr align="center">
							<td colspan="4">
								<input type="submit" value="Enviar" name="Enviar" class="btn btn-success">
								<a href="Curso9.php" class="btn btn-default">Regresar</a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>		
</html>	