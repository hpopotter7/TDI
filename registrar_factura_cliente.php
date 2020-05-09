<?php 
$numero=$_POST['numero'];
$id_solicitud_factura=$_POST['id_solicitud_factura'];
include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$respuesta="";
		/*
		$sql="SELECT No_factura from solicitud_factura where id_solicitud='".$id_solicitud_factura."'";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
                    $respuesta= $row[0];
                    if($respuesta==$numero){
                        $respuesta="existe";
                    }
                    else{
                        $respuesta="";
                    }
			    }
			    $result->close();
            }
            */
		if($respuesta==""){ // si no encuentra registrado esa factura lo agregamos
				$sql="update solicitud_factura set No_Factura='".$numero."' where id_solicitud=".$id_solicitud_factura;
			if ($mysqli->query($sql)) {
			    $respuesta= "factura agregada";
			}
			else{
				$respuesta= mysqli_error($mysqli);
			}
		}
		echo $respuesta;

	$mysqli->close();
?>