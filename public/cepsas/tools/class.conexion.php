<?php

class Conexion extends mysqli{
	private $DB_HOST = 'bbdd.surcoestudios.com';
	private $DB_USER = 'ddb151264';
	private $DB_PASS = 'C4m1l0.M2017!';
	private $DB_NAME = 'ddb151264';
	
	public function __construct() {
		parent:: __construct($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
		
		$this->set_charset('utf-8');
		
		$this->connect_errno ? die('Error en la conexion'.mysqli_connect_errno()) : $m = 'conectado';
				
	}
}
?>