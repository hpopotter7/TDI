<?php 
 $evento=$_POST['evento'];
 $usuario=$_POST['usuario'];
 $tbody="";
 $total_facturas=0;
 setcookie("evento", "", time() - 3600);
function moneda($value) {
  return '$' . number_format($value, 2);
}

include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$valida="";
$suma_facturado=0;
$sql1="select CXP from usuarios where Nombre='".$usuario."'";
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql1)) {
  while ($row = $result->fetch_row()) {
    if($row[0]=='X'){
      $valida='CXP';
    }
  }
}

if(substr($evento,0,1)==="["){
    $arr=explode("]",$evento);
    $ID=str_replace("[", "", $arr[0]);
    $sql="select id_evento, Facturacion from eventos where Numero_evento='".$ID."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $evento=$row[0];
            $facturacion=$row[1];
        }
        $result->close();
    }
}

else{
  $sql="select id_evento, Facturacion from eventos where id_evento='".$evento."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $evento=$row[0];
            $facturacion=$row[1];
        }
        $result->close();
    }
}


$num_evento="";
$sql3="select Numero_evento from eventos where id_evento=".$evento;
if ($result = $mysqli->query($sql3)) {
  while ($row = $result->fetch_row()) {
      $num_evento=$row[0];    
  }
}

$sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, e.Nombre_evento, o.Factura, o.pagado, o.comprobado, o.solicito, o.identificador, e.Facturacion, o.no_cheque, o.usuario_registra, o.Monto_devolucion, DATE_FORMAT(o.Fecha_devolucion, '%d-%m-%Y') as 'Fecha_dev', o.Motivo_devolucion, o.Banco_devolucion, o.Tipo_tarjeta, o.No_Tarjeta, o.Importe_total FROM odc o, eventos e where o.evento= e.Numero_evento and o.evento='".$num_evento."' and o.Cancelada='no' order by o.id_odc desc";


