<?php 
$valor=$_POST['valor'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$res="pasa";

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT DATE_ADD(DATE_FORMAT(Fin_evento, '%Y-%m-%d'), INTERVAL 30 DAY), cliente, NOW() FROM eventos where id_evento=".$valor;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $fecha_fin=$row[0];
        $cliente=$row[1];
        $hoy=$row[2];
    }
    $result->close();
}


if($cliente!="GASTO"){
    if($fecha_fin<$hoy){
        $res="vencido".$fecha_fin;
    }
}

echo $res;

$mysqli->close();
?>