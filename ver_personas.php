<?php 

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Nombre FROM usuarios where Solicitante='X' order by Nombre";
if ($result = $mysqli->query($sql)) {
    $res='<option value="vacio">Solicitante...</option>';
    while ($row = $result->fetch_row()) {
        $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
    }
    $result->close();
}

echo $res;

$mysqli->close();
?>