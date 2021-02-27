<?php 
    
	$anio=$_POST["anio"];
	$resultado="";

	if($anio=="0"){
		$anio=" ";
	}
	else{
		$anio="and Numero_evento like '%2020%'";
	}
	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	
	$result = $mysqli->query("SET NAMES 'utf8'");
	$sql="SELECT id_evento, Numero_evento, nombre_evento, Cliente FROM eventos WHERE Estatus='ABIERTO' ".$anio." order by cliente, Numero_evento";
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {	
			$name_cliente=$row[3];
			$res=$res."<option value='".$row[1]."'>[".$row[1]."] ".$name_cliente." - ".$row[2]."</option>";
            
		}
		$result->close();
	}
	else{
		$res =mysqli_error($mysqli);
        
	}
	echo $res;
	
	$mysqli->close();
	

?>