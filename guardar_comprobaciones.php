<?php 

	$id=$_POST['id'];
	$bandera=$_POST['bandera'];	
	$res="";
	include("conexion.php");

	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	
		$sql="UPDATE odc SET comprobado='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
		    
		    $res="orden modificada";
		}
		else{
			$res=$sql.mysqli_error($mysqli);
		}

		if($res=="orden modificada"){
			$sql="";
			if($bandera=="si"){
				$sql="insert into movimientos(id_solicitud, No_tarjeta, Importe, Tipo_movimiento, Fecha_Afectacion, Fecha_creacion) values(".$id.", (select No_tarjeta from odc where id_odc=".$id."), (select cheque_por from odc where id_odc=".$id."), 'GASTO', NOW(), NOW())";
			}
			else{
				$sql="delete from movimientos where id_solicitud=".$id." and tipo_movimiento='GASTO'";
			}
			
			if ($mysqli->query($sql)) {
				
				$res= "orden modificada";
			}
			else{
				$res=mysqli_error($mysqli)." ".$sql;
			}
		}
		

		echo $res;
	$mysqli->close();
	
?>