<?php 
$EV=$_POST['EV'];
$PROV=$_POST['PROV'];
$PERIODO=$_POST['PERIODO'];
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
    $header="<thead><tr><th># evento</th><th>Nombre de evento</th><th>Facturación</th><th>Suma egresos</th><th>Utilidad</th></tr></thead><tbody>";
    $filtros="";
    if($EV=="todos"){
        $EV="";
    }
    else{
        $EV=" where id_evento in (".$EV.")";
    }
    if($PROV=="todos"){
        $PROV="";
    }
    else{
        $PROV="and o.a_nombre in (".$PROV.")";
    }
    if($PERIODO=="todos"){
        $PERIODO="";
    }
    else{
        $arr=explode(",", $PERIODO);
        for($r=0;$r<=count($arr)-1;$r++){
            $PERIODO=$PERIODO." and e.Numero_evento like '".$arr[$r]."%'";
        }
    }


    $filtros=$EV;
    if($filtros!=""){
        $filtros=$filtros." ".$PROV;
    }
    else{
        $filtros=$PROV;
    }
    if($filtros!=""){
        $filtros=$filtros." ".$PERIODO;
    }
    else{
        $filtros=$PERIODO;
    }
    $suma_facturacion=0;
    $suma_egresos=0;
    $suma_utilidad=0;
	$result = $mysqli->query("SET NAMES 'utf8'");
                $sql="SELECT * FROM Reporte_Facturacion_vs_Gastos where Numero_Evento is not null " ;
           
			if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    $numero_evento=$row[0];
                    $nombre_evento=$row[1];
                    $facturacion=$row[2];
                    $egresos=$row[3];
                    $utilidad=$facturacion-$egresos;
                    $suma_facturacion=$suma_facturacion+$facturacion;
                    $suma_egresos=$suma_egresos+$egresos;
                    $suma_utilidad=$suma_utilidad+$utilidad;
                    if($utilidad<=0){
                        $utilidad="<h4><label class='label label-danger'>".moneda($utilidad)."</label></h4>";
                    }
                    else{
                        $utilidad="<h4><label class='label label-success'>".moneda($utilidad)."</label></h4>";
                    }
                    $respuesta= $respuesta."<tr><td>".$numero_evento."</td><td><label id='evento_".$numero_evento."' href='#' class='btn btn-info'>".$nombre_evento."</label><td>".moneda($facturacion)."</td><td>".moneda($egresos)."</td><td>".$utilidad."</td></tr>";
                }
                $result->close();
			}
			else{
				$respuesta= "Error: ".$sql.mysqli_error($mysqli);
            }

            $footer="<tfoot><tr><td colspan='2'>Totales: </td><td>".moneda($suma_facturacion)."</td><td>".moneda($suma_egresos)."</td><td>".moneda($suma_utilidad)."</td></tr></tfoot>";      

            
            if($respuesta==""){
                
            }
            else{
                $respuesta=$header.$respuesta."</tbody>".$footer;
            }


        echo $respuesta;
        //echo "Error: ".$sql;

	$mysqli->close();
?>