<?php
	$tit=$_POST['tit']; 
	$id_prov=$_POST['id_prov']; 
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	$tabla="clientes";
	$id="id_cliente";
	if($tit=="proveedor"){
		$tabla="proveedores";
		$id="id_proveedor";
	}
	
		$sql="update ".$tabla." set Estatus='borrado' where ".$id."=".$id_prov;
		if ($mysqli->query($sql)) {
		    echo "eliminado".$sql;
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>