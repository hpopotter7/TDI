<?php 
	$user=$_POST['user'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}

		$sql="UPDATE usuarios SET Pass='tierraideas' where Nombre='".$user."'";
		if ($mysqli->query($sql)) {		    
		    echo "ok";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>
