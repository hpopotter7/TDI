<?php
$name=$_POST["name"];
$nombre=$_POST["phrase"];


//$alan=$_POST["alan"];
include("conexion.php");

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
    exit();
}


$array= array();
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select Numero_evento, Nombre_evento, cliente from eventos where tipo like '%".$name."%' and ";

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
     $numero_evento=$row[0];
     $nombre_evento=$row[1];
     $cliente=$row[2];
     $arr=explode("&", $cliente);
     for($r=1;$r<=count($arr);$r++){
        $cliente=$arr[$r];
     }
     $nombre_completo="[".$numero_evento."] ".$cliente." - ".$nombre_evento;
     $return = Array('name'=>$nombre_completo);
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