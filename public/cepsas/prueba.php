<?php
@ini_set('display_errors', 'on');
include($_SERVER['DOCUMENT_ROOT'].'/defines.php');
include(B_TOOLS .'/fpdf.php');
include(B_TOOLS .'/controlador.php');
header('Content-Type: text/html; charset=UTF-8'); 
if(isset($_GET['id_alumno'])) $Id_alumno=$_GET['id_alumno'];
if(isset($_GET['id_curso'])) $Id_prueba=$_GET['id_curso'];
$datoscursoAux = curso($Id_prueba);
$curso = consultarResultadoPrueba($Id_alumno, $Id_prueba);	

//print_r($respuestas_p);
class PDF extends FPDF
{
	function Header()
	{
	    global $Id_alumno; global $curso; global $datoscursoAux;
	    
	    $estudiante = estudiante($Id_alumno); 
	    $datos= $estudiante->fetch_array();
	    $nom_alumno = $datos['nombre1'].' '.$datos['nombre2'].' '.$datos['apellido1'].' '.$datos['apellido2'];
	    //$datoscurso= mysql_fetch_array($datoscursoAux);
		$datoscurso = $datoscursoAux->fetch_array();
		
		
	   // print_r($datoscurso);
		$Raiz = $_SERVER['DOCUMENT_ROOT'];
		$this->Image("$Raiz/logo_pdf.png",10,7,30,30);
		$this->SetFont('Arial','B',12);			
		$this->Ln(4);		
		$this->Cell(190,5,"C.E.P  S.A.S",0,0,'C');
		$this->Ln(4);
		$this->Cell(190,5,"EL CENTRO DE EDUCACION PETROLERA",0,0,'C');
		$this->SetFont('Arial','I',10);			
		$this->Ln(4);
		$this->Cell(190,5,"Nit. 900.513.118-7 Registro Mercantil 45541-16",0,0,'C');
		$this->Ln(4);
		$txt="Permiso Sercretar".html_entity_decode("&iacute;")."a de Educaci".html_entity_decode("&oacute;")."n";
		$this->Cell(190,5,utf8_decode($txt),0,0,'C');
		$this->Ln(12);
		$this->SetFont('Arial','B',10);
		$this->Cell(25,5,"Alumno:",0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(25,5,utf8_decode("$nom_alumno"),0,0,'L');
		$this->Ln(4);
		$this->SetFont('Arial','B',10);
		$txt="Identificaci".html_entity_decode("&oacute;")."n:";
		$this->Cell(25,5,utf8_decode($txt),0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(22,5,$datos['cedula'],0,0,'L');
		$this->SetFont('Arial','B',10);
		$this->Cell(15,5,"Curso:",0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(20,5,$datoscurso['curso'],0,0,'L');
		$this->Ln(4);
		$this->SetFont('Arial','B',10);
		//SetTextColor('255','0','0');
		//$this->SetFillColor('255','0','0');
		$this->Cell(25,5,utf8_decode("Resultado:"),0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(22,5,$curso['resultado']."%",0,0,'L');
		$this->SetFont('Arial','B',10);
		$this->Cell(15,5,"Estado:",0,0,'L');
		$this->SetFont('Arial','',10);
		$MsjResult="APROBADO";
		if($curso['resultado']<60){		$MsjResult="NO APROBADO";		}
		$this->Cell(15,5,"$MsjResult",0,0,'L');
		$this->Ln(12);
	}
	function Datos($Id_alumno,$Id_prueba)
	{
	    //echo "$Id_prueba=$Id_prueba  --- Id_alumno=$Id_alumno";
	    $respuestas_p=get_respuestas_prueba($Id_prueba,$Id_alumno);
	    $Raiz = $_SERVER['DOCUMENT_ROOT'];
		$this->SetFont('Arial','B',10);
		$this->Cell(8,5,"No.",1,0,'L');
		$this->Cell(183,5,"                                                                                    Pregunta",1,0,'L');
		
		$opc_preguntas= get_opc_preguntas($Id_prueba);	
		//print_r($respuestas_p);
		$Preguntas= array();
		$Preguntas = get_preguntas($Id_prueba);	
		$bansaltogrande=0;
		if($Id_prueba==4)
		{
		    	$this->Ln(5);
		    $this->Cell(191,5,"Seleccione la letra correspondiente a la clase de fuego.",1,0,'L');
		    
		}
		while($fila=$Preguntas->fetch_array())
		
		{
			$banLn=0;
			$rta=$respuestas_p[$fila['id_pregunta']];
			if($bansaltogrande==0){ $this->Ln(5); $bansaltogrande=1;}
			//$this->Cell(8,5,$fila['id_pregunta'],1,0,'L');	
			//$this->Cell(183,5,$fila['id_pregunta'].". ".utf8_decode($fila['pregunta']),1,0,'L');
			 $this->SetFont('Arial','B',10);
	        if($Id_prueba=="4"&&($fila['id_pregunta']==1||$fila['id_pregunta']==2||$fila['id_pregunta']==3||$fila['id_pregunta']==4||$fila['id_pregunta']==5))
	        {
			   if(
			        ($fila['id_pregunta']==1&&$rta=="a")||
			        ($fila['id_pregunta']==2&&$rta=="b")||
			        ($fila['id_pregunta']==3&&$rta=="c")||
			        ($fila['id_pregunta']==4&&$rta=="d")||
			        ($fila['id_pregunta']==5&&$rta=="k")
			    )
			    {
			       $this->SetFillColor('55','255','55');
			   } 
			   else { $this->SetFillColor('255','55','55');} 
			    $this->MultiCell(191,5,$fila['id_pregunta'].".       
			    
                                            			                                                                                        ".strtoupper($rta)." 
			     
			     ",'LRB','L',1); 
			    if($fila['id_pregunta']==1)
			    {
			        $this->Image("$Raiz/images/Curso4/1.png",83,75,20,20);
			    }
		        if($fila['id_pregunta']==2)
		        {
		            if($rta=="b"){$this->SetFillColor('55','255','55');} else { $this->SetFillColor('255','55','55');} 
			        $this->Image("$Raiz/images/Curso4/2.png",83,100,20,20);
		        }
			    if($fila['id_pregunta']==3)
			    {
			        if($rta=="c"){$this->SetFillColor('55','255','55');} else { $this->SetFillColor('255','55','55');} 
			        $this->Image("$Raiz/images/Curso4/3.png",83,125,20,20);
			    }
			    if($fila['id_pregunta']==4)
			    {
			        if($rta=="d"){$this->SetFillColor('55','255','55');} else { $this->SetFillColor('255','55','55');} 
			        $this->Image("$Raiz/images/Curso4/4.png",83,150,20,20);
			    }
			    if($fila['id_pregunta']==5)
			    {
			        if($rta=="k"){$this->SetFillColor('55','255','55');} else { $this->SetFillColor('255','55','55');} 
			        $this->Image("$Raiz/images/Curso4/5.png",83,175,20,20);
			    }
			    
	        }
	        elseif($Id_prueba=="4"&&($fila['id_pregunta']==8||$fila['id_pregunta']==9||$fila['id_pregunta']==10))
	        {
	            $this->MultiCell(191,5,$fila['id_pregunta'].". ".utf8_decode($fila['pregunta']),'LRB','L');
	            if(($fila['id_pregunta']==8&&$rta=="3")||($fila['id_pregunta']==9&&$rta=="1")||($fila['id_pregunta']==10&&$rta=="2"))
			    {
			       $this->SetFillColor('55','255','55');
			    } 
			    else { $this->SetFillColor('255','55','55');} 
			   $this->MultiCell(191,5,"$rta",'LRB','L',1);
	        }
	        else{
	            
	            $this->MultiCell(191,5,$fila['id_pregunta'].". ".utf8_decode($fila['pregunta']),'LRB','L');
    			if(isset($opc_preguntas[$fila['id_pregunta']]))
        		{
        		    $cant_ln=count($opc_preguntas[$fila['id_pregunta']]);
        		    $this->SetFont('Arial','',10);
        		    $j=1;
        		    $banSalto=0;
        			foreach($opc_preguntas[$fila['id_pregunta']] as $opc_pre)
    			    {
    			        if($opc_pre['opcion']==1){$aux_opc="f";}elseif($opc_pre['opcion']==2){$aux_opc="v";}else{$aux_opc=$opc_pre['opcion'];}
    			        $fill="";
    			        if($aux_opc==$rta)
    			        {
        			        if($opc_pre['correcta']==1){
        			            $auxres="verde";
                                $this->SetFillColor('55','255','55');    			           
        			        }
        			        else{
        			            $auxres="rojo";
        			            $this->SetFillColor('255','55','55');    			           
        			        }
        			        $fill='1';
    			        }
    			        else $auxres="";
    			        if($cant_ln==$j){
    			            if($fill==1)
        				        $this->MultiCell(191,5,$opc_pre['opcion'].". ".utf8_decode($opc_pre['pregunta']),'LRB','L',1);
        				    else
        				        $this->MultiCell(191,5,$opc_pre['opcion'].". ".utf8_decode($opc_pre['pregunta']),'LRB','L');
    			        }
    			        else{
    			            if($fill==1)
    			                $this->MultiCell(191,5,$opc_pre['opcion'].". ".utf8_decode($opc_pre['pregunta']),'LR','L',1);
    			            else
    			                $this->MultiCell(191,5,$opc_pre['opcion'].". ".utf8_decode($opc_pre['pregunta']),'LR','L');
    			        }
        				$j++;
        			}
        		}
	        }
		}
		
	}
}
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Ln(4);
	$pdf->Datos($Id_alumno,$Id_prueba);
	$pdf->SetFont('Arial','',8);	
	$pdf->Output();
?>