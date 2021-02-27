<?php 
$prov=$_POST["prov"];
$tipo=$_POST["tipo"];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT estatus FROM proveedores where Razon_Social='".$prov."'";
if($tipo=="clientes"){
    $sql="SELECT estatus FROM clientes where Razon_Social='".$prov."'";
}
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        echo $row[0];
    }
    $result->close();
}
$mysqli->close();
?>