<?php 
	$id_odc=$_POST['id_odc'];
	$motivo=$_POST['motivo'];
	$monto=$_POST['monto'];
	$fecha=$_POST['fecha'];
	$banco=$_POST['banco'];
	$ordenes=0;
	$ID="";
	
	$importe_total=0;
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");

	$sql="select cheque_por from odc where id_odc=".$id_odc;
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$importe_total=$row[0]-$monto;
				}
			}
			
			$sql="UPDATE odc SET Motivo_devolucion='".$motivo."', Monto_devolucion='".$monto."', Fecha_devolucion=NOW(), Banco_devolucion='".$banco."', Importe_total=".$importe_total." where id_odc=".$id_odc;
			$result = $mysqli->query("SET NAMES 'utf8'");
			if ($mysqli->query($sql)) {		    
			    $res= "devolucion exitosa";
			}
			else{
				$res= $sql.mysqli_error($mysqli);
			}
		if($res=="devolucion exitosa" && $banco!="0"){
			$sql="select * from movimientos where id_solicitud=".$id_odc." and Tipo_movimiento='DEVOLUCION'";
			$contador=0;
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$contador++;
					break;
				}
			}
			else{
				$res= $sql.mysqli_error($mysqli);
			}
			if($contador==0){
				$sql="insert into movimientos (id_solicitud, No_Tarjeta, Importe, tipo_movimiento, comentarios) values(".$id_odc.", '".$banco."', ".$monto.", 'DEVOLUCION', '".$motivo."')";
				if ($mysqli->query($sql)) {		    
					$res= "devolucion exitosa";
				}
				else{
					$res= $sql.mysqli_error($mysqli);
				}
			}
			else{
				$sql="update movimientos set Importe='".$monto."', comentarios='".$motivo."' where id_solicitud=".$id_odc;
				if ($mysqli->query($sql)) {		    
					$res= "devolucion exitosa";
				}
				else{
					$res= $sql.mysqli_error($mysqli);
				}
			}
		}
		echo $res;
	$mysqli->close();
?>