<?php 
$id_cliente=$_POST['id_cliente'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$res=25;
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="Select Dias_credito from clientes where id_cliente=".$id_cliente;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res=$row[0];
    }
    $result->close();
}
    else{
        echo $sql.mysqli_error($mysqli);
    }
echo $res;
$mysqli->close();
?>