<?php 
$proveedores=$_POST['proveedores'];
include("conexion.php");
$suma_presupuestos=0;
$suma_egresos=0;
$suma_utilidades=0;
function moneda($value) {
    return '$' . number_format($value, 2);
  }
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $prov="";
    
    for($r=0;$r<=count($proveedores)-1;$r++){
        $prov=$prov."'".$proveedores[$r]."',";
    }
    $prov=substr($prov,0,strlen($prov)-1);
    $result = $mysqli->query("SET NAMES 'utf8'");   
    $sql="select DISTINCT(evento) from odc where a_nombre in(".$prov.")";        
			if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    $respuesta=$respuesta."'".$row[0]."',";
                }
                $respuesta=substr($respuesta,0,strlen($respuesta)-1);
                $result->close();
			}
			else{
				$respuesta= "Error: ".mysqli_error($mysqli);
            }

            
        echo $respuesta;
        

	$mysqli->close();
?>