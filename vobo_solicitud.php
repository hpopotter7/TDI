<?php 
	$id=$_POST['id'];
    $bandera=$_POST['bandera'];	
    $tipo=$_POST['tipo'];
	include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $resultado="";
    $result = $mysqli->query("SET NAMES 'utf8'"); 
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
		    $resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
        }

        if($resultado=="actualizado"){
            $resultado="completo#".$id;
        }
        echo $resultado;
	$mysqli->close();
?>