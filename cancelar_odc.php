<?php
	$motivo=$_POST['motivo'];
	$evento=$_POST['evento']; 
	$ids=$_POST['ids'];
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");

	    $arr=explode(",",$ids);
		$tamaño=count($arr);
		for ($i=0; $i < $tamaño-1; $i++) { 
			$sql="update odc set Cancelada='si', Motivo_cancelacion='".$motivo."' where id_odc=".$arr[$i];
			if ($mysqli->query($sql)) {
			    $res= "cancelado";
			}
			else{
				$res= mysqli_error($mysqli)."<p>".$sql;
				break;
			}
		}
	echo $res;
	$mysqli->close();
?>
