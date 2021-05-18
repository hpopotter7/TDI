<?php 
$id_evento=$_POST['id_evento'];
include("conexion.php");
if (mysqli_connect_error()) {
    echo "Error de conexion: %s\n", mysqli_connect_error();
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="update eventos set Revisado='si' where id_evento=".$id_evento;
if ($mysqli->query($sql)) {
    $respuesta= "revisado";
}
else{
    $respuesta= "Error: ".mysqli_error($mysqli);
}
echo $respuesta;
$mysqli->close();
?>