<?php 
$numero=$_POST['numero'];
$id=$_POST['id'];

include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
		$respuesta="nop";

		$sql="SELECT no_cheque from odc where no_cheque='".$numero."'";
		$pagada="";
		$result = $mysqli->query($sql);
		if (! $result){
		echo " La consulta SQL contiene errores.".$sql.mysqli_error($mysqli);
		}else {
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
			        $pagada= $row[0];
			    }
			    $result->close();
			}
		}
		if($pagada==""){ // si no encuentra esa factrura la agregamos
				$sql="UPDATE odc set no_cheque='".$numero."', Fecha_hora_factura=NOW() where id_odc='".$id."'";
			if ($mysqli->query($sql)) {
			    $respuesta= "cheque registrado ".$sql;
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