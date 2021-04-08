<?php 
$f_inicio=$_POST['f_inicio'];
$f_final=$_POST['f_final'];
$tipo=$_POST['tipo'];
$dias=$_POST['dias'];
$id=$_COOKIE['id'];
$id_permiso=$_POST['id_permiso'];
$respuesta="";

include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	if($id_permiso=="0"){
		$jefe="";
		$sql="SELECT Jefe_Directo from usuarios where id_usuarios='".$id."'";		
		$result = $mysqli->query($sql);
		if (! $result){
		    $respuesta="Error: ".mysql_error($mysqli);
		}else {
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
			        $jefe= $row[0];
			    }
			    $result->close();
			}
		}
		if($jefe!=""){ 
				$sql="INSERT INTO permisos (id_usuario, Fecha_Inicio, Fecha_Fin, Jefe_Directo, Dias, Estatus, Tipo) values('".$id."', '".$f_inicio."', '".$f_final."', '".$jefe."','".$dias."', 'P', '".$tipo."')";
			if ($mysqli->query($sql)) {
			    $respuesta= "Permiso guardado";
			}
			else{
				$respuesta= "Error: ".mysqli_error($mysqli);
			}
		}		
		else{
			$respuesta="El usuario no tiene asignado un jefe directo";
		}
	}
	else{  // update
		$sql="update permisos set Fecha_Inicio='".$f_inicio."', Fecha_Fin='".$f_final."', Dias='".$dias."', Tipo='".$tipo."' where id_permiso='".$id_permiso."'";
		if ($mysqli->query($sql)) {
			$respuesta= "Permiso modificado";
		}
		else{
			$respuesta= "Error: ".mysqli_error($mysqli);
		}
	}
echo $respuesta;
$mysqli->close();
?>