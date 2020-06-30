<?php 
    $valor=$_POST['valor'];
    $usuario=$_POST['usuario'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    
	$result = $mysqli->query("SET NAMES 'utf8'");
		$sql="UPDATE usuarios SET pa=".$valor." where Nombre='".$usuario."'";
		if ($mysqli->query($sql)) {		    
		    $res= "exito";
		}
		else{
			$res= "Error: ".mysqli_error($mysqli);
        }
        
        echo $sql."-".$res;

	$mysqli->close();
?>