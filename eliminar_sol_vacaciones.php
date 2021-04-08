<?php
	$id_vacaciones=$_POST['id_vacaciones']; 
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	
		$sql="delete from vacaciones where id_vacaciones=".$id_vacaciones;
		if ($mysqli->query($sql)) {
		    echo "eliminada";
		}
		else{
			echo mysqli_error($mysqli);
		}

	$mysqli->close();
?>