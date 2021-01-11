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
$sql0="select sum(importe_total) from odc where pagado='no' and fecha_pago<='".$ultimo_mes_anterior."' and cancelada='no'";

if ($result = $mysqli->query($sql0)) {
    while ($row = $result->fetch_row()) {
        $res0=$row[0];
    }
}
else{
    $res0= "Error: ".mysqli_error($mysqli);
}


$sql1="select sum(importe_total) from odc where fecha_pago>='".$anio."-".$mes."-01' and fecha_pago<='".$anio."-".$mes."-".$dia."' and pagado='no' and cancelada='no'";

if ($result = $mysqli->query($sql1)) {
    while ($row = $result->fetch_row()) {
        $res1=$row[0];
    }
}
else{
    $res1= "Error: ".mysqli_error($mysqli);
}


$sql="select sum(importe_total) from odc where fecha_pago>'".$anio."-".$mes."-".$dia."' and fecha_pago<='".$ultimo."' and pagado='no' and cancelada='no' ";

if($mes<$mes_actual){
    $sql="select sum(importe_total) from odc where fecha_pago>'".$anio."-".$mes."-".$dia."' and fecha_pago<='".$ultimo."' and pagado='no' and cancelada='no'";
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
echo $resultado;
$mysqli->close();
?>