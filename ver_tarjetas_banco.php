<?php
$nombre=$_GET["nombre"];

//$alan=$_POST["alan"];
include("conexion.php");

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
    exit();
}
$array= array();
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select DISTINCT(tipo) from tarjetas where tipo like '%".$nombre."%'";

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
     //$return=$return.$row[0]."##";
     $return = Array('name'=>$row[0]);
     $array[]=$return;
}
    $result->close();
}
else{
  $return =mysqli_error($mysqli);
}
//$array[]=$return;
echo json_encode($array);

$mysqli->close();

?>
