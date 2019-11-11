<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$res="ninguno";
$cont=0;
$sql="SELECT Asunto from notificaciones where Visto='0'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res="";
        $cont++;
    }
    $result->close();
}
echo $res.$cont;
?>