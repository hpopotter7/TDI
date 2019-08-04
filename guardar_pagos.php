<?php 

	$id=$_POST['id'];
	$bandera=$_POST['bandera'];	

	//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
	include("conexion.php");
	//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	
		$sql="UPDATE odc SET pagado='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
		    
		    echo "orden modificada";
		    
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}
	$mysqli->close();
	
?>