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
		$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente FROM eventos e where e.Estatus!='CANCELADO' ".$and." order by e.cliente, e.Numero_evento";
	}
	else{
		$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente FROM eventos e where e.Estatus!='CANCELADO' ".$and." and e.Ejecutivo like '%".$usuario."%' order by e.Cliente, e.Numero_evento";	
	}
	
	//$resultado=$sql;

	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			//$clien=explode("&",$row[3]);
			$cliente=$row[3];
			if($comodin!=$cliente){
				/*$sql2="select Razon_Social from clientes where id_cliente=".$id_cliente;
				$result2 = $mysqli2->query("SET NAMES 'utf8'");	
				if ($result2 = $mysqli2->query($sql2)) {
					while ($row2 = $result2->fetch_row()) {
						$name_cliente=$row2[0];
						*/
						$resultado=$resultado.'<optgroup label="'.$cliente.'">';
						//$resultado=$resultado.'<optgroup label="'.htmlspecialchars( $row2[0] ).'">';				
				$comodin=$cliente;
				//$resultado=$resultado."<optgroup label=".$name_cliente.$sql2.">";
			}
			
			$resultado=$resultado."<option value='".$row[1]."'>[".$row[1]."] ".$cliente." - ".$row[2]."</option>";
		}
		$result->close();
	}
	else{
		$resultado="Error: ".mysqli_error($mysqli);
	}
	echo $resultado."<span>".$sql."</span>";
	
	$mysqli->close();
	

?>