<?php
	$id_permiso=$_POST['id_permiso']; 
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	
		$sql="delete from permisos where id_permiso=".$id_permiso;
		if ($mysqli->query($sql)) {
		    echo "eliminado";
		}
		else{
			echo mysqli_error($mysqli);
		}

	$mysqli->close();
?>