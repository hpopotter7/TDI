<?php 
date_default_timezone_set ("America/Mexico_City");
/*$anio=$_POST['anio'];
$mes=$_POST['mes'];
$dia=$_POST['dia'];*/
$anio=date("Y");
$mes=date("m");
$dia=date("d");
$mes_actual=date('m');


if($mes==12){
    $mes1=1;
    $mes2=2;
    $mes3=3;
}
if($mes==11){
    $mes1=12;
    $mes2=1;
    $mes3=2;
}
if($mes==10){
    $mes1=11;
    $mes2=12;
    $mes3=1;
}
if($mes<10){
    $mes1=$mes+1;
    $mes2=$mes+2;
    $mes3=$mes+3;
}



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
  $ultimo1=$anio."-".$mes1."-".$dia;
   $ultimo2=$anio."-".$mes2."-".$dia;
   $ultimo3=$anio."-".$mes3."-".$dia;
  $fecha1=date("Y-m-t", strtotime($ultimo1));
  $fecha2=date("Y-m-t", strtotime($ultimo2));
  $fecha3=date("Y-m-t", strtotime($ultimo3));


  function ver_mes($INT_MES){
    $MES1="";
  switch ($INT_MES) {
      case 1: $MES1 = 'Enero';break;
      case 2: $MES1 = 'Febrero';break;
      case 3: $MES1 = 'Marzo';break;
      case 4: $MES1 = 'Abril';break;
      case 5: $MES1 = 'Mayo';break;
      case 6: $MES1 = 'Junio';break;
      case 7: $MES1 = 'Julio';break;
      case 8: $MES1 = 'Agosto';break;
      case 9: $MES1 = 'Septiembre';break;
      case 10: $MES1 = 'Octubre';break;
      case 11: $MES1 = 'Noviembre';break;
      case 12: $MES1 = 'Diciembre';break;
      default: $MES1="X";
    }
    return $MES1;
}

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

$sql_mes1="select sum(importe_total) from odc where fecha_pago>'".substr($fecha1, 0, -3)."-01' and fecha_pago<='".$fecha1."' and pagado='no' and cancelada='no'";
if ($result = $mysqli->query($sql_mes1)) {
    while ($row = $result->fetch_row()) {
        $res_mes1=$row[0];
    }
}
else{
    $res1= "Error: ".mysqli_error($mysqli);
}

$sql_mes2="select sum(importe_total) from odc where fecha_pago>'".substr($fecha2, 0, -3)."-01' and fecha_pago<='".$fecha2."' and pagado='no' and cancelada='no'";
if ($result = $mysqli->query($sql_mes2)) {
    while ($row = $result->fetch_row()) {
        $res_mes2=$row[0];
    }
}
else{
    $res2= "Error: ".mysqli_error($mysqli);
}

$sql_mes3="select sum(importe_total) from odc where fecha_pago>'".substr($fecha3, 0, -3)."-01' and fecha_pago<='".$fecha3."' and pagado='no' and cancelada='no'";
if ($result = $mysqli->query($sql_mes3)) {
    while ($row = $result->fetch_row()) {
        $res_mes3=$row[0];
    }
}
else{
    $res3= "Error: ".mysqli_error($mysqli);
}

$total_azules=$res2+$res_mes1+$res_mes2+$res_mes3;

$resultado="<strong>Pagos atrasados: ".moneda($res0)."</strong>";
$resultado=$resultado."#<strong>Pagos vencidos (".ver_mes($mes)."): ".moneda($res1)."</strong>";
$resultado=$resultado."#<strong>Pagos vigentes (".ver_mes($mes)."): ".moneda($res2)."</strong>";
$resultado=$resultado."#<strong>Pagos vencida (TOTAL): ".moneda($res0+$res1)."</strong>";
$resultado=$resultado."#<strong>Pagos por vencer (".ver_mes($mes1)."): ".moneda($res_mes1)."</strong>";
$resultado=$resultado."#<strong>Pagos por vencer (".ver_mes($mes2)."): ".moneda($res_mes2)."</strong>";
$resultado=$resultado."#<strong>Pagos por vencer (Restante): ".moneda($res_mes3)."</strong>";
$resultado=$resultado."#<strong>Pagos por vencer (TOTAL): ".moneda($total_azules)."</strong>";
echo $resultado;
$mysqli->close();
?>