<?php 
	$prov=$_POST['prov'];
	$estatus=$_POST['estatus'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}

		$sql="UPDATE proveedores SET estatus='".$estatus."' where Razon_Social='".$prov."'";
		if ($mysqli->query($sql)) {		    
		    echo "exito";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>