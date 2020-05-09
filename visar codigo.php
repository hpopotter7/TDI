<?php 

include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $sql="select id_odc, evento, cheque_por, Monto_devolucion from odc";
    $mysqli->close();
    ?>