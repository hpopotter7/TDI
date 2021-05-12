<?php 
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$tipo=$_POST['tipo'];
$descripcion=$_POST['descripcion'];
$id=$_COOKIE['id'];
$id_activo=$_POST['id_activo'];
$respuesta="";

include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	if($id_activo=="0"){		 
			/* $sql="INSERT INTO activo_fijo (id_usuario, Marca, Modelo, Descripcion, tipo, Fecha_alta) values('".$id."', '".$f_inicio."', '".$f_final."', '".$jefe."','".$dias."', 'P', '".$tipo."')";
			if ($mysqli->query($sql)) {
			    $respuesta= "Permiso guardado";
			}
			else{
				$respuesta= "Error: ".mysqli_error($mysqli);
			} */
		
	}
	else{  // select
		$sql="select * from activo_fijo where id_activo='".$id_activo."'";
		if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
			$marca=$row['Marca'];
            $modelo=$row['Modelo'];
            $tipo=$row['Tipo'];
            $descripcion=$row['Descripcion'];
            $fecha=$row['Fecha_alta'];
            }
            $result->close();
		}
		else{
			$respuesta= "Error: ".mysqli_error($mysqli);
		}
	}
echo $respuesta;
$mysqli->close();
?>