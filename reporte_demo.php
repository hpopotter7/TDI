<?php

include("conexion.php");
function moneda($value) {
  return '$' . number_format($value, 2);
}

if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select DISTINCT(e.cliente) from solicitud_factura s, eventos e 
  where s.id_evento=e.id_evento    
  and s.Estatus='Activa' and s.Estatus_Factura!='PAGADO' order by e.cliente asc";

$clientes=array();
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
      $cliente=$row[0];
      /*    
      $arr=explode('&',$row[0]);
      for($r=1;$r<=count($arr)-1;$r++){
        $cliente=$cliente.$arr[$r]." & ";
      }
      $cliente=substr($cliente,0,-3);
      */
        array_push($clientes,$cliente);
    }
    $result->close();
}
else{
  $res =mysqli_error($mysqli);
}


$arrelgo_totales=Array();
$arrelgo_querys=Array();
for($r=0;$r<=count($clientes)-1;$r++){
    $sql="select e.cliente, sum(p.total) from solicitud_factura s left join partidas p on s.id_solicitud=p.id_sol_factura INNER join eventos e on s.id_evento=e.id_evento and s.Estatus='Activa' and s.Estatus_Factura!='PAGADO' and e.cliente='".$clientes[$r]."' group by e.cliente";
    $total=-10;
    array_push($arrelgo_querys,$sql);
    if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $total=$row[1];        
        
        }
        $result->close();
        array_push($arrelgo_totales,$total);
    }
    else{
    echo mysqli_error($mysqli);
    exit();
    }
}

$res="<thead><tr><th>Cliente</th><th>Importe total</th><th>Consultar</th></tr></thead><tbody>";
$importe_total=0;
for ($i=0; $i < count($clientes) ; $i++) { 
 
    $res=$res."<tr id='tr_".$clientes[$i]."' class='tr'><td>".$clientes[$i]."</td><td>".moneda($arrelgo_totales[$i])."</td>
    <td><button id='".$clientes[$i]."' class='btn btn-info btn_detalle'>Ver detalle</td></tr>";
    $importe_total=$importe_total+$arrelgo_totales[$i];
}

    
$res=$res."</tbody><tfoot><tr style='background-color:rgba(181,197,114,1)'><th style='text-align:right'>IMPORTE TOTAL:</th><th><strong><h3><label class='label label-primary'>".moneda($importe_total)."</label></h3></strong></th><th></th></tr></tfoot>";
echo $res;

$mysqli->close();

?>