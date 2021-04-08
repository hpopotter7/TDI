<?php
include("conexion.php");
if (mysqli_connect_errno()) {
printf("Error de conexion: %s\n", mysqli_connect_error());
exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$respuesta="";
$sql="SELECT DATE_FORMAT(fecha_ingreso, '%d') as dia, DATE_FORMAT(fecha_ingreso, '%m') as mes, DATE_FORMAT(fecha_ingreso, '%Y') as anio from usuarios where id_usuarios='".$_COOKIE['id']."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
    $dia=$row['dia'];
    $mes=$row['mes'];
    $anio=$row['anio'];
    }
    $result->close();
}

$anio_actual=date("Y");
$fecha1=$anio_actual."-".$mes."-".$dia;
$fecha2=($anio_actual+1)."-".$mes."-".$dia;

$sql="SELECT sum(dias) from vacaciones where Fecha_inicio>='".$fecha1."' and Fecha_inicio<='".$fecha2."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
    $suma_dias=$row[0];
    }
    $result->close();
}
echo $suma_dias;
$mysqli->close();
?>   