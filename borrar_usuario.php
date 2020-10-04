<?php
	$nombre=$_POST['nombre']; 
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");

		//$sql="delete from usuarios where Nombre='".$nombre."'";
		$sql="update usuarios set Estatus='baja' where Nombre='".$nombre."'";
		if ($mysqli->query($sql)) {
		    echo "usuario eliminado".$sql;
		}
		else{
			echo mysqli_error($mysqli);
		}

	$mysqli->close();
?>