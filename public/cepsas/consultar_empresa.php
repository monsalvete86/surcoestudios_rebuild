<?php
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
$id=$_POST['id'];
$empresa = consultar_empresa($id);

while($datos = $empresa->fetch_array())
{
 echo utf8_encode('<div class="col-sm-2 infoempresa">Nit Empresa</div>
						<div class="col-sm-10">
		  
						'.$datos["nit_empresa"].'
						</div>
						<div class="col-sm-12 infoempresa"></div>
						<div class="col-sm-2 infoempresa" >Teléfono Empresa</div>
						  <div class="col-sm-10">
							'.$datos["telefono_empresa"].'
						  </div>');

	
}
?>