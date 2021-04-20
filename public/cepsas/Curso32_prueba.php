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
$r1=$r2=$r3=$r4=$r5=$r6=$r7=$r8=$r9=$r10=$r11=$r12=$r13=$r14=$r15=$r16=$r17=$r18=0;
if(isset($_POST['Enviar']))
{
	$correctas = 0;
	$respuestas=array();
	
	$res1 = $_POST['res1'];
	if(count($res1)>0)
	{
		foreach($res1 as $r1){}
		if($r1 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[1]=$r1;
	
	$res2 = $_POST['res2'];
	if(count($res2)>0)
	{
		foreach($res2 as $r2){}
		if($r2 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[2]=$r2;
	
	$res3 = $_POST['res3'];
	if(count($res3)>0)
	{
		foreach($res3 as $r3){}
		if($r3 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[3]=$r3;
	
	$res4 = $_POST['res4'];
	if(count($res4)>0)
	{
		foreach($res4 as $r4){}
		if($r4 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[4]=$r4;
	
	$res5 = $_POST['res5'];
	if(count($res5)>0)
	{
		foreach($res5 as $r5){}
		if($r5 == "v")
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
	
	$res11 = $_POST['res11'];
	if(count($res11)>0)
	{
		foreach($res11 as $r11){}
		if($r11 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[11]=$r11;
	
	$res12 = $_POST['res12'];
	if(count($res12)>0)
	{
		foreach($res12 as $r12){}
		if($r12 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[12]=$r12;
	
	$res113= $_POST['res13'];
	if(count($res13)>0)
	{
		foreach($res13 as $r13){}
		if($r13 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[13]=$r13;
	
	$res14 = $_POST['res14'];
	if(count($res14)>0)
	{
		foreach($res14 as $r14){}
		if($r14 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[14]=$r14;
	
	$res15 = $_POST['res15'];
	if(count($res15)>0)
	{
		foreach($res15 as $r15){}
		if($r15 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[15]=$r15;
	
	$res16 = $_POST['res16'];
	if(count($res16)>0)
	{
		foreach($res16 as $r16){}
		if($r16 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[16]=$r16;
	
	$res17 = $_POST['res17'];
	if(count($res17)>0)
	{
		foreach($res17 as $r17){}
		if($r17 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[17]=$r17;
	
	
	$res18 = $_POST['res18'];
	if(count($res18)>0)
	{
		foreach($res18 as $r18){}
		if($r18 == "v")
			$correctas = $correctas+1;
	}
	else{$BanFalta=1;}
	$respuestas[18]=$r18;
	
	
	$resultado = (($correctas / 10) * 100);
	
	
	if(isset($_SESSION['alumno']))
	{
		$alumno = $_SESSION['alumno'];
		$row = consultarAlumno($alumno);
		
		$id_alumno = $row['id'];
		$curso = 32;
		
		
	}
	if($BanFalta==0)
	{
		$resultado = resultadoPrueba($id_alumno, $curso, $resultado);
		respuestasPrueba($id_alumno,$curso,$respuestas);
		header ("location: Curso32.php");
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
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>C.E.P.S.A.S. | Curso 32</title>
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
				<table border='1' style="width:800px" >
					<thead>
						<th colspan="4" style="text-align:center"><b>Curso 32 : OFFICE - POWER POINT - Prueba de conocimientos</b></th>
					</thead>
					
					<tbody>
						<tr>
							<td colspan="4"><b>Marque &#34;V&#34; si es verdadero &#34;F&#34; si es falsa la afirmaci&oacute;n.</b></td>
						</tr>
						
						<tr>
							<td><b>No.</b></td>
							<td colspan="3" style="text-align:center"><b>Pregunta</b></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>1.</b></td>
							<td colspan="3">Abrir un archivo de Power Point ya existente</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res1[]" <?php if($r1=="f"&&$r1!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res1[]" <?php if($r1=="v"&&$r1!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>2.</b></td>
							<td colspan="3">Abrir un archivo de Power Point ya existente</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res2[]" <?php if($r2=="f"&&$r2!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res2[]" <?php if($r2=="v"&&$r2!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>3.</b></td>
							<td colspan="3">Crear una diapositiva con una plantilla prediseñada</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res3[]" <?php if($r3=="f"&&$r3!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res3[]" <?php if($r3=="v"&&$r3!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>4.</b></td>
							<td colspan="3">Cambiar en diseño de una presentación</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res4[]" <?php if($r4=="f"&&$r4!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res4[]" <?php if($r4=="v"&&$r4!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						
						
						
						<tr>
							<td rowspan="3"><b>5.</b></td>
							<td colspan="3">Editar un cuadro, sombrear, cambiar tipos de líneas, 3D</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res5[]" <?php if($r5=="f"&&$r5!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res5[]" <?php if($r5=="v"&&$r5!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						
						
						<tr>
							<td rowspan="3"><b>6.</b></td>
							<td colspan="3">Modificar los efectos de formas</td>
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
							<td colspan="3">Hacer un hipervínculo</td>
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
							<td colspan="3">Insertar videos</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res8[]" <?php if($r8=="f"&&$r8!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res8[]" <?php if($r8=="v"&&$r8!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>9.</b></td>
							<td colspan="3">Insertar videos</td>
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
							<td colspan="3">Crear animaciones</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res10[]" <?php if($r10=="f"&&$r10!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res10[]" <?php if($r10=="v"&&$r10!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>11.</b></td>
							<td colspan="3">Insertar tablas y editarlas</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res11[]" <?php if($r11=="f"&&$r11!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res11[]" <?php if($r11=="v"&&$r11!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>12.</b></td>
							<td colspan="3">Imprimir una hoja de cálculo</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res12[]" <?php if($r12=="f"&&$r12!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res12[]" <?php if($r12=="v"&&$r12!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>13.</b></td>
							<td colspan="3">Editar, insertar imágenes desde internet</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res13[]" <?php if($r13=="f"&&$r13!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res13[]" <?php if($r13=="v"&&$r13!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>14.</b></td>
							<td colspan="3">Modificar la Fuente (Negrilla, cursiva, tipo, color y tamaño de letra</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res14[]" <?php if($r14=="f"&&$r14!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res14[]" <?php if($r14=="v"&&$r14!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>15.</b></td>
							<td colspan="3">Insertar gráficos, imágenes prediseñadas, imágenes de la web</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res15[]" <?php if($r15=="f"&&$r15!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res15[]" <?php if($r15=="v"&&$r15!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>16.</b></td>
							<td colspan="3">Mostrar una presentación completa</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res16[]" <?php if($r16=="f"&&$r16!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res16[]" <?php if($r16=="v"&&$r16!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>17.</b></td>
							<td colspan="3">Copiar y pegar una presentación y modificarla</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res17[]" <?php if($r17=="f"&&$r17!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res17[]" <?php if($r17=="v"&&$r17!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr>
							<td rowspan="3"><b>18.</b></td>
							<td colspan="3">Imprimir una presentación</td>
						</tr>
						<tr>
							<td colspan="2">F</td>
							<td><input type="radio" name="res18[]" <?php if($r18=="f"&&$r18!="0"){ echo "checked"; }?> value="f"></td>
						</tr>
						<tr>
							<td colspan="2">V</td>
							<td><input type="radio" name="res18[]" <?php if($r18=="v"&&$r18!="0"){ echo "checked"; }?> value="v"></td>
						</tr>
						
						<tr align="center">
							<td colspan="4">
								<input type="submit" value="Enviar" name="Enviar" class="btn btn-success">
								<a href="Curso32.php" class="btn btn-default">Regresar</a>
							</td>
						</tr>
						
						
					</tbody>
				</table>
			</form>
		</div>
	</body>		
</html>	