<?php 
	$numero_evento=$_POST['numero_evento'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$sql="UPDATE eventos SET Estatus='ABIERTO' where Numero_evento='".$numero_evento."'";
		if ($mysqli->query($sql)) {		    
		    echo "evento abierto";
		}
		else{
			echo $sql.mysqli_error($mysqli);
        }
        

	$mysqli->close();
?>