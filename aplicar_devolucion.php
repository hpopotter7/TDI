<?php 
	$valor=$_POST['valor'];
    $id=$_POST['id'];
    $tarjeta=$_POST['tarjeta'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
    $result = $mysqli->query("SET NAMES 'utf8'");
	$sql="UPDATE movimientos SET importe='".$valor."', fecha_afectacion=NOW() where id_solicitud='".$id."' and Tipo_movimiento='DEVOLUCION'";
		if ($mysqli->query($sql)) {		    
		    $res= "éxito";
		}
		else{
			$res= $sql.mysqli_error($mysqli);
		}
    echo $res;
	$mysqli->close();
?>