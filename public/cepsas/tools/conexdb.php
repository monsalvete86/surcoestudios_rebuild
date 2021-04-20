<?php
function Conectarse()
{
	//mysql_connect creamos un vínculo entre la base de datos y la pagina PHP
	if (!($link=mysql_connect("localhost","cepsasco_user","w?ZsA?luE@v_")))
	{
		echo "Error conectando a la base de datos.";        
		exit();     
	}
	if (!mysql_select_db("cepsasco_rodolfo",$link))     
	{        
		echo "Error seleccionando la base de datos.";        exit();     
	}
	mysql_query("SET NAMES 'utf8'");	
	return $link;  			
}
?>