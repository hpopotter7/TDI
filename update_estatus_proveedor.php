<?php 
	$prov=$_POST['prov'];
	$estatus=$_POST['estatus'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$sql="UPDATE proveedores SET Estatus='".$estatus."' where Razon_Social='".$prov."'";
		if ($mysqli->query($sql)) {		    
		    echo "exito".$sql;
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>