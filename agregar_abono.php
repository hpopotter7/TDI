<?php 
$tarjeta=$_POST["tarjeta"];
include("conexion.php");
if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
function moneda($value) {
  return '$' . number_format($value, 2);
}
function mes($mes){
  switch($mes){
      case 1:
          $mes="ENERO";
      break;
      case 2:
          $mes="FEBRERO";
      break;
      case 3:
          $mes="MARZO";
      break;
      case 4:
          $mes="ABRIL";
      break;
      case 5:
          $mes="MAYO";
      break;
      case 6:
          $mes="JUNIO";
      break;
      case 7:
          $mes="JULIO";
      break;
      case 8:
          $mes="AGOSTO";
      break;
      case 9:
          $mes="SEPTIEMBRE";
      break;
      case 10:
          $mes="OCTUBRE";
      break;
      case 11:
          $mes="NOVIEMBRE";
      break;
      case 12:
          $mes="DICIEMBRE";
      break;
  }
  return $mes;
}

$mes=0;
$res="<table class='table table-condensed' style='width:100%;'><thead style='background-color: #fcb831;color:white;width:100%;
'><tr><th>Fecha</th><th>Evento</th><th>Concepto</th><th>Importe solicitado</th><th>Importe abonar</th></tr></thead><tbody>";
$result = $mysqli->query("SET NAMES 'utf8'");


$sql="select concat('[',e.Numero_evento,'] ', e.Nombre_evento), m.importe, o.concepto, o.id_odc, DATE_FORMAT(o.fecha_solicitud,'%c') as mes, DATE_FORMAT(o.fecha_solicitud,'%d/%m/%Y') as fecha_solicitud from movimientos m join odc o on m.id_solicitud=o.id_odc join eventos e on o.evento=e.Numero_evento where m.No_tarjeta=".$tarjeta." and m.Fecha_Afectacion  is null and m.Tipo_Movimiento='CARGO'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {

      if($mes!=$row[4]){
        $mes=$row[4];
        $res=$res."<tr style='background-color:#01384e;color:white'><th colspan='5'>".mes($mes)."</th></tr>";
    }

        $evento=$row[0];
        $im_solicitado=$row[1];
        $concepto=$row[2];
        $id=$row[3];
        
        $fecha=$row[5];
        $res=$res."<tr>
        <td>".$fecha."</td>
        <td>".$evento."</td>
        <td>".$concepto."</td>
        <td>".moneda($im_solicitado)."</td>
        <td>
        <input type='number' class='form-control importe_".$id."' value='".$im_solicitado."' required style='display: inline;width: 50%;'/>
        <button id='importe_".$id."' class='btn btn-success btn-aplicar-cargo'>Aplicar</button>
        </td></tr>";
    }
    $result->close();
}
else{
    $res =mysqli_error($mysqli);
  }
  if($evento==""){
    $res="<div class='col-md-12'><h4><i>Esta tarjeta no tiene solicitudes pendientes por aplicar</i></h4></div>";
  }
  /*
  $res=$res."<tr>
  <td><input type='text' class='form-control'></td>
  <td>NA</td>
  <td><input type='number' class='form-control' value='".$im_solicitado."' style='display: inline;width: 80%;'/>
  <button class='btn btn-success'>Cargar</button>
  </td>
  */
  $res=$res."</tbody></table>";
echo $res;
$mysqli->close();
?>