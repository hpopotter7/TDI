<?php 
	$importe=$_POST['importe'];
	$id=$_POST['id'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
    $result = $mysqli->query("SET NAMES 'utf8'");
		$sql="UPDATE movimientos SET importe='".$importe."', fecha_afectacion=NOW() where id_solicitud='".$id."' AND Tipo_movimiento='CARGO'";
		if ($mysqli->query($sql)) {		    
		    $res= "éxito";
		}
		else{
			$res= $sql.mysqli_error($mysqli);
		}
    echo $res;
	$mysqli->close();
?>