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
    $header="<thead><tr><th># evento</th><th>Nombre de evento</th><th>Presupuesto</th><th>Suma egresos</th><th>Utilidad</th></tr></thead><tbody>";
    $filtros="";
    if($EV=="todos"){
        $EV="";
    }
    else{
        $EV="and e.id_evento in (".$EV.")";
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
        $PERIODO="and e.Numero_evento like '".$PERIODO."%'";
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
	$result = $mysqli->query("SET NAMES 'utf8'");
                $sql="select e.Nombre_evento as Nombre, ANY_VALUE(e.Facturacion), sum(o.cheque_por) as Suma, ANY_VALUE(e.Numero_evento) from eventos e left join odc o on e.Numero_evento=o.evento where e.Estatus='ABIERTO' ".$filtros." group by e.Nombre_evento ORDER by Nombre asc" ;
           
			if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    $presup=$row[1];
                    $suma=$row[2];
                    $numero=$row[3];          
                    $diferencia=$presup-$suma;
                    $suma_presupuestos=$suma_presupuestos+$presup;
                    $suma_egresos=$suma_egresos+$suma;
                    $suma_utilidades=$suma_utilidades+$diferencia;
                    if($diferencia<=0){
                        $diferencia="<label class='label label-danger'>".moneda($diferencia)."</label>";
                    }
                    else{
                        $diferencia="<label class='label label-success'>".moneda($diferencia)."</label>";
                    }
                    $respuesta= $respuesta."<tr><td>".$numero."</td><td><label id='evento_".$numero."' href='#' class='btn btn-info'>".$row[0]."</label></td><td>".moneda($presup)."</td><td>".moneda($suma)."</td><td>".$diferencia."</td></tr>";
                }
			}
			else{
				$respuesta= "Error: ".$sql.mysqli_error($mysqli);
            }

            //$totales="<tr><td colspan='2' class='text-align:right'>Totales:</td><td>".moneda($suma_presupuestos)."</td><td>".moneda($suma_egresos)."</td><td>".moneda($suma_utilidades)."</td></tr>";
            
            if($respuesta==""){
                
            }
            else{
                $respuesta=$header.$respuesta."</tbody>";
            }
        echo $respuesta;
        //echo "Error: ".$sql;

	$mysqli->close();
?>