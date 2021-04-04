<?php 
$tarjeta=$_POST["tarjeta"];
include("conexion.php");
$evento="";
if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
$res="<table class='table table-condensed'><thead style='background-color: #fcb831;color:white;
}'><tr><th>Evento</th><th>Concepto</th><th>Importe solicitado</th><th>Importe a devolver</th></tr></thead><tbody>";
$result = $mysqli->query("SET NAMES 'utf8'");
/*
$sql="select concat('[',e.Numero_evento,'] ', e.Nombre_evento), m.importe_solicitado, o.concepto, o.id_odc from movimientos m join odc o on m.id_solicitud=o.id_odc join eventos e on o.evento=e.Numero_evento where m.No_tarjeta=".$tarjeta." and m.Fecha_Afectacion  is null";
*/
$sql="select concat('[',e.Numero_evento,'] ', e.Nombre_evento), m.importe, o.concepto, o.id_odc from movimientos m join odc o on m.id_solicitud=o.id_odc join eventos e on o.evento=e.Numero_evento where m.No_tarjeta=".$tarjeta." and m.Fecha_Afectacion  is null and m.Tipo_Movimiento='DEVOLUCION'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $evento=$row[0];
        $im_solicitado=$row[1];
        $concepto=$row[2];
        $id=$row[3];
        $res=$res."<tr>
        <td>".$evento."</td>
        <td>".$concepto."</td>
        <td>".$im_solicitado."</td>
        <td>
        <input id='btn_importe_".$id."_".$tarjeta."' type='number' class='form-control importe_".$id."_".$tarjeta." txt_importe' value='".$im_solicitado."' required style='display: inline;width: 50%;'/>
        <button id='importe_".$id."_".$tarjeta."' name='".$im_solicitado."' class='btn btn-success btn-aplicar-devolucion'>Devolver</button>
        </td></tr>";
    }
    $result->close();
}
else{
    $res =mysqli_error($mysqli);
  }
  if($evento==""){
    $res="<div class='col-md-12'><h4><i>Esta tarjeta no tiene devoluciones pendientes por aplicar</i></h4></div>";
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