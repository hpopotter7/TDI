<?php
$evento=$_GET['evento'];
include("conexion.php");
if (mysqli_connect_errno()) {
			printf("Error de conexion: %s\n", mysqli_connect_error());
			exit();
		}
		$result = $mysqli->query("SET NAMES 'utf8'");
		$sql="select Disenio, Ejecutivo, Produccion, Solicita, Ejecutivo, Digital from eventos where Numero_evento='".$evento."'";
		$to="";
		if ($result = $mysqli->query($sql)) {
			while ($row = $result->fetch_row()) {
				$valor1=$row[0];
				if($valor1==",NA"){
					$valor1="";
				}
				$valor2=$row[1];
				if($valor2==",NA"){
					$valor2="";
				}
				$valor3=$row[2];
				if($valor3==",NA"){
					$valor3="";
				}
				$valor4=$row[3];
				if($valor4==",NA"){
					$valor4="";
				}
				$valor5=$row[4];
				if($valor5==",NA"){
					$valor5="";
				}
				$to=$to.$valor1.$valor2.$valor3.$valor4.$valor5.",";
			}
			$result->close();
		}
		$result = $mysqli->query("SET NAMES 'utf8'");
		$usuarios=explode(",",$to);
		$to="";
		for ($i=0; $i<sizeof($usuarios); $i++) {
			$sql="select email from usuarios where Nombre='".$usuarios[$i]."'";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$to=$to.$row[0].",";
				}
				$result->close();
			}
		}
			$to=substr($to, 0,strlen($to)-1);
			$to=strtolower($to);
		$mysqli->close();
?>