<?php 
    $usuario=$_COOKIE['user'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    
    $result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT email FROM usuarios where Nombre='".$usuario."'";
    $email="";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $email=$row[0];
        }
        $result->close();
    }
    

		$sql="UPDATE notificaciones SET visto=1 where para_quien='".$email."'";
		if ($mysqli->query($sql)) {	
		    $res="Exito";
		}
		else{
			$res= "Error: ".mysqli_error($mysqli);
		}
		
		
        
        echo $sql;

	$mysqli->close();
?>