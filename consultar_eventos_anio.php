<?php

include("conexion.php");	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    
    $sql="select Numero_evento, concat('[',Numero_evento,'] ', Nombre_evento) as evento from eventos where Numero_evento like '2020-%' order by id_evento";
    
    $result = $mysqli->query("SET NAMES 'utf8'"); 
    
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $resultado=$resultado."<option value='".$row[0]."'>".$row[1]."</option>";      
        }
      }
      else{
        $resultado= "Error: ".$sql.mysqli_error($mysqli);
    }
      echo $resultado;
?>