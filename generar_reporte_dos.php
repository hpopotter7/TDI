<?php 

include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
         
    $arr_clientes=array();
    $arr_eventos=array();
	$result = $mysqli->query("SET NAMES 'utf8'");
                $sql="select sum(cheque_por) from odc where evento='".$row2[0] ;
                  
			if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    $cliente=$row[0];                   
                    $sql2="select Numero_evento from eventos where cliente='".$cliente."'" ;
                    if ($result2 = $mysqli->query($sql2)) {
                        while ($row2 = $result2->fetch_row()) {
                            /*array_push($arr_clientes, $cliente."-".$row2[0]);*/
                           
                        }
                        
                    }
                }
                $result->close();
            }
            
			else{
				$respuesta= "Error: ".$sql.mysqli_error($mysqli);
            }
            
            for ($i=0; $i < count($arr_clientes) ; $i++) { 
                $respuesta=$respuesta."cliente: ".$arr_clientes[$i]."<br>";
                
            }
            echo $respuesta;
        

	$mysqli->close();
?>