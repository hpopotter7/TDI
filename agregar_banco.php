<?php 
$nombre=$_POST['nombre'];
$nombre=strtoupper($nombre);
include("conexion.php");
	//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
	
	//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$respuesta="";

		$sql="SELECT Nombre from bancos where Nombre='".$nombre."'";
		$pagada="";
		$result = $mysqli->query($sql);
		if (! $result){
		echo $sql."La consulta SQL contiene errores.".mysql_error();
		}else {
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
			        $pagada= $row[0];
			    }
			    $result->close();
			}
		}
		if($pagada==""){ // si no encuentra registrado ese banco lo agregamos
				$sql="INSERT INTO bancos (Nombre) values('".$nombre."')";
			if ($mysqli->query($sql)) {
			    $respuesta= "Banco agregado";
			}
			else{
				$respuesta= $sql."<br>".mysqli_error($mysqli);
			}
		}
		else{ // si ya existe regresamos que ya fue ocupada
			$respuesta="ya existe";
		}
		/*$sql="UPDATE odc set Factura='".$numero."', Fecha_hora_factura=NOW() where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
		    $respuesta= "solicitud enviada";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
		*/
		echo $respuesta;

	$mysqli->close();
?>