<?php
  class Db
  {
    private $host = 'localhost';
    private $username = 'cepsasco_user';
    private $password = 'w?ZsA?luE@v_';
    private $db = 'cepsasco_rodolfo';
    
  
  protected	$_con=null;
  
  protected	$_recordset=null;
  
  public function Db()
  {
	//include('config.php');
  	$this->_con=mysql_connect($this->host,$this->username,$this->password) or die('Connection error');
    if($this->_con)
  	{
  		$db=mysql_select_db($this->db,$this->_con) or die('Error '.mysql_error($this->_con));
  	}
	@mysql_query("SET NAMES 'utf8'",$this->_con);
  }
  
  
  public function execute($query)
  {
  if ($this->_recordset = mysql_query($query)) 
  { 
  	return $this->_recordset;
  }
      else 
      {
       die("Error in executing query... :: ".$query." <br/>".mysql_error($this->_con));
      }
  }
  
  
  public function getConnection()
  {
  	return $this->_con;
  }

  public function lastInsertID()
  {	if($this->_con)
  return mysql_insert_id($this->_con);
  return false;
  }

  public function insert($table,$data)
  {
  $query="INSERT INTO `".$table."`  (%s)  VALUES  (%s)";
  $fields=array();
  $values=array();
  foreach ($data as $key=>$val)
  {
  $fields[]="`".$key."`";
  $values[]="'".mysql_real_escape_string($val,$this->_con)."'";
  }
  $query=sprintf($query, implode( ",", $fields) ,  implode( ",", $values ) );
  return 	$this->execute($query) ;
  }
  
  public function update($table,$data,$where)
  {
  $query="UPDATE  `".$table."`  SET   %s  ";
  $fields=array();
  foreach ($data as $key=>$val)
  {
  $fields[]="`".$key."`="."'".mysql_real_escape_string($val,$this->_con)."'";
  }
  $where="  WHERE  ".$where;
  $query=sprintf( $query, implode( ",", $fields)).$where;
  return 	$this->execute($query) ;
  }

  public function  delete($table,$where)
  {
  $query="DELETE  FROM  `".$table."`   ";
  $where="  WHERE  ".$where;
  $query=$query.$where;
  return 	$this->execute($query) ;
  }
 
 
  /*public function __destruct()
  {
  	if($this->_con)
  	{
		mysql_close($this->_con);
	}
		
	
  }*/
}