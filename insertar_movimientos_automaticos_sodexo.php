<?php
include("conexion.php");

if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="SELECT id_odc,  No_tarjeta, cheque_por, fecha_hora_registro from odc o where Tipo_Tarjeta='TARJETA SODEXO' AND cancelada='no'";

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
    $res=$res."insert into movimientos(id_solicitud, No_Tarjeta, Importe, Tipo_movimiento, Comentarios, Fecha_Creacion) values(".$row[0].", '".$row[1]."', '".$row[2]."', 'CARGO', 'importacion masiva', '".$row[3]."');<p>";

        
    }
    $result->close();
}
else{
  $res =mysqli_error($mysqli);
}



echo $res;

$mysqli->close();

?>