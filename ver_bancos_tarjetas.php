<?php
include("conexion.php");
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select DISTINCT(Tipo) from tarjetas order by Tipo asc";
$res="<option value='vacio'>Selecciona un banco..</option>";
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
     $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
}
    $result->close();
}
else{
  $return =mysqli_error($mysqli);
}
echo $res;

$mysqli->close();

?>