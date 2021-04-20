<?php
//@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/controlador.php');
$id=$_POST['id'];
eliminar_estudiante($id);
?>