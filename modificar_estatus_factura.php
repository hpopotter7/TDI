<?php 
$estatus=$_POST['estatus'];
$id=$_POST['id'];
include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	
            
		
				$sql="update solicitud_factura set Estatus_Factura='".$estatus."' where id_solicitud=".$id;
			if ($mysqli->query($sql)) {
			    $respuesta= "modificada";
			}
			else{
				$respuesta= mysqli_error($mysqli);
			}
		
		echo $respuesta;

	$mysqli->close();
?>