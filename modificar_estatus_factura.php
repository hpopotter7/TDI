<?php 
$estatus=$_POST['estatus'];
$id=$_POST['id'];
$fecha_pago=$_POST['fecha_pago'];
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

echo $respuesta;
$mysqli->close();
?>