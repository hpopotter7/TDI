<?php 
$id_evento=$_POST['id_evento'];
include("conexion.php");
if (mysqli_connect_error()) {
    echo "Error de conexion: %s\n", mysqli_connect_error();
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select Revisado from eventos where id_evento=".$id_evento;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
    $respuesta= $row[0];
    }
    $result->close();
}
else{
    $respuesta= "Error: ".mysqli_error($mysqli);
}
echo $respuesta;
$mysqli->close();
?>