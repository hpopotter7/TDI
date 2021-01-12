<?php 
date_default_timezone_set ("America/Mexico_City");
/*$anio=$_POST['anio'];
$mes=$_POST['mes'];
$dia=$_POST['dia'];*/
$anio=date("Y");
$mes=date("m");
$dia=date("d");
$mes_actual=date('m');
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
function moneda($value) {
    return '$' . number_format($value, 2);
  }

  $a_date = $anio."-".$mes."-".$dia;
  $ultimo=date("Y-m-t", strtotime($a_date));
   if($mes=="0"){
    $mes_anterior="12";
   }
   else{
      $mes_anterior=$mes-1; 
   }
  
  $fecha_mes_anterior = $anio."-".$mes_anterior."-".$dia;
  $ultimo_mes_anterior=date("Y-m-t", strtotime($fecha_mes_anterior));


$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql0="select sum(p.importe_total) from solicitud_factura s, TOTAL_PARTIDAS_X_SOLCITUD p where s.id_solicitud=p.id_solicitud and s.Estatus='Activa' and s.Estatus_factura='POR COBRAR' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)<='".$ultimo_mes_anterior."'";

if ($result = $mysqli->query($sql0)) {
    while ($row = $result->fetch_row()) {
        $res0=$row[0];
    }
}
else{
    $res0= "Error: ".mysqli_error($mysqli);
}


$sql1="select sum(p.importe_total) from solicitud_factura s, TOTAL_PARTIDAS_X_SOLCITUD p where s.id_solicitud=p.id_solicitud and s.Estatus='Activa' and s.Estatus_factura='POR COBRAR' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)>='".$anio."-".$mes."-01' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)<='".$anio."-".$mes."-".$dia."'";

if ($result = $mysqli->query($sql1)) {
    while ($row = $result->fetch_row()) {
        $res1=$row[0];
    }
}
else{
    $res1= "Error: ".mysqli_error($mysqli);
}


$sql="select sum(importe_total) from odc where fecha_pago>'".$anio."-".$mes."-".$dia."' and fecha_pago<='".$ultimo."' and pagado='no' and cancelada='no' ";

$sql="select sum(p.importe_total) from solicitud_factura s, TOTAL_PARTIDAS_X_SOLCITUD p where s.id_solicitud=p.id_solicitud and s.Estatus='Activa' and s.Estatus_factura='POR COBRAR' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)>'".$anio."-".$mes."-".$dia."' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)<='".$ultimo."'";

if($mes<$mes_actual){
    $sql="select sum(p.importe_total) from solicitud_factura s, TOTAL_PARTIDAS_X_SOLCITUD p where s.id_solicitud=p.id_solicitud and s.Estatus='Activa' and s.Estatus_factura='POR COBRAR' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)>'".$anio."-".$mes."-".$dia."' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)<='".$ultimo."'";
}
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res2=$row[0];
    }
}
else{
    $res2= "Error: ".mysqli_error($mysqli);
}
$resultado="<strong>Suma atrasada: ".moneda($res0)."</strong>";
$resultado=$resultado."#<strong>Suma vencidos (mes actual): ".moneda($res1)."</strong>";
$resultado=$resultado."#<strong>Suma vigentes (mes actual): ".moneda($res2)."</strong>";
$resultado=$resultado."#<strong>Suma vencida (TOTAL): ".moneda($res0+$res1)."</strong>";
echo $resultado;
$mysqli->close();
?>