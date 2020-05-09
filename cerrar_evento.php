<?php 
	$evento=$_POST['evento'];
	
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $result = $mysqli->query("SET NAMES 'utf8'");
	
		$arr=explode("]",$evento);
		$evento=str_replace("[", "", $arr[0]);
		
		$sql="UPDATE eventos SET Estatus='CERRADO' where Numero_evento='".$evento."'";
		
		if ($mysqli->query($sql)) {		    
		    echo "cerrado";
		}
		else{
			echo mysqli_error($mysqli);
		}

	$mysqli->close();
?>