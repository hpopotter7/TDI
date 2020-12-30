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

$result = $mysqli->query("SET NAMES 'utf8'");
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
$sql = "SELECT Numero_evento, Nombre_evento, Cliente, Ejecutivo, id_evento  FROM eventos where Estatus='PITCH' and (Ejecutivo like '%".$_COOKIE['user']."%') order by Numero_evento ";

if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="FERNANDA CARRERA" || $_COOKIE['user']=="ANDRES EMANUELLI" || $_COOKIE['user']=="ALAN SANDOVAL"){
    $sql = "SELECT Numero_evento, Nombre_evento, Cliente, Ejecutivo, id_evento  FROM eventos where Estatus='PITCH' order by Numero_evento ";
}

if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {
        $CLIENTE=$row[2];
        array_push($arr_clientes,$CLIENTE);
       
        $ARR_EJECUTIVO=explode(",",$row[3]);
        $EJE="<ul>";
        for($r=1;$r<=count($ARR_EJECUTIVO)-1;$r++){
            $EJE=$EJE."<li>".$ARR_EJECUTIVO[$r]."</li>";
        }
        $EJE=$EJE."</ul>";

        array_push($arr_ejecutivos,$EJE);
        array_push($arr_nombres,$row[1]);
       
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



