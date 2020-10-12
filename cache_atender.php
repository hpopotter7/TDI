<?php     

$odc=$_POST['odc'];
include("conexion.php");	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
    $respuesta="";
            $sql="INSERT INTO cache_por_atender (odc, user) values('".$odc."', '".$_COOKIE['user']."')";
        if ($mysqli->query($sql)) {
            $respuesta= "listo";
        }
        else{
            $respuesta= $sql."<br>".mysqli_error($mysqli);
        }
    
    echo $respuesta;

	$mysqli->close();
?>