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
               <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">VENTA DE ACCIONES AÑO</h3>
                 
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="area-chart" style="height: 300px;"></div>
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
    <!-- page script -->
    <script>
      $(function () {      

		Morris.Area({
		 element: 'area-chart',
		 data: [
		 { m: 'Ene', value: 30 },
		 { m: 'Feb', value: 1000 },
		 { m: 'Mar', value: 500 },
		 { m: 'Abr', value: 170 },
		 { m: 'May', value: 60 },
		 { m: 'Jun', value: 60 },
		 { m: 'Jul', value: 60 },
		 { m: 'Ago', value: 60 },
		 { m: 'Sep', value: 60 },
		 { m: 'Oct', value: 60 },
		 { m: 'Nov', value: 60 },
		 { m: 'Dic', value: 60 }
		 
		// till December 
		 ],
		 xkey: 'm',
		 ykeys: ['value'],
		 labels: ['Orders'],
		 parseTime: false,
		 fillOpacity: 0.6,
		  hideHover: 'auto',
		  behaveLikeLine: true,
		  resize: true,
		  pointFillColors:['#ffffff'],
		  pointStrokeColors: ['red'],
		  lineColors:['#3C8DBC']
		});
	  });
    </script>
  </body>
</html>
