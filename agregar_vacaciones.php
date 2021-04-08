<?php 
$f_inicio=$_POST['f_inicio'];
$f_final=$_POST['f_final'];
$dias=$_POST['dias'];
$fecha_regreso=$_POST['fecha_regreso'];
$id=$_COOKIE['id'];
$id_vacaciones=$_POST['id_vacaciones'];
$respuesta="";
include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	if($id_vacaciones=="0"){
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
				$sql="INSERT INTO vacaciones (id_usuario, Fecha_Inicio, Fecha_Fin, Jefe_Directo, Dias, Estatus, Fecha_regreso) values('".$id."', '".$f_inicio."', '".$f_final."', '".$jefe."','".$dias."', 'P', '".$fecha_regreso."')";
			if ($mysqli->query($sql)) {
			    $respuesta= "Solicitud guardada";
			}
			else{
				$respuesta= "Error: ".mysqli_error($mysqli);
			}
		}		
		else{
			$respuesta="El usuario no tiene asignado un jefe directo";
		}
	}
	else{
		$sql="update vacaciones set Fecha_Inicio='".$f_inicio."', Fecha_Fin='".$f_final."', Dias='".$dias."', Fecha_regreso='".$fecha_regreso."' where id_vacaciones='".$id_vacaciones."'";
		if ($mysqli->query($sql)) {
			$respuesta= "Solicitud modificada";
		}
		else{
			$respuesta= "Error: ".mysqli_error($mysqli);
		}
	}
		
		echo $respuesta;

	$mysqli->close();
?>