<?php 
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
$consulta = listado_general_xls();
if($consulta != false){
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Ventas_generales.xls");
	echo '<table id="example1" border="1">
		<thead>
			<tr>
				<th>No.</th>
				<th>ID</th>
				<th>CEDULA</th>	
				<th>LUGAR EXP</th>
				<th>NOMBRE 1</th>
				<th>NOMBRE 2</th>
				<th>APELLIDO 1</th>
				<th>APELLIDO 2</th>
				<th>TELEFONO</th>
				<th>EMAIL</th>
				<th>FECHA CREA</th>
				<th>EMPRESA</th>
				<th>NIT EMPRESA</th>
				<th>TELEFONO EMPRESA</th>
				<th>CURSO</th>
				<th>DIA</th>
				<th>MES</th>
				<th>'.utf8_decode('AÑO').'</th>
				<th>ESTADO</th>					
			</tr>
		</thead>';
		$cont=1;
	
	while($datos = $consulta->fetch_array())
	{
		echo "<tr>
		<td>".$cont."</td>
		<td>".$datos['id']."</td>
		<td>".$datos['cedula']."</td>
		<td>".utf8_decode($datos['lugar_expedicion'])."</td>		
		<td>".utf8_decode($datos['nombre1'])."</td>
		<td>".utf8_decode($datos['nombre2'])."</td>
		<td>".utf8_decode($datos['apellido1'])."</td>
		<td>".utf8_decode($datos['apellido2'])."</td>
		<td>".utf8_decode($datos['telefono'])."</td>
		<td>".utf8_decode($datos['email'])."</td>
		<td>".utf8_decode($datos['fecha_crea'])."</td>
		<td>".utf8_decode($datos['empresa'])."</td>
		<td>".$datos['nit_empresa']."</td>
		<td>".$datos['telefono_empresa']."</td>
		<td>".utf8_decode($datos['curso'])."</td>
		<td>".$datos['dia']."</td>
		<td>".$datos['mes']."</td>
		<td>".$datos['año']."</td>
		<td>".$datos['estado']."</td>
		";	
		
	}
}	
?>  
