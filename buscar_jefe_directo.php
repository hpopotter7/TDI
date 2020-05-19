<?php 

$solicita=$_POST['solicita'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Jefe_directo FROM usuarios where Nombre='".$solicita."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res=$row[0];
    }
    $result->close();
}
echo $res;

$mysqli->close();
?>