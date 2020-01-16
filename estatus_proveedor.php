<?php 
$prov=$_POST["prov"];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query("SELECT estatus FROM proveedores where Razon_Social='".$prov."'")) {
    while ($row = $result->fetch_row()) {
        echo $row[0];
    }
    $result->close();
}
$mysqli->close();
?>