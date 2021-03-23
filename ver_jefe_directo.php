<?php 
$id_usuario=$_POST['id_usuario'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT Jefe_directo FROM usuarios where id_usuarios='".$id_usuario."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $res=$row[0];
        }
        $result->close();
    }
echo $res;
$mysqli->close();
?>