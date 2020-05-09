<?php 
/*$anio=$_POST["anio"];*/
$anio="2020";

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

if ($result = $mysqli->query("SELECT count(id_evento), DATE_FORMAT(NOW(), '%Y') FROM eventos where numero_evento like '".$anio."%'")) {
    $filas="0";
    while ($row = $result->fetch_row()) {
        $r=$row[0]+1;

    	if($r<10){
    		$filas= $anio."-00".$r;	
    	}
    	else if($r<100){
    		$filas= $anio."-0".$r;	
    	}
    	else{
             $filas= $anio."-".$r;
        }
    }
    
    $result->close();
}
echo $filas;
$mysqli->close();
?>