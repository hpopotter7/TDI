<?php
	$motivo=$_POST['motivo'];
	$id=$_POST['id'];
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");

			$sql="update solicitud_factura set Estatus='Cancelada', Motivo_cancelacion='".$motivo."' where id_solicitud=".$id;
			if ($mysqli->query($sql)) {
			    $res= "cancelada";
			}
			else{
				$res= mysqli_error($mysqli)."<p>".$sql;
			}
			
	echo $res;
	$mysqli->close();
?>
