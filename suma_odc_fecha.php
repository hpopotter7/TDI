<?php 
$anio=$_POST['anio'];
$mes=$_POST['mes'];
$dia=$_POST['dia'];
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

$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select sum(importe_total) from odc where fecha_pago>='".$anio."-".$mes."-01' and fecha_pago<'".$anio."-".$mes."-".$dia."'";


   


if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res1=$row[0];
    }
}
else{
    $resultado= "Error: ".mysqli_error($mysqli);
}

$sql="select sum(importe_total) from odc where fecha_pago>='".$anio."-".$mes."-".$dia."' and fecha_pago<='".$ultimo."'";

if($mes<$mes_actual){
    $sql="select sum(importe_total) from odc where fecha_pago>='".$anio."-".$mes."-".$dia."' and fecha_pago<'".$ultimo."'";
}
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res2=$row[0];
    }
}
else{
    $resultado= "Error: ".mysqli_error($mysqli);
}
$resultado="<strong>Suma vencidos: ".moneda($res1)."</strong>";
$resultado=$resultado."#<strong>"."Suma vigentes: ".moneda($res2)."</strong>";
echo $resultado;
$mysqli->close();
?>