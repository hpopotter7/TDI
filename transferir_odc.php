<?php 
	$ids=$_POST['ids'];
	$evento=$_POST['evento'];
	
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
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
			$sql="UPDATE odc SET evento='".$numero_evento."' where id_odc=".$arr[$var];
			if ($mysqli->query($sql)) {    
			    $res="update correcto";
			}
			else{
				$res= $res.mysqli_error($mysqli)."--".$sql;
				break;
			}
			$var++;
			
		}
		$mysqli->close();
		echo $res;
?>