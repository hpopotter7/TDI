<?php 
$numero=$_POST['numero'];
$id=$_POST['id'];

include("conexion.php");
	//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
	
	//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
		$respuesta="nop";
			//obtener el cliente para agrupacion
		$cliente="";
		$sql5="SELECT a_nombre FROM odc where id_odc=".$id;
		if ($result = $mysqli->query($sql5)) {
		    while ($row = $result->fetch_row()) {
		        $cliente=$row[0];
		    }
		    $result->close();
		}
		

		//
		$sql="SELECT factura from odc where a_nombre='".$cliente."' and factura=".$numero;
		$pagada="";
		$result = $mysqli->query($sql);
		if (! $result){
		echo " La consulta SQL contiene errores.".mysql_error();
		}else {
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
			        $pagada= $row[0];
			        $respuesta="ya existe";
			    }
			    $result->close();
			}
		}
		if($pagada==""){ // si no encuentra esa factrura la agregamos
				$sql="UPDATE odc set Factura='".$numero."', Fecha_hora_factura=NOW() where id_odc='".$id."'";
			if ($mysqli->query($sql)) {
			    $respuesta= "factura registrada";
			}
			else{
				$respuesta= $sql."<br>".mysqli_error($mysqli);
			}
		}
		else{ // si ya existe regresamos que ya fue ocupada
			//$respuesta=$numero;
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