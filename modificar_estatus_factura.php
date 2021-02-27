<?php 
$estatus=$_POST['estatus'];
$id=$_POST['id'];
$fecha_pago=$_POST['fecha_pago'];
$divisa=$_POST['divisa'];
include("conexion.php");
if (mysqli_connect_error()) {
	echo "Error de conexion: %s\n", mysqli_connect_error();
	exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");	
$sql="update solicitud_factura set Estatus_Factura='".$estatus."', Fecha_pago='".$fecha_pago."' where id_solicitud=".$id;
if($fecha_pago==""){
	$sql="update solicitud_factura set Estatus_Factura='".$estatus."', Fecha_pago=null where id_solicitud=".$id;
}	
	if ($mysqli->query($sql)) {
		$respuesta= "modificada";
	}
	else{
		$respuesta= mysqli_error($mysqli);
	}

if($divisa!="0"){
	$sql="select id_partida, pu from partidas where id_sol_factura=".$id;
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			$id_partida=$row[0];
			$pu=$row[1];
			$total=$divisa*$pu;
			$sql2="update partidas set Valor_divisa='".$divisa."', Total='".$total."' where id_partida=".$id_partida;
			if ($mysqli->query($sql2)) {
				$respuesta= "modificada";
			}
			else{
				$respuesta= mysqli_error($mysqli);
			}
		}
	}
}
else{
	$sql="select id_partida, pu from partidas where id_sol_factura=".$id;
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			$id_partida=$row[0];
			$pu=$row[1];
			$sql2="update partidas set Valor_divisa='0', Total='".$pu."' where id_partida=".$id_partida;
			if ($mysqli->query($sql2)) {
				$respuesta= "modificada";
			}
			else{
				$respuesta= mysqli_error($mysqli);
			}
		}
	}
}

echo $respuesta;
$mysqli->close();
?>