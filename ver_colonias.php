<?php
$nombre=$_GET["nombre"];
$cp=$_GET["cp"];

//$alan=$_POST["alan"];
include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$array= array();
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select DISTINCT(nombre) from codigos_postales where cp='".$cp."' and nombre like '%".$nombre."%'";

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
     //$return=$return.$row[0]."##";
     $return = Array('name'=>$row[0]);
     $array[]=$return;
}
    $result->close();
}
else{
    $return = Array('name'=>mysqli_error($mysqli));
     $array[]=$return;
}
echo json_encode($array);

$mysqli->close();

?>
