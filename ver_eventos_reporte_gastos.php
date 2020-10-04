<?php 
	$periodo=$_GET["periodo"];

	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	$mysqli2=$mysqli;
	$result = $mysqli->query("SET NAMES 'utf8'");	
	ini_set('max_execution_time', 0);
	$comodin="";
	$sql="";
	if($periodo=="0" || strpos($periodo, ",") !== false){
		$and="";
	}
	else{
		$and=" and e.Numero_evento like '".$periodo."-%'";
	}
	$usuario=$_COOKIE["user"];

	if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA" || $usuario=="FERNANDA CARRERA" || $usuario=="ANDRES EMANUELLI"){
		$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente, c.id_cliente, c.Razon_Social FROM eventos e, clientes c where e.Cliente=CONCAT(c.id_cliente,'&',c.Razon_Social) and e.Estatus!='CANCELADO' ".$and." order by c.Razon_Social, e.Numero_evento";
	}
	else{
		$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente, c.id_cliente, c.Razon_Social FROM eventos e, clientes c where e.Cliente=CONCAT(c.id_cliente,'&',c.Razon_Social) and e.Estatus!='CANCELADO' ".$and." and e.Ejecutivo like '%".$usuario."%' order by c.Razon_Social, e.Numero_evento";	
	}
	
	$resultado=$sql;


	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			$clien=explode("&",$row[3]);
			$id_cliente=$clien[0];
			if($comodin!=$id_cliente){
				$sql2="select Razon_Social from clientes where id_cliente=".$id_cliente;
				$result2 = $mysqli2->query("SET NAMES 'utf8'");	
				if ($result2 = $mysqli2->query($sql2)) {
					while ($row2 = $result2->fetch_row()) {
						$name_cliente=$row2[0];
						$resultado=$resultado.'<optgroup label="'.$row2[0].'">';
						//$resultado=$resultado.'<optgroup label="'.htmlspecialchars( $row2[0] ).'">';
					}
					$result2->close();
				}
				$comodin=$id_cliente;
				//$resultado=$resultado."<optgroup label=".$name_cliente.$sql2.">";
			}
			
			$resultado=$resultado."<option value='".$row[1]."'>[".$row[1]."] ".$name_cliente." - ".$row[2]."</option>";
		}
		$result->close();
	}
	else{
		$resultado="Error: ".mysqli_error($mysqli);
	}
	echo $resultado."<span>".$sql."</span>";
	
	$mysqli->close();
	

?>