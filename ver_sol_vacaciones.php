<?php 
$id=$_POST['id'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT DATE_FORMAT(Fecha_Inicio, '%d/%m/%Y') as Fecha_Inicio, DATE_FORMAT(Fecha_Fin, '%d/%m/%Y') as Fecha_Fin, Dias, DATE_FORMAT(Fecha_regreso, '%d/%m/%Y') as Fecha_regreso from vacaciones where id_vacaciones='".$id."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $return = Array('fecha_inicio'=>$row[0],
                        'fecha_fin'=>$row[1],
                        'dias'=>$row[2],
                        'fecha_regreso'=>$row[3],
                            );
    }
    $result->close();
}
echo json_encode($return);
$mysqli->close();
?>