<?php 
	$usuario=$_COOKIE["user"];
	$resultado="";

	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	$valida="";
	$result = $mysqli->query("SET NAMES 'utf8'");
	$sql="select CXP from usuarios where Nombre='".$usuario."'";
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			if($row[0]=='X'){
		     	 $valida='CXP';
		    }
		}
		$result->close();
	}

	if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA" || $usuario=="ANDRES EMANUELLI" || $usuario=="FERNANDA CARRERA" || $usuario=="MIGUEL POBLACION"){
			$valida='CXP';
	}
	/*
		$sql="SELECT id_evento, Numero_evento, Nombre_evento FROM eventos where Estatus='ABIERTO' and (Disenio like '%".$usuario."%' or Produccion like '%".$usuario."%' or solicita like '%".$usuario."%') order by id_evento asc";*/
	
	if($valida=='CXP'){
	
		$sql="SELECT id_evento, Numero_evento, Nombre_evento, Cliente FROM eventos where Estatus='ABIERTO' order by Cliente, Numero_evento";
		
	}
	else{
		$sql="SELECT id_evento, Numero_evento, Nombre_evento, Cliente FROM eventos where (Produccion like '%".$usuario."%' or Disenio like '%".$usuario."%' or Ejecutivo like '%".$usuario."%' or Digital like '%".$usuario."%' or Solicita like '%".$usuario."%') and Estatus='ABIERTO' order by Cliente, Numero_evento";
	}
	
	//$resultado="<option selected value='vacio'>Selecciona un evento...</option>";
	$resultado="";

	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			$name_cliente=$row[3];
			/*
			$clien=explode("&",$row[3]);
			$name_cliente=$clien[1];
			if(count($clien)==3){
					$name_cliente=$clien[1]."&".$clien[2];
				
			}
			if(count($clien)==4){
					$name_cliente=$clien[1]."&".$clien[2]."&".$clien[3];;
				
			}
			*/
			$resultado=$resultado."<option value='".$row[0]."'>[".$row[1]."] ".$name_cliente." - ".$row[2]."</option>";
		}
		$result->close();
	}
	else{
		echo " Error: ".mysqli_error($mysqli);
	}
	echo $resultado;
	
	$mysqli->close();
	

?>