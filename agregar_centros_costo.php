<?php 

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Nombre FROM centro_costos order by Nombre";
if ($result = $mysqli->query($sql)) {
    $res='<option value="vacio">=====  CENTROS DE COSTO  =====</option>';
    while ($row = $result->fetch_row()) {
        $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
    }
     $res=$res."<option value='#add'>Agregar nuevo centro de costo...</option>";
    $result->close();
}
echo $res;

$mysqli->close();
?>