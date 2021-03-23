<?php 
	$estatus=$_POST['estatus'];
	$id_usuario=$_POST['id_usuario'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$sql="UPDATE usuarios SET Estatus='".$estatus."' where id_usuarios='".$id_usuario."'";
		if ($mysqli->query($sql)) {		    
		    echo "ok";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>
