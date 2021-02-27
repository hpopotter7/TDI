<?php
$id_sol_factura=$_POST['id_sol_factura'];
include("conexion.php");
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
    exit();
}
$res="";
$num_partidas=0;
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select id_partida, Descripcion, total from partidas where id_sol_factura=".$id_sol_factura;
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
      $num_partidas++;
     $res=$res.'<div class="form-check">
     <input class="form-check-input check_partida" name="options[]" type="checkbox" value="'.$row[0].'">
     <label class="form-check-label">'.$row[1].' [ $'.number_format($row[2], 2).' ]</label></div>';
}
    $result->close();
}
else{
  $return =mysqli_error($mysqli);
}
if($num_partidas==1){
  echo "Solo existe una partida";
}
else{
  echo $res.'<input id="num_partidas" type="hidden" value="'.$num_partidas.'">';
}

$mysqli->close();

?>