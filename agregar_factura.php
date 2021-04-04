<?php 
$numero=$_POST['numero'];
$id_solicitud_factura=$_POST['id_solicitud_factura'];
include("conexion.php");


	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$respuesta="";
		$num="";
		if($numero!="0"){
		$sql="SELECT No_factura, (select Numero_evento from eventos where eventos.id_evento=solicitud_factura.id_evento) from solicitud_factura where No_Factura='".$numero."'";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$respuesta= $row[0];
					$num=$row[0];
                    if($respuesta==$numero){
                        $respuesta="existe".$row[1];
						
                    }
                    else{
                        $respuesta="";
                    }
			    }
			    $result->close();
            }		
		}
            
		if($respuesta==""){ // si no encuentra registrado esa factura lo agregamos
			if($numero!="0"){
				$sql="update solicitud_factura set No_Factura='".$numero."' where id_solicitud=".$id_solicitud_factura;
			}
			else if($numero=="0"){
				$sql="update solicitud_factura set No_Factura=null, Estatus_Factura=null where id_solicitud=".$id_solicitud_factura;
			}
			else if($_COOKIE['user']=='SEBASTIAN ZUÑIGA'){
				$sql="update solicitud_factura set No_Factura='".$numero."', Estatus_Factura='POR COBRAR' where id_solicitud=".$id_solicitud_factura;
			}
			if ($mysqli->query($sql)) {
				$respuesta= "insert into bitacora(Usuario, tabla_actualizar, valor_anterior, valor_nuevo, fecha_hora_registro) values('".$_COOKIE['user']."', 'Update solicitud_factura id_sol_factura: ".$id_solicitud_factura."', '".$num."', '".$numero."', NOW())";
				$respuesta="factura agregada";				
			}
			else{
				$respuesta= mysqli_error($mysqli);
			}
		}
		
		echo $respuesta;

	$mysqli->close();
?>