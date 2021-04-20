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
    <!-- Morris charts -->
    <link rel="stylesheet" href="../web/plugins/morris/morris.css">
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
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">PRINCIPALES ACCIONISTAS - CANTIDAD DE ACCIONES</h3>
                 
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

           

    <!-- jQuery 2.1.4 -->
    <script src="../web/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../web/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../web/plugins/morris/morris.min.js"></script>
    <!-- FastClick -->
    <script src="../web/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../web/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../web/dist/js/demo.js"></script>
	<script src="mbcaccionistas.js"></script>
    <!-- page script -->
    <script>
	$(function () {
	accionistasppales();
	});
	
    /*  $(function () {
        "use strict";
		
		
		
        // AREA CHART
       

        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#F39C12", "#D81B60"],
          data: [
            {label: "Alcaldía Puerto Asís", value: 2500},
            {label: "Alcaldía Puerto Caicedo", value: 2500},
            {label: "Pepe Mujica", value: 1500},
			{label: "Marlon Monsalve", value: 3000},
            {label: "otros accionistas", value: 500},
          ],
          hideHover: 'auto'
        });
        //BAR CHART

      });*/
    </script>
  </body>
</html>
