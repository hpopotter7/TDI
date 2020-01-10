<?php
set_time_limit(300);
$banco_tarjeta=$_POST["banco_tarjeta"];
include("conexion.php");



if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="select t.No_Tarjeta, u.Nombre from tarjetas t, usuarios u where t.usuario=u.id_usuarios and t.Tipo='".$banco_tarjeta."' order by No_Tarjeta asc";
$res="<table class='table'><thead><tr><th># tarjeta</th><th>Nombre</th><th>Saldo</th><th>Consultar</th></tr></thead><tbody>";
$array1= array();
$array2= array();

if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
        array_push($array1,$row[0]);
        array_push($array2,$row[1]);
    }
    $result->close();
}
else{
  $res =mysqli_error($mysqli);
}

for ($i=0; $i < count($array1) ; $i++) { 
    $suma=0;
    $array_suma= array();
    $sql="select sum(Importe), Tipo_movimiento from movimientos where No_Tarjeta='".$array1[$i]."' group by Tipo_movimiento ORDER by Tipo_movimiento asc";
      $res="";
    if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_row()) {
        array_push($array_suma,$row[0]);
        }
        $result->close();
    }
    else{
      $res =mysqli_error($mysqli);
    }
    for ($i=0; $i < count($array_suma) ; $i++) { 
      $suma=$array_suma[0]-$array_suma[0];
    }
    $res=$res."<tr><td>".$array1[$i]."</td><td>".$array2[$i]." </td><td><i>".moneda($suma)."</i></td><td>
    <select class='form-control operaciones_tarjeta'>
    <option value='vacio'>Selecciona...</option>
    <option value='movimientos_".$array1[$i]."'>Ver Movimientos</option>
    <option value='cargos_".$array1[$i]."'>Cargos</option>
    <option value='devoluciones_".$array1[$i]."'>Devoluciones</option>
    </select></td></tr><tr><td style='background-color:#cbe0e0f5;display:none;padding: 1px;' colspan='4' class='".$array1[$i]." filas_ocultas'></td></tr>";
           
}
    
$res=$res."</tbody></table>";
echo $res;

$mysqli->close();


function moneda($value) {
  return '$' . number_format($value, 2);
}

?>