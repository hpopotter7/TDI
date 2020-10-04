<?php 
	$ids=$_POST['ids'];
	$evento=$_POST['evento'];
	
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$array_bitacora=array();
	$numero_evento="";
	$result = $mysqli->query("SET NAMES 'utf8'");
	$sql="SELECT Numero_evento FROM eventos where id_evento=".$evento;
	if ($result = $mysqli->query($sql)) {
		    while ($row = $result->fetch_row()) {
		        $numero_evento=$row[0];
		    }
		    $result->close();
		}
		$arr=explode(",",$ids);
		$sql="";
		$tamaño=count($arr);
		$var=0;
		
		for ($i=0; $i < $tamaño-1; $i++) { 
			$evento_anterior="";
			$sql="SELECT evento FROM odc where id_odc=".$arr[$var];
			if ($result = $mysqli->query($sql)) {
					while ($row = $result->fetch_row()) {
						$evento_anterior=$row[0];
					}
					$result->close();
				}

			$sql="UPDATE odc SET evento='".$numero_evento."' where id_odc=".$arr[$var];
			if ($mysqli->query($sql)) {    
				$res="update correcto";
				array_push($array_bitacora, "insert into bitacora(Usuario, tabla_actualizar, valor_anterior, valor_nuevo, fecha_hora_registro) values('".$_COOKIE['user']."', 'Transferencia id_odc: ".$arr[$var]."', '".$evento_anterior."', '".$numero_evento."', NOW())");
			}
			else{
				$res= $res.mysqli_error($mysqli)."--".$sql;
				break;
			}
			$var++;
			
		}
		foreach($array_bitacora as $valor){
			if ($mysqli->query($valor)) {    
			}
		}
		$mysqli->close();
		echo $res;
?>