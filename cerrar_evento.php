<?php 
	$evento=$_POST['evento'];
	$tipo=$_POST['tipo'];
	
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $result = $mysqli->query("SET NAMES 'utf8'");
	
		$arr=explode("]",$evento);
		$evento=str_replace("[", "", $arr[0]);

		$sql="select pagado, comprobado from odc where evento='".$evento."'";
		$comodin="";
		$solicitudes=0;
		if ($result = $mysqli->query($sql)) {
			$cont=0;
			 while ($row = $result->fetch_row()) {
				 $solicitudes++;
				 $pagado=$row[0];
				 $comprobado=$row[1];
				 if($pagado=="no" || $comprobado=="no"){
					$comodin="checks";
				 	break;
				 }
			 }
		}
		else{
			echo "Error:".mysqli_error($mysqli);
			$mysqli->close();
			exit();
		}

		if($comodin=="checks" && $tipo=="CERRADO"){
			echo "Este evento aún cuenta con solicitudes pendientes por aprobar";
			$mysqli->close();
			exit();
		}

		

		$sql="select No_Factura, Estatus_Factura from solicitud_factura where id_evento=(select id_evento from eventos where Numero_evento='".$evento."') and estatus='Activa'";
		$comodin="";
		$facturas=0;
		if ($result = $mysqli->query($sql)) {
			 while ($row = $result->fetch_row()) {
				 $facturas++;
				 $numero=$row[0];
				 $estatus=$row[1];
				 if($numero==null || $estatus==null){
					$comodin="facturas";
				 }
			 }
		}
		else{
			echo "Error:".mysqli_error($mysqli);
			$mysqli->close();
			exit();
		}


		
		if($comodin=="facturas" && $tipo=="CERRADO"){
			echo "Este evento tiene facturas pendientes por revisar";
			$mysqli->close();
			exit();
		}

		// else if($solicitudes>0 && $tipo=="PITCH"){
		// 	echo "Este evento cuenta con SDP, por lo tanto no puede mandarse a PITCH";
		// 	$mysqli->close();
		// 	exit();
		// }
		else if($facturas>0 && $tipo=="PITCH"){
			echo "Este evento tiene facturación, por lo tanto no puede mandarse a PITCH";
			$mysqli->close();
			exit();
		}



		
		$sql="UPDATE eventos SET Estatus='".$tipo."' where Numero_evento='".$evento."'";
		
		if ($mysqli->query($sql)) {		    
		    echo "cerrado";
		}
		else{
			echo mysqli_error($mysqli);
		}

	$mysqli->close();
?>