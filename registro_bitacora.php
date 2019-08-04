<?php 
$usuario=$_POST['usuario'];
$usuario=strtoupper($usuario);
include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$sql="insert into bitacora_login(Usuario, fecha_ingreso) values('".$usuario."', NOW())";
			if ($mysqli->query($sql)) {
			    echo "Registro bitacora";
			}
			else{
				echo $sql."<br>".mysqli_error($mysqli);
			}
		
	$mysqli->close();
?>