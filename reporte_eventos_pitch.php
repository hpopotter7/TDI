<?php
include("conexion.php");
$mysqli2=$mysqli;
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
function asmoneda($value) {
  return '$' . number_format($value, 2);
}

$sql="select o.id_odc, o.evento, e.Nombre_evento, e.Cliente, o.Project, o.Importe_total from odc o join eventos e on o.evento=e.Numero_evento where and (o.evento like '2019-%' or o.evento like '2020-%')";
$arr_eventos=array();
$arr_ids=array();
$arr_nombres=array();
$arr_clientes=array();
$arr_ejecutivos=array();
$arr_egresos=array();
$arr_ingresos=array();
$arr_utilidad=array();
$arr_porcentaje=array();


$res='<thead>
        <tr>
            <th>Número evento</th>
            <th>Nombre</th>
            <th>Cliente</th>
            <th>Egresos</th>
            <th>Ingresos</th>
            <th>Utilidad</th>
            <th>Porcentaje</th>
            <th>Ejecutivo</th>
        </tr>
    </thead><tbody>';
$sql = "SELECT Numero_evento, Nombre_evento, Cliente, Ejecutivo, id_evento  FROM eventos where Estatus='PITCH' order by Numero_evento ";
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {
        $CLIENTE=$row[2];
        /*
        $arr_cliente=explode('&', $row[2]);
        $CLIENTE=$arr_cliente[1];
        if($arr_cliente[2]!=""){
            $CLIENTE=$CLIENTE."&".$arr_cliente[2];
        }
        if($arr_cliente[3]!=""){
            $CLIENTE=$CLIENTE."&".$arr_cliente[3];
        }
        */
        array_push($arr_clientes,$CLIENTE);
       
        $ARR_EJECUTIVO=explode(",",$row[3]);
        $EJE="<ul>";
        for($r=1;$r<=count($ARR_EJECUTIVO)-1;$r++){
            $EJE=$EJE."<li>".$ARR_EJECUTIVO[$r]."</li>";
        }
        $EJE=$EJE."</ul>";

        array_push($arr_ejecutivos,$EJE);
        array_push($arr_nombres,$row[1]);
        /*
        $sql2="select sum(importe_total) from odc where Cancelada='no' and  evento='".$row[0]."'";
        //$sql2="select s.id_evento, sum(p.total) from solicitud_factura s, partidas p where s.id_solicitud=p.id_sol_factura and Estatus='Activa' and s.id_evento='".$row[4]."' GROUP by s.id_evento" ;
        if ($result2 = $mysqli2->query($sql2)) {
            while ($row2 = $result2->fetch_row()) {
                $res=$res.'<tr><td><button id="'.$row[12].'" class="btn btn-info ver_solicitudes">'.$row[0].'</button></td><td>'.$row[1].'</td><td>'.$CLIENTE.'</td><td><h4><label class="label label-primary">'.asmoneda($row2[0]).'</label></h4></td>';
            }

        }
        
        $sql2="select s.id_evento, sum(p.total) from solicitud_factura s, partidas p where s.id_solicitud=p.id_sol_factura and Estatus='Activa' and s.id_evento='".$row[4]."' GROUP by s.id_evento" ;
        
        if ($result2 = $mysqli2->query($sql2)) {
            while ($row2 = $result2->fetch_row()) {
                $res=$res.'<td><h4><label class="label label-primary">'.asmoneda($row2[1]).'</label></h4></td>';
            }

        }
        /*
        $sql2="select s.id_evento, sum(p.total) from solicitud_factura s, partidas p where s.id_solicitud=p.id_sol_factura and Estatus='Activa' and s.id_evento='".$row[4]."' GROUP by s.id_evento" ;
        if ($result1 = $mysqli2->query($sql2)) {
            while ($row2 = $result2->fetch_row()) {
                $res=$res.$row2[0];
            }

        }
        else{
            echo $sql2.mysqli_error($mysqli);
            exit();
		}
        
        */
            
        array_push($arr_eventos,$row[0]);
        array_push($arr_ids,$row[4]);
    }
    for($r=0;$r<=count($arr_eventos)-1;$r++){
        $egresos="0";
        $sql = "select sum(importe_total) from odc where Cancelada='no' and  evento='".$arr_eventos[$r]."'";
        if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
             $egresos=$row[0];
             array_push($arr_egresos,$egresos);
            }
        }
    }
    for($r=0;$r<=count($arr_eventos)-1;$r++){
        $ingresos="0";
        $sql = "select s.id_evento, sum(p.total) from solicitud_factura s, partidas p where s.id_solicitud=p.id_sol_factura and Estatus='Activa' and s.id_evento='".$arr_ids[$r]."' GROUP by s.id_evento";
        if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
             $ingresos=$row[1];
             
            }
        }
        array_push($arr_ingresos,$ingresos);
    }
    for($r=0;$r<=count($arr_egresos)-1;$r++){
        $utilidad=$arr_ingresos[$r]-$arr_egresos[$r];
       
        array_push($arr_utilidad,$utilidad);
    }

    for($r=0;$r<=count($arr_eventos)-1;$r++){
        if($arr_ingresos[$r]>0){
            $p=($arr_utilidad[$r]*100)/$arr_ingresos[$r];
            $porcentaje='<label class="label label-success">'.round($p,2).' % </label>';
        }
        else{
            $porcentaje='<label class="label label-danger">NA</label>';
        }
        array_push($arr_porcentaje,$porcentaje);
    }

    $result->close();
}
for($r=0;$r<=count($arr_eventos)-1;$r++){
    $class='class="label label-success"';
    if($arr_utilidad[$r]<=0){
        $class='class="label label-danger"';
    }
    $res=$res.'<tr><td><button id="'.$arr_ids[$r].'" class="btn btn-info ver_solicitudes">'.$arr_eventos[$r].'</button></td><td>'.$arr_nombres[$r].'</td><td>'.$arr_clientes[$r].'</td><td><h4><label class="label label-primary">'.asmoneda($arr_egresos[$r]).'</label></h4></td><td><h4><label class="label label-primary">'.asmoneda($arr_ingresos[$r]).'</label></h4></td><td><h4><label '.$class.'>'.asmoneda($arr_utilidad[$r]).'</label></h4></td><td><h4>'.$arr_porcentaje[$r].'</h4></td><td>'.$arr_ejecutivos[$r].'</td></tr>';
}
$res=$res.'</tbody>';
//echo json_encode($data);
echo $res;
$mysqli->close();

?>



