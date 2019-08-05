<?php
function moneda($value) {

  return '$' . number_format($value, 2);

}

$tarjeta=$_POST['num_tarjeta'];
$resultado='<table class="table table-inverse" style="width:99%">
<thead>
<tr>
<th>#</th>
<th>Evento</th>
<th>Tipo</th>
<th>Solicitado</th>
<th>Fecha afectación</th>
<th>Imp. Real</th>
</tr>
</thead>';
$cont=0;
  include("conexion.php");
  if (mysqli_connect_errno()) {
      printf("Error de conexion: %s\n", mysqli_connect_error());
      exit();
  }
  $result = $mysqli->query("SET NAMES 'utf8'");
  $result2 = $mysqli->query("SET NAMES 'utf8'");
  //m.importe
  $sql="SELECT m.Tipo, o.cheque_por, m.Fecha_afectacion, m.id_solicitud, o.evento, e.Nombre_evento, e.Cliente, m.importe_real, m.id_mov from movimientos m, odc o, eventos e where m.id_solicitud=o.id_odc and o.evento=e.Numero_evento and m.No_Tarjeta='".$tarjeta."'";

  if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_row()) {
        $cont++;
        $tipo=$row[0];
        $importe=moneda($row[1]);
        $fecha_afectacion=$row[2];
        $num_evento=$row[4];
        $evento=$row[5];
        $cliente=$row[6];
        $imp_real=$row[7];
        $id_mov=$row[8];

        $arr_cliente=explode("&", $cliente);
        $id_cliente=$arr_cliente[0];
        $sql2="select Razon_Social from clientes where id_cliente=".$id_cliente;
        if ($result2 = $mysqli->query($sql2)) {
            while ($row2 = $result2->fetch_row()) {
              $CLIENTE=$row2[0];
            }
          }
          $result2->close();
        //$cliente=$arr_cliente[1];

          /*
        if($arr_cliente.length==1){
          $cliente=$arr_cliente[1];
        }
        else if($arr_cliente.length==3){
          $cliente=$arr_cliente[1]."&".$arr_cliente[2];
        }
        else if($arr_cliente.length==4){
          $cliente=$arr_cliente[1]."&".$arr_cliente[2]."&".$arr_cliente[3];
        }
*/
        if($fecha_afectacion==""){
          $fecha_afectacion="<center><button id='".$id_mov."' class='btn btn-info btn_cargo_tarjeta'><label><i>No registrado</i></label></button></center>";
        }
        if($tipo=="ABONO"){
          $cantidad='<h4><span class="label label-primary">'.$importe.'</span></h4>';
        }
        else{
          $cantidad='<h4><span class="label label-danger">'.$importe.'</span></h4>';
        }
        $evento="[".$num_evento."] ".$evento." - ".$CLIENTE;
        $resultado=$resultado.'
        <tbody>
          <tr>
          <td>'.$cont.'</td>
          <td>'.$evento.'</td>
          <td>'.$tipo.'</td>
          <td>'.$cantidad.'</td>
          <td>'.$fecha_afectacion.'</td>
          <td>'.moneda($imp_real).'</td>
          </tr>
        </tbody>';
      }
      if($cont==0){
        $resultado=$resultado."<tbody><tr><td colspan='6'><center>No hay registros para esta tarjeta</center></td></tr></tbody>";
      }
      $result->close();
  }
  else{
    $resultado= mysqli_error($mysqli)." -".$sql;
  }

$saldo=0;
  $sql="select sum(importe), tipo from movimientos where No_tarjeta='".$tarjeta."' group by Tipo";
  if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_row()) {
        $tipo=$row[1];
        if($tipo=="ABONO"){
          $suma_abono=$row[0];
        }
        else{
          $suma_devo=$row[0];
        }
      }
  }
  else{
    $resultado= mysqli_error($mysqli)." -".$sql;
  }
  $saldo=$suma_abono-$suma_devo;
$result->close();
  $footer="<tfoot><tr><th colspan='5' style='text-align: right;'>SALDO ACTUAL:</th><th colspan='1'><strong>".moneda($saldo)."</strong></th></tr></tfoot></table>";
  $resultado=$resultado.$footer;
  echo $resultado;
 ?>
