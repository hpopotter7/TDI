<?php 
$rfc=$_POST['rfc'];
$tipo=$_POST['tipo'];
include("conexion.php");
$resultado="no";
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select Estatus from proveedores where rfc='".$rfc."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
    	$resultado=$row[0];
    }
    $result->close();
}



if($resultado=="bloqueado"){
    echo $resultado;
    $mysqli->close();
    exit();
}
else{
    if($tipo=="clientes"){
        $sql="SELECT RFC, Razon_Social from clientes where rfc='".$rfc."' and Estatus='activo'";
        }
        else{
            $sql="SELECT RFC, Razon_Social from proveedores where rfc='".$rfc."' and Estatus='activo'";
        }
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                $resultado="ya existe#".$row[1];
            }
            $result->close();
        }
        echo $resultado;
        $mysqli->close();
}
?>