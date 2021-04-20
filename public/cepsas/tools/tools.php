<?php
function fecha_actual(){
$fecha_actual = new DateTime(null, new DateTimeZone('America/Bogota'));  // se captura la fecha y hora real de la zona
$fecha=$fecha_actual->format('Y-m-d H:i:s');
return $fecha;
}
function solo_letras($cadena)
{
	$permitidos = "áéíóúÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";
	for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
			return false;
	}	
	return true;
} 
function solo_numeros($cadena)
{
	$permitidos = "0123456789";
	for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
			return false;
	}	
	return true;
} 
function solo_alfanumerico($cadena)
{
	$permitidos = "áéíóúÁÉÍÓÚ0123456789abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";
	for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
			return false;
	}	
	return true;
} 
function caracteres($cadena)
{ 
  $permitidos = "#/,.-()áéíóúÁÉÍÓÚ0123456789abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ";
	for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
			return false;
	}	
	return true;
}
function verificaremail($direccion)
{
   $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
   if(preg_match($Sintaxis,$direccion))
      return true;
   else
     return false;
}
function decimal($cadena)
{ 
  $permitidos = ",.0123456789";
	for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
			return false;
	}	
	return true;
}

?>