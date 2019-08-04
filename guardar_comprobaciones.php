<?php 

	$id=$_POST['id'];
	$bandera=$_POST['bandera'];	

	include("conexion.php");

	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	
		$sql="UPDATE odc SET comprobado='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
		    
		    echo "orden modificada";
		    
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}
	$mysqli->close();
	
?>