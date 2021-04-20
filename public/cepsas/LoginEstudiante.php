<?php 
//@ini_set('display_errors', 'on');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
if(isset($_POST['ingresar']))
{	
	$usu = $_POST['usuario'];
	$psw = $_POST['password'];
	$error_log=0;
	if(!isset($_SESSION['alumno']))
	{
		$validar_alumno = validar_accesos_estudiante($usu,$psw);
		$token = MD5($psw);
		if($validar_alumno == true)
		{
			$_SESSION['alumno'] = $usu;
			$newURL = '/cursos.php?usu='.$usu.'&token='.$token;
			header('Location: '.$newURL);
		}
		else
		{
			$error_log=1;
		}
	}
	else
	{
		session_destroy();
		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>C.E.P.S.A.S. | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="tools/web/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="tools/web/css/font-awesome.min.css">
	<link rel="stylesheet" href="tools/web/css/ionicons.min.css">
   <!-- Theme style -->
     <link rel="stylesheet" href="tools/web/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="tools/web/dist/css/AdminLTE.min.css"> 
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
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>C.E.P.</b>S.A.S.</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Login  Alumnos</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Usuario" name="usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
			
			
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="ingresar">Ingresar</button>
			  
            
				<a href="cursos.php" class="btn btn-default" style="    width: 100%;">Regresar</a>
			
			<?php
				if(isset($error_log)&& $error_log==1)
				{
			?>		
					<div class="col-xs-12">
						<div class="alert alert-danger alert-dismissible">
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							
							<h4><i class="icon fa fa-ban"></i> Alerta!</h4>
							!USUARIO O CONTRASE&Ntilde;A INCORRECTOS!
						</div>	
					</div><!-- /.col -->
			<?php
				}
			?>
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="tools/web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="tools/web/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
 	<script src="tools/mbcaccionistas.js"></script>
    <!-- page script -->
    <script>
	
    </script>
  </body>
</html>
