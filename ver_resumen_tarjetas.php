<?php
$banco_tarjeta=$_POST["banco_tarjeta"];
include("conexion.php");
function moneda($value) {
  return '$' . number_format($value, 2);
}

if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
  $sql="SELECT t.no_tarjeta, u.Nombre FROM tarjetas t, usuarios u WHERE t.usuario=u.id_usuarios and t.tipo='".$banco_tarjeta."' order by t.no_tarjeta asc";
$res="<table class='table table-sm'><thead style='background-color: rgba(155,175,55,.9) !important;'><tr><th># tarjeta</th><th>Nombre</th><th>Saldo</th><th>Consultar</th></tr></thead><tbody>";
$array1=array();
$array2=array();
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

$array3=array();
$array_tipomov=array();
for ($i=0; $i < count($array1) ; $i++) { 
   
    $suma_movs=0;
    $tipo_mov="";
    $sql="SELECT Importe, Fecha_Afectacion from movimientos where tipo_movimiento='CARGO' and no_tarjeta='".$array1[$i]."' ";
    if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_row()) {
        $suma_movs=$suma_movs+$row[0];
        if($row[1]==null || $row[1]==""){
          $tipo_mov="pendiente";
        }
        else{
          $tipo_mov="aprobado";
        }
      }
        $result->close();
    }
        
        array_push($array3,$suma_movs);
        array_push($array_tipomov,$tipo_mov);
}
$array4=array();
for ($i=0; $i < count($array1) ; $i++) { 
  $suma_movs=0;
  $sql="SELECT Importe from movimientos where tipo_movimiento='GASTO' and no_tarjeta='".$array1[$i]."' ";
  if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
      $suma_movs=$suma_movs+$row[0];
      }
     
      $result->close();
  }
  array_push($array4,$suma_movs);
}



for ($i=0; $i < count($array3) ; $i++) { 
  $badge="";
  if($array_tipomov[$i]=="pendiente"){
    $badge=" <i data-toggle='tooltip' data-placement='top' title='Acciones pendientes por aplicar'  class='fas fa-exclamation-circle' aria-hidden='true' style='color:rgba(230,115,6,1)'></i>";
  }
  
  $saldo=moneda($array3[$i]-$array4[$i]);

    $res=$res."<tr><td>".$array1[$i]."</td><td>".$array2[$i]." </td><td style='text-align:center'><strong>".$saldo.$badge."</strong></td><td><select class='selectpicker' id='c_banco_tarjetas3'>
    <option value=''>Selecciona...</option>
    <option>BBVA</option>
    <option>DILIGO</option>
    <option>SODEXO</option>
    </select><select class='selectpicker operaciones_tarjeta'>
    <option value='vacio'>Selecciona...</option>
    <option value='movimientos_".$array1[$i]."'>Ver Movimientos</option>
    <option value='cargos_".$array1[$i]."'>Abono a tarjeta</option>
    <option value='devoluciones_".$array1[$i]."'>Devoluciones</option>
    </select></td></tr><tr><td style='background-color:rgba(240,224,238,.7);display:none;padding: 1px;' colspan='4' class='".$array1[$i]." filas_ocultas'></td></tr>";
}

    
$res=$res."</tbody></table>";
echo $res;

$mysqli->close();

?>