<?php 
	$id_odc=$_POST['id_odc'];
	$motivo=$_POST['motivo'];
	$monto=$_POST['monto'];
	$fecha=$_POST['fecha'];
	$banco=$_POST['banco'];
	$ordenes=0;
	$ID="";
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}

	$result = $mysqli->query("SET NAMES 'utf8'");

			$sql="UPDATE odc SET Motivo_devolucion='".$motivo."', Monto_devolucion='".$monto."', Fecha_devolucion='".$fecha."', Banco_devolucion='".$banco."' where id_odc=".$id_odc;
			$result = $mysqli->query("SET NAMES 'utf8'");
			if ($mysqli->query($sql)) {		    
			    echo "devolucion exitosa".$sql;
			}
			else{
				echo $sql.mysqli_error($mysqli);
			}
		
		

	$mysqli->close();
?>