<?php
$nombre=$_GET["nombre"];

//$alan=$_POST["alan"];
include("conexion.php");

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
    exit();
}
$respuesta= "<select class='form-control'>";
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select t.id_tarjeta, u.Nombre, t.No_tarjeta, t.Tipo from tarjetas t, usuarios u where t.Usuario=u.id_usuarios and t.tipo like '%BBVA BANCOMER%' and t.Estatus='A'";

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
     //$return=$return.$row[0]."##";
     $respuesta = $respuesta."<option value='".$row[0]."'>".$row[1]." [".$row[3]."] - ".$row[2]."</option>";
}
	$respuesta=$respuesta."</select>";
    $result->close();
}
else{
  $respuesta =mysqli_error($mysqli);
}

echo $respuesta;

$mysqli->close();

?>
