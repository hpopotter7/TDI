<?php 
$id=$_POST['id'];
$estatus=$_POST['estatus'];
include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
    $result = $mysqli->query("SET NAMES 'utf8'");
    /*
    $sql="select estatus from tarjetas where No_tarjeta='".$id."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $estatus=$row[0];
        }
        $result->close();
    }
    */
    if($estatus=="activar"){
        $estatus="A";
    }

    else if($estatus=="bloquear"){
        $estatus="B";
    }
		$sql="update tarjetas set Estatus='".$estatus."' where No_Tarjeta='".$id."'";
			if ($mysqli->query($sql)) {
			    echo "exito";
			}
			else{
				echo "Error".mysqli_error($mysqli);
			}
		
	$mysqli->close();
?>