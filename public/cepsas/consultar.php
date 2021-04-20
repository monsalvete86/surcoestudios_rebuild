<?php 
header('Content-Type: text/html;charset=ISO-8859-1');
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');

if(isset($_POST['consultar']))
{
    
	$ced=$_POST['cedula'];
	//echo "llega $ced"; exit;
	$estudiante = estudiante('',$ced);
	if($estudiante){
    	while($datos2 = $estudiante->fetch_array())
    	{
    	
    		$id=$datos2['id'];
    		$nombre = $datos2['nombre1'].' '.$datos2['nombre2'].' '.$datos2['apellido1'].' '.$datos2['apellido2'];
    	}
    
    	$cursos = cursos();	
    	$row = consultarAlumno($ced);
    	$id_alumno = $row['id'];
    	$curso1 = consultarResultadoPrueba($id_alumno, '1');	$AuxDatos[1]=$curso1;
    	$curso2 = consultarResultadoPrueba($id_alumno, '2');	$AuxDatos[2]=$curso2;
    	$curso3 = consultarResultadoPrueba($id_alumno, '3');	$AuxDatos[3]=$curso3;
    	$curso4 = consultarResultadoPrueba($id_alumno, '4');	$AuxDatos[4]=$curso4;
    	$curso5 = consultarResultadoPrueba($id_alumno, '5');	$AuxDatos[5]=$curso5;
    	$curso6 = consultarResultadoPrueba($id_alumno, '6');	$AuxDatos[6]=$curso6;
    	$curso7 = consultarResultadoPrueba($id_alumno, '7');	$AuxDatos[7]=$curso7;
    	$curso8 = consultarResultadoPrueba($id_alumno, '8');	$AuxDatos[8]=$curso8;
    	$curso9 = consultarResultadoPrueba($id_alumno, '9');	$AuxDatos[9]=$curso9;
    	$curso10 = consultarResultadoPrueba($id_alumno, '10');	$AuxDatos[10]=$curso10;
    	$curso11 = consultarResultadoPrueba($id_alumno, '11');	$AuxDatos[11]=$curso11;
    	$curso12 = consultarResultadoPrueba($id_alumno, '12');	$AuxDatos[12]=$curso12;
    	$curso13 = consultarResultadoPrueba($id_alumno, '13');	$AuxDatos[13]=$curso13;
    	$curso14 = consultarResultadoPrueba($id_alumno, '14');	$AuxDatos[14]=$curso14;
    	$curso15 = consultarResultadoPrueba($id_alumno, '15');	$AuxDatos[15]=$curso15;
    	$curso16 = consultarResultadoPrueba($id_alumno, '16');	$AuxDatos[16]=$curso16;
    	$curso17 = consultarResultadoPrueba($id_alumno, '17');	$AuxDatos[17]=$curso17;
    	$curso18 = consultarResultadoPrueba($id_alumno, '18');	$AuxDatos[18]=$curso18;
    	$curso19 = consultarResultadoPrueba($id_alumno, '19');	$AuxDatos[19]=$curso19;
	}
}
?>
<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>C.E.D.S.A.S. | Consultar</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

	</head>
	<body class="skin-blue sidebar-mini">	
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
							<img alt="User Image" class="user-image" src="tools/web/dist/img/user.png">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<?php
								if(isset($estudiante) AND $estudiante != false)
								{
							?>
									<span class="hidden-xs"><?=utf8_decode($nombre)?> - Estudiante</span>
							<?php
								}
							?>
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
				  CONSULTAR 
				  <small>Estudiante</small>
				</h1>
				<ol class="breadcrumb">
				  <li><a href="/index.html"><i class="fa fa-dashboard"></i>Home</a></li>
				   <li class="active">Consultar</li>
				</ol>
			  </section>

          <!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-6">
						<div class="box box-info">
							<div class="box-header with-border">
							  <h3 class="box-title">Ingrese su documento de identidad</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form class="form-horizontal" method="post" action="" name="form1">
								<div class="box-body">								
									<?php 
										if(isset($estudiante) AND $estudiante == false)
										{ 
									?>	
											<div class="alert alert-danger alert-dismissible">
												<h4><i class="icon fa fa-ban"></i> Alert!</h4>
												El documento no se encuentra registrado.
											</div>
									<?php
										}											
									?>
											
										<div class="form-group">
										  <label for="cedula" class="col-sm-2 control-label">Documento</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control" id="cedula" placeholder="C�dula" name="cedula" value="<?php if(isset($_POST['cedula'])) echo $_POST['cedula']; ?>">
										  </div>
										</div>															  
								</div><!-- /.box-body -->
								<div class="box-footer">
									<a href="index.html" class="btn btn-default">Regresar</a>
									<button type="submit" class="btn btn-info pull-right" name="consultar">Consultar</button>
								</div><!-- /.box-footer -->
							</form>
						</div><!-- /.box -->
					</div>	
					<?php
						if(isset($estudiante) AND $estudiante != false) 
						{			
					?>	
						<div class="col-xs-6">		
								
													<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Cursos</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="box-group" id="accordion">
									<?php 
										while($datos2 = $cursos->fetch_array())
										{
											if(utf8_decode($datos2['curso']) != "NIVEL AVANZADO - TRABAJO SEGURO EN ALTURAS" )
											{	
										$alumnocurso = alumnocurso($datos2['id'],$id);
									?>			
											<div class="panel box box-primary">
												<div class="box-header with-border">
													<h4 class="box-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$datos2['id']?>">
															<?=$datos2['id']?> - <?=utf8_decode($datos2['curso'])?>
													<?php	$i=$datos2['id'];
															if(isset($AuxDatos[$i]['curso'] )&&$AuxDatos[$i]['curso']>0){ 
																$MsjResult="aprob&oacute;";
																if($AuxDatos[$i]['resultado']<60){		$MsjResult="No aprob&oacute";		}
																echo "<span>(Ultimo resultado: ".$AuxDatos[$i]['resultado']." % <b>$MsjResult!!!<b>)</span>";
															}?>		
														</a>
														<?php
                        							        if(isset($AuxDatos[$i]['curso'] )&&$AuxDatos[$i]['curso']>0&&hayRespuestas($id_alumno,$i)){  ?>
                        							            <br><a class="diploma" target="_blank" 
                        							            href="prueba.php?id_alumno=<?= $id_alumno?>&id_curso=<?= $i?>">Ver Resultados</a>    
                        					        <?php   }
                        					                else{
                        					                    $aux=hayRespuestas($id_alumno,$i);    
                        					                }
                        							?>	
														
														<?php
															if($alumnocurso['estado'] == 'Realizado' || 1 == 1)
															{
															?>		
																<br>
																<span class="inscrito">REALIZADO</span></br>
																<span>Fecha: <?=$alumnocurso['dia']?>-<?=$alumnocurso['mes']?>-<?=$alumnocurso['año']?></span>	
															<?php
																if ($datos2['id'] == '12' )
																{ 
															?>
																	<a class="diploma" href="javascript:void(0);"  target="_blank"><i class="fa fa-fw fa-file-text-o"></i>Descarga no Autorizada</a>	
															<?php		
																}//NUEVO CODIGO INSERTADO 20180312
																elseif ($datos2['id'] == '12' || $datos2['id'] == '19' || $datos2['id'] == '13')
																{?>
															        <a class="diploma" href="diploma2.php?id=<?=$id?>&curso=<?=$datos2['id']?>"  target="_blank">
																	    <i class="fa fa-fw fa-file-text-o"></i>Diploma 
																	</a>	    
														<?php	}
																else if ($datos2['id'] == '6'  )
																{ 
															?>
																	<a class="diploma" href="diploma3.php?id=<?=$id?>&curso=<?=$datos2['id']?>"  target="_blank">
																	<i class="fa fa-fw fa-file-text-o"></i>Diploma 
																	</a>	
															<?php		
																}
																else
																{			
															?>		
																<a class="diploma" href="diploma.php?id=<?=$id?>&curso=<?=$datos2['id']?>"  target="_blank">
																<i class="fa fa-fw fa-file-text-o"></i>Diploma
																</a>		
															<?php		
																}
														
															}
														?>
														<?php
															if($alumnocurso['estado'] == 'Inscrito')
															{
														?>		
															<span class="inscrito">INSCRITO</span></br><span>Fecha: <?=$alumnocurso['dia']?>-<?=$alumnocurso['mes']?>-<?=$alumnocurso['año']?></span>		
														<?php		
															}
														?>
													</h4>
												</div>
											</div>	
									<?php
											}	
										}
									?>					
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->	
						</div>	
					<?php 
						}
					?>			
				</div>
			</section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
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
    <!-- page script -->
    <script>
				  
    </script>
	
  </body>
</html>
