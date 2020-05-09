<?php
	$id=$_POST['id']; 
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	
		$sql="delete from tarjetas where id_tarjeta=".$id;
		if ($mysqli->query($sql)) {
		    echo "eliminado".$sql;
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>