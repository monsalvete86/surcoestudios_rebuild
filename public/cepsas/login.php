<?php 
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
if(isset($_POST['ingresar']))
{	
	$usu = $_POST['usuario'];
	$psw = $_POST['password'];
	$ingreso = validar_accesos($usu,$psw);
	$token = MD5($psw);
	$newURL = '/admin.php?usu='.$usu.'&token='.$token.'';
	if($ingreso == true)
		header('Location: '.$newURL);
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
        <p class="login-box-msg">Administrador de Alumnos</p>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Usuario" name="usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">             
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="ingresar">Ingresar</button>
            </div><!-- /.col -->
			<?php
				if(isset($ingreso) AND $ingreso == false)
				{
			?>		
			<div class="col-xs-12">
				<div class="alert alert-danger alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    !USUARIO O CONTRASEÑA INCORRECTOS!
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