if ($result = $mysqli->query($sql)) {
     $resultado='<table id="tabla_resumen_solicitudes" class="table table-inverse" style="width:99%;left: -80px !important;"><thead><tr><th>#</th><th>Elaborado</th>
     <th>Solicita</th><th>Proveedor</th><th>Concepto</th><th>Importe</th><th>Dev</th><th>Total</th><th>Factura</th><th>Ver</th><th>Cheque</th><th>Pag</th><th>Comp</th><th>Tipo</th></tr></thead>';
    
     $contador=0;
     $num=0;
    $disabled="";
    $tit="";
    $TITULO="";
    $suma_solicitudes=0;
    $monto_factura=0;
    while ($row = $result->fetch_assoc()) {
      $contador++;
      $num++;
      $a_nombre=$row['a_nombre'];
      $concepto=$row['concepto'];
      $cheque_por=$row['cheque_por'];
      $id_odc=$row['id_odc'];
      $Nombre_evento=$row['Nombre_evento'];
      $factura=$row['Factura'];
      $pagado=$row['pagado'];
      $comprobado=$row['comprobado'];
      $solicito=$row['solicito'];
      $identificador=$row['identificador'];
      $Facturacion=$row['Facturacion'];
      $no_cheque=$row['no_cheque'];
      $usuario_registra=$row['usuario_registra'];
      $Monto_devolucion=$row['Monto_devolucion'];
      $Fecha_dev=$row['Fecha_dev'];
      $Motivo_devolucion=$row['Motivo_devolucion'];
      $Banco_devolucion=$row['Banco_devolucion'];
      $Tipo_tarjeta=$row['Tipo_tarjeta'];
      $No_Tarjeta=$row['No_Tarjeta'];
      $importe_total=$row['Importe_total'];
      $suma_solicitudes=$suma_solicitudes+$importe_total;
      
      $importe="<td>".moneda($cheque_por)."</td>";
      $fuente='"Neuton';
      $Factura="";

      if($factura==null || $factura==""){
        $Factura="<i class='fa fa-plus'></i>";
      }
      $arr_factura=explode(',',$factura);
      for($i=0;$i<=count($arr_factura)-1;$i++){
        $Factura=$Factura."<pre style='color:white;border:none;background:rgba(0,0,0,0);padding: .5px;font-family: ".$fuente."'>".$arr_factura[$i]."</pre>";
      }
      if($no_cheque==null || $no_cheque==""){
        $no_cheque="<i class='fa fa-plus'></i>";
      }

      switch($identificador){
        case "Pago":
          $identificador="SDP";
        break;
        case "Viáticos":
          $identificador="SDV";
        break;
        case "Reembolso":
          $identificador="SDR";
        break;
      }

      $devolucion="NA";
      if($identificador=="SDV" || $identificador=="SDR"){
        if($comprobado=="no"){
          if($Monto_devolucion==null || $Monto_devolucion==0){
            $Monto_devolucion=0;
            $devolucion="<button type='button' id='".$row['id_odc']."_".$cheque_por."' name='".$Tipo_tarjeta."-".$No_Tarjeta."' class='btn btn-info btn_devolucion'><i class='fa fa-retweet'></i></button>";
          }
          else{
            $devolucion="<label id='".$row['id_odc']."_".$cheque_por."' class='btn btn-warning btn_devolucion' name='".$Tipo_tarjeta."-".$No_Tarjeta."' title='Motivo: ".$Motivo_devolucion."'>-".moneda($Monto_devolucion)."</label>";
          }
        }
        else{
          if($Monto_devolucion==null || $Monto_devolucion==0){
            $Monto_devolucion=0;
            $devolucion="<button type='button' id='".$row['id_odc']."_".$cheque_por."' name='".$Tipo_tarjeta."-".$No_Tarjeta."' class='btn btn-info disabled' disabled='disabled' title='Ya esta comprobada'><i class='fa fa-retweet'></i></button>";
          }
          else{
            $devolucion="<label class='btn btn-warning disabled' title='Ya esta comprobada'>-".moneda($Monto_devolucion)."</label>";
          }
        }
      }

      $total=$cheque_por-$Monto_devolucion;
      
      if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
        if($pagado=="si" || $comprobado=="si"){
          $contador=$num;
        }
        else{
          $contador=$num." <input type='checkbox' value='".$id_odc."' class='check_transfer'/>";
        }
      }

      $label_comprobante="<label id='".$id_odc."#".$num_evento."' class='btn btn-success btn_subir_comprobante'><i class='fa fa-upload' aria-hidden='true'></i></label>";

      $ruta = "comprobantes/".$num_evento;
      $myfiles = scandir($ruta);
      $array= Array();
      $array_nombre= Array();
      //$contador=0;
      $clases="";
      foreach($myfiles as $file){
        $nombre=explode("-",$file);
        array_push($array,$nombre[0]);
        array_push($array_nombre,$file);
      }
      $con=0;
      if(is_dir($ruta)){
        for($r=0;$r<=count($array)-1;$r++){
          if($array[$r]==$id_odc){
            $con++;
            $clases=$clases."#".$num_evento."/".$array_nombre[$r];
          }
        }
        if($con>0){
          $label_comprobante="<label id='".$clases."' class='btn btn-success btn_ver_comprobante '><i class='fa fa-eye' aria-hidden='true'></i></label><button id='".$clases."~".$id_odc."' class='btn btn-danger btn_eliminar_comprobante' style='margin-left:2px' ><i class='fa fa-trash' aria-hidden='true'></i></button>";
        }
      }
      
      if($valida=="CXP" && ($_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="ANGEL RIVERA") ){  // SI TIENE PERMISO DE CXP
        $resultado=$resultado."<tr><td>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td>".$importe."<td>".$devolucion."</td><td>".moneda($total)."</td><td class='td_boton'><label id='".$id_odc."' class='btn btn_verde btn_success btn_factura'>".$Factura."</label><p style='margin-top: 3px;'>".$label_comprobante."</td><td class='td_boton'><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><button type='button' id='".$id_odc."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download' aria-hidden='true'></i></button></a></td>";
        if($identificador!="Pagado"){
          $resultado=$resultado."<td class='td_boton'><label id='".$id_odc."' class='btn btn_verde btn_success btn_cheque'>".$no_cheque."</label></td>";
        }
        else{
           $resultado=$resultado."<td>NA</td>";
        }
      }
      else{
        $resultado=$resultado."<tr><td>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td>".$importe."<td>".$devolucion."</td><td>".moneda($total)."</td><td class='td_boton'><label class='btn btn-success' disabled='disabled'>".$Factura."</label><p style='margin-top: 3px;'>".$label_comprobante."</td><td class='td_boton'><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><button type='button' id='".$id_odc."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download' aria-hidden='true'></i></button></a></td>";
        if($identificador!="Pagado"){
          $resultado=$resultado."<td class='td_boton'><label class='btn btn-success' disabled='disabled'>".$no_cheque."</label></td>";
        }
        else{
           $resultado=$resultado."<td>NA</td>";
        }
      }
        if($valida=="CXP" && ($_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="ANGEL RIVERA") ){  // SI TIENE PERMISO DE CXP
          if($pagado=="no"){
            $resultado=$resultado."<td><center><input type='checkbox' class='check_pagado fa fa-2x' value='".$id_odc."'></center></td>";
          }
          else if($pagado=="si"){
            $resultado=$resultado."<td><center><input type='checkbox' class='check_pagado fa fa-2x' value='".$id_odc."' checked></center></td>";
          }
        }
        else{  // si no tiene permiso solo se mostrara el icono
          if($pagado=="no"){
            $resultado=$resultado."<td><center><i class='fa fa-square-o'></center></td>";
          }
          else if($pagado=="si"){
            $resultado=$resultado."<td><center><i class='fa fa-check-square-o'></i></center></td>";
          }
        }
         
        if($valida=="CXP" && ($_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="ANGEL RIVERA")){
          if($comprobado=="no"){
          $resultado=$resultado."<td><center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center></td>";
          }
          else if($comprobado=="si"){
            $resultado=$resultado."<td><center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' checked></center></td>";
          }
        }
        else{
          if($comprobado=="no"){
            $resultado=$resultado."<td><center><i class='fa fa-square-o'></center></td>";
          }
          else if($comprobado=="si"){
            $resultado=$resultado."<td><center><i class='fa fa-check-square-o'></i></center></td>";
          }
        }
          $resultado=$resultado."<td title='".$tit."'>".$identificador."</td>";
           $resultado=$resultado."</tr>";
      
  }
    $result->close();
    $resultado=$resultado."</table>";
}
else{
    $resultado= mysqli_error($mysqli)."--".$sql;
}

if($suma_solicitudes==0){
$resultado=$resultado."<div class='row'></div><div class='clearfix row'></div><p><br>";
}

include('tabla_facturacion_detalle_eventos.php');

$resultado=$resultado."<div class='row'></div><div class='clearfix row'></div><p><br>".$resultado2;

echo $resultado;


$mysqli->close();
?>