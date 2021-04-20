<?php 
header('Content-Type: text/html;charset=ISO-8859-1');
include('tools/controlador.php');

if(isset($_POST['consultar']))
{
	$ced=$_POST['cedula'];
	$estudiante = estudiante('',$ced);
	while($datos2= mysql_fetch_array($estudiante))
	{
		$id=$datos2['id'];
		$nombre = $datos2['nombre1'].' '.$datos2['nombre2'].' '.$datos2['apellido1'].' '.$datos2['apellido2'];
	}
	$cursos = cursos();	
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Lockscreen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="web/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="web/font/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="web/icons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="web/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="../../index2.html"><b>C.E.P.</b>S.A.S.</a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name">
	    <?php
			if(isset($estudiante) AND $estudiante != false)
			{
		?>
				<?=$nombre?> - Estudiante
		<?php
			}
		?>
	  </div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="web/dist/img/user.png" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="post" action="" name="form1">
          <div class="input-group">
            <input type="text" class="form-control" id="cedula" placeholder="Cédula" name="cedula" value="">
            <div class="input-group-btn">
               <button type="submit" class="btn btn-info pull-right" name="consultar">Consultar</button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Para consultar los cursos realizados ingrese el número de Cédula
      </div>
      <div class="text-center">
        <a href="index.html" class="btn btn-default">Regresar</a>
      </div>
      <div class="lockscreen-footer text-center">
		<strong>Copyright &copy; MBC-Partners S.A.S  -  2016 <br/><a href="http://www.mbc-partners.com.co" class="text-black">www.mbc-partners.com.co</a></strong>    All rights reserved.
      </div>
    </div><!-- /.center -->

    <!-- jQuery 2.1.4 -->
    <script src="web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="web/bootstrap/js/bootstrap.min.js"></script>
	<script src="web/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="web/plugins/datatables/dataTables.bootstrap.min.js"></script>
  </body>
</html>
