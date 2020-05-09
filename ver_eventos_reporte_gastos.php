<?php 
	
	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	
	$result = $mysqli->query("SET NAMES 'utf8'");	
	$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente, c.id_cliente, c.Razon_Social FROM eventos e, clientes c where e.Cliente=CONCAT(c.id_cliente,'&',c.Razon_Social)  and e.Estatus!='CANCELADO' order by c.Razon_Social, e.Numero_evento";	
	
	$resultado="";

	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			$clien=explode("&",$row[3]);
			$name_cliente=$clien[1];
			if(count($clien)==3){
					$name_cliente=$clien[1]."&".$clien[2];
				
			}
			if(count($clien)==4){
					$name_cliente=$clien[1]."&".$clien[2]."&".$clien[3];;
				
			}
			$resultado=$resultado."<option value='".$row[1]."'>[".$row[1]."] ".$name_cliente." - ".$row[2]."</option>";
		}
		$result->close();
	}
	else{
		$resultado="Error: ".mysqli_error($mysqli);
	}
	echo $resultado;
	
	$mysqli->close();
	

?>