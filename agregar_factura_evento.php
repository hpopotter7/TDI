<?php 
$numero=$_POST['numero'];
$importe=$_POST['importe'];
$estatus=$_POST['estatus'];
$evento=$_POST['evento'];
include("conexion.php");

$arr=explode("]",$evento);
$evento=str_replace("[", "", $arr[0]);

if (mysqli_connect_error()) {
    echo "Error de conexion: %s\n", mysqli_connect_error();
    exit();
}

$sql="SELECT id_evento from eventos where Numero_evento='".$evento."'";		
		if ($result = $mysqli->query($sql)) {
		    while ($row = $result->fetch_row()) {
		        $evento=$row[0];
		    }
		    $result->close();
		}
		else{
            echo $sql.mysqli_error($mysqli);
            exit();
        }
        
$sql="select e.Numero_evento, e.Nombre_evento from eventos e INNER join solicitud_factura s on s.id_evento=e.id_evento and s.No_Factura='".$numero."'";
		if ($result = $mysqli->query($sql)) {
		    while ($row = $result->fetch_row()) {
                echo "La factura ".$numero." esta duplicada en el evento<br>[".$row[0]."] - ".$row[1];
                
                exit();
		    }
            $result->close();
            
           
		}
		else{
            echo $sql.mysqli_error($mysqli);
            exit();
		}
	
	
	$result = $mysqli->query("SET NAMES 'utf8'");
		$respuesta="";
                $sql="insert into solicitud_factura(id_evento,Dias_credito,Num_pedido,Num_orden,Num_entrada,GR,Correo1,correo2,correo3,correo4,correo5,Fecha_hora_registro,Usuario_registra,Observaciones,empresa_factura,Estatus, No_factura, Estatus_Factura, Moneda) values(".$evento.",'0','0','0','0','0','carga@inicial.com', '', '', '', '', NOW(), '".$_COOKIE['user']."', '', 'TDI', 'Activa', '".$numero."', '".$estatus."', 'MXN');";
               
			if ($mysqli->query($sql)) {
			    $respuesta= "factura agregada";
			}
			else{
                $respuesta= mysqli_error($mysqli);
            }
           $pu=$importe/1.16;
            if($respuesta=="factura agregada"){
                $sql="insert into partidas(descripcion, pu, iva, total, id_sol_factura) values('Carga inicial', '".$pu."', '".($pu*.16)."', '".$importe."', (Select max(id_solicitud) from solicitud_factura))";
                
                if ($mysqli->query($sql)) {
                    $respuesta= "factura agregada";
                }
                else{
                    $respuesta.= $sql.mysqli_error($mysqli);
                    $sql="delete from solicitud_factura where id_solicitud=(Select max(id_solicitud) from solicitud_factura)";
                    if ($mysqli->query($sql)) {
                        $respuesta.= "borrado";
                    }
                    else{
                        $respuesta.= mysqli_error($mysqli);
                    }
                    
                }
            }
		
		echo $respuesta;

	$mysqli->close();
?>