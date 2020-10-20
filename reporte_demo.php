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

$res="<table class='table'><thead><tr><th>Cliente</th><th>Importe total</th><th>Consultar</th></tr></thead><tbody>";

for ($i=0; $i < count($clientes) ; $i++) { 
 
    $res=$res."<tr><td>".$clientes[$i]." - ".$arrelgo_querys[$i]."</td><td>".moneda($arrelgo_totales[$i])."</td>
    <td><button id='".$clientes[$i]."' class='btn btn-info btn_detalle'>Ver detalle</td></tr>";
}

    
$res=$res."</tbody></table>";
echo $res;

$mysqli->close();

?>