<?php 
	$phrase=$_POST["phrase"];
	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	// $valida="";
	 $result = $mysqli->query("SET NAMES 'utf8'");    

    $sql="SELECT concat('[',Numero_evento,'] ' , Cliente, ' - ' , Nombre_Evento ) as nombre from eventos where Nombre_evento like '%".$phrase."%' or Numero_evento like '%".$phrase."%' limit 0, 1000";
	
	if ($result = $mysqli->query($sql)) {
		$dbdata = array();
		while ( $row = $result->fetch_assoc())  {
			$dbdata[]=$row;
		  }
		$result->close();
	}
	else{
		echo $sql." La consulta SQL contiene errores.".$mysqli->error;
	}
	echo json_encode($dbdata);
	$mysqli->close();

?>