<?php 
	$id_evento=$_POST['id_evento'];
	$ordenes=0;
	$ID="";
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	//$comentarios = $mysqli->real_escape_string($comentarios);
	
		$arr=explode("]",$id_evento);
		$id_evento=str_replace("[", "", $arr[0]);
		$ID=$id_evento;
	
	

	$result = $mysqli->query("SET NAMES 'utf8'");

$sql="SELECT id_evento from eventos where Numero_evento='".$id_evento."'";		
		if ($result = $mysqli->query($sql)) {
		    while ($row = $result->fetch_row()) {
		        $ID=$row[0];
		    }
		    $result->close();
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}
		

		$sql="SELECT count(evento) from odc where evento='".$id_evento."' and Cancelada='no' ";	
		$ordenes=0;	
		if ($result = $mysqli->query($sql)) {
		    while ($row = $result->fetch_row()) {
				$ordenes=$row[0];
				
		    }
		    $result->close();
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}		
		
		if ($ordenes>0) {		    
			echo "Existen pagos";
			$mysqli->close();
		    exit();
		}

		else{
			$sql="UPDATE eventos SET Estatus='CANCELADO' where id_evento='".$ID."'";
			$result = $mysqli->query("SET NAMES 'utf8'");
			if ($mysqli->query($sql)) {		    
			    echo "cancelado".$sql;
			}
			else{
				echo $sql.mysqli_error($mysqli);
			}
		}
		

	$mysqli->close();
?>