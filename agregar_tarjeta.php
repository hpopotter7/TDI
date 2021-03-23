<?php 
$numero=$_POST['numero'];
$banco=$_POST['banco'];
$id_usuario=$_POST['id_usuario'];
include("conexion.php");
	//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
	
	//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$respuesta="";

		$sql="SELECT No_tarjeta, Tipo, Usuario from tarjetas where No_tarjeta='".$numero."' and Tipo='".$banco."'";
		$pagada="";
		$result = $mysqli->query($sql);
		if (! $result){
		echo $sql."La consulta SQL contiene errores.".mysqli_error($mysqli);;
		}else {
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
			        $pagada= $row[2];
			    }
			    $result->close();
			}
		}
		if($pagada==""){ // si no encuentra registrado ese banco lo agregamos
				//$sql="INSERT INTO tarjetas (No_Tarjeta, Tipo, Usuario) values('".$numero."', '".$banco."', (Select id_usuarios from usuarios where Nombre='".$id_usuario."'))";
				$sql="INSERT INTO tarjetas (No_Tarjeta, Tipo, Usuario) values('".$numero."', '".$banco."', '".$id_usuario."')";
			if ($mysqli->query($sql)) {
			    $respuesta= "tarjeta agregada";
			}
			else{
				$respuesta= $sql."<br>".mysqli_error($mysqli);
			}
		}
		else if($pagada=="0"){// si ya existe regresamos que ya fue ocupada
			//$respuesta="error ".$pagada;
			$sql="update tarjetas set Usuario=(Select id_usuarios from usuarios where Nombre='".$id_usuario."') where No_Tarjeta='".$numero."'";
			if ($mysqli->query($sql)) {
			    $respuesta= "tarjeta agregada";
			}
			else{
				$respuesta= $sql."<br>".mysqli_error($mysqli);
			}
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