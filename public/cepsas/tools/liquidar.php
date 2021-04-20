<?php 
include('controlador.php');
if(isset($_GET['year']))
$year = $_GET['year']; 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Morris.js Charts</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../web/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../web/css/font-awesome.min.css">
	<link rel="stylesheet" href="../web/css/ionicons.min.css">
   <!-- Theme style -->
    <link rel="stylesheet" href="../web/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../web/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <body>
              <!-- DONUT CHART -->
              <div class="resultado">
				<?php if(isset($_GET['year']))
					echo $_GET['year']; ?>	
              </div><!-- /.box -->

           

    <!-- jQuery 2.1.4 -->
    <script src="../web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../web/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
 	<script src="mbcaccionistas.js"></script>
    <!-- page script -->
    <script>
	$(function () {
		liquidar('<?=$year?>');
	});
    
    </script>
  </body>
</html>
