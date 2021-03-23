<?php 
	$id_cliente=$_POST['id_cliente'];
	$estatus=$_POST['estatus'];
	$tabla=$_POST['tabla'];
	include("conexion.php");	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	if($tabla=="clientes"){
		$id="id_cliente";
	}
	else{
		$id="id_proveedor";
	}
	$sql="UPDATE ".$tabla." SET estatus='".$estatus."' where ".$id."='".$id_cliente."'";
		if ($mysqli->query($sql)) {		    
		    echo "ok";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}
	$mysqli->close();
?>
