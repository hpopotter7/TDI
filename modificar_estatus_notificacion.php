<?php 
$estatus=$_POST['estatus'];
$id_notificacion=$_POST['id_notificacion'];
include("conexion.php");
if (mysqli_connect_error()) {
	echo "Error de conexion: %s\n", mysqli_connect_error();
	exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");	
$sql="update notificaciones set Visto='".$estatus."' where id_notificaciones=".$id_notificacion;
	
	if ($mysqli->query($sql)) {
		$respuesta= "modificado";
	}
	else{
		$respuesta= mysqli_error($mysqli);
	}

echo $respuesta;
$mysqli->close();
?>