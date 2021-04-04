<?php 
$evento="";
if(isset($_POST['evento'])){
  $evento=$_POST['evento'];
}
else if(isset($_GET['evento'])){
  $evento=$_GET['evento'];
}

$filtro="";
if(isset($_POST['filtro'])){
  $filtro=$_POST['filtro'];
}
$facturacion=0;
 $usuario=$_COOKIE['user'];
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

if($filtro=="todos" || $filtro==""){
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, e.Nombre_evento, o.Factura, o.pagado, o.comprobado, o.solicito, o.identificador, e.Facturacion, o.no_cheque, o.usuario_registra, o.Monto_devolucion, DATE_FORMAT(o.Fecha_devolucion, '%d-%m-%Y') as 'Fecha_dev', o.Motivo_devolucion, o.Banco_devolucion, o.Tipo_tarjeta, o.No_Tarjeta, o.Importe_total FROM odc o, eventos e where o.evento= e.Numero_evento and o.evento='".$num_evento."' and o.Cancelada='no' order by o.id_odc desc";
}

else if($filtro=="pagados"){
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, e.Nombre_evento, o.Factura, o.pagado, o.comprobado, o.solicito, o.identificador, e.Facturacion, o.no_cheque, o.usuario_registra, o.Monto_devolucion, DATE_FORMAT(o.Fecha_devolucion, '%d-%m-%Y') as 'Fecha_dev', o.Motivo_devolucion, o.Banco_devolucion, o.Tipo_tarjeta, o.No_Tarjeta, o.Importe_total FROM odc o, eventos e where o.evento= e.Numero_evento and o.evento='".$num_evento."' and o.pagado='no' and o.Cancelada='no' order by o.id_odc desc";
}

else if($filtro=="comprobados"){
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, e.Nombre_evento, o.Factura, o.pagado, o.comprobado, o.solicito, o.identificador, e.Facturacion, o.no_cheque, o.usuario_registra, o.Monto_devolucion, DATE_FORMAT(o.Fecha_devolucion, '%d-%m-%Y') as 'Fecha_dev', o.Motivo_devolucion, o.Banco_devolucion, o.Tipo_tarjeta, o.No_Tarjeta, o.Importe_total FROM odc o, eventos e where o.evento= e.Numero_evento and o.evento='".$num_evento."' and o.comprobado='no' and o.Cancelada='no' order by o.id_odc desc";
}


if ($result = $mysqli->query($sql)) {
     $resultado='<table id="tabla_resumen_solicitudes" class="table table-bordered" style="width:99%;left: -80px !important; "><thead style="background-color: rgba(155,175,55,.9) !important;"><tr><th>#</th><th>Elab</th>
     <th>Soli</th><th>Prov</th><th>Concepto</th><th>Importe</th><th>Dev</th><th>Total</th><th>Factura</th><th>Ver</th><th>Che</th><th>Pag</th><th>Comp</th><th>Tipo</th></tr></thead>';
    
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
        $Factura="";
      }
      $arr_factura=explode(',',$factura);
      for($i=0;$i<=count($arr_factura)-1;$i++){
        $Factura=$arr_factura[$i];
      }
      if($no_cheque==null || $no_cheque==""){
        $no_cheque="";
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

      $devolucion="";
      if($identificador=="SDV" || $identificador=="SDR"){
        if($comprobado=="no"){
          if($Monto_devolucion==null || $Monto_devolucion==0){
            $Monto_devolucion=0;
            $devolucion="";
          }
          else{
            $devolucion="<label id='".$row['id_odc']."_".$cheque_por."' name='".$Tipo_tarjeta."-".$No_Tarjeta."' title='Motivo: ".$Motivo_devolucion."'>-".moneda($Monto_devolucion)."</label>";
          }
        }
        else{
          if($Monto_devolucion==null || $Monto_devolucion==0){
            $Monto_devolucion=0;
            $devolucion="";
          }
          else{
            $devolucion="<label >-".moneda($Monto_devolucion)."</label>";
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

      $label_comprobante="NA";

      $ruta = "comprobantes/".$num_evento;
      
      $array= Array();
      $array_nombre= Array();
      //$contador=0;
      $clases="";
      if(is_dir($ruta)){     
        $myfiles = scandir($ruta);
      foreach($myfiles as $file){
        $nombre=explode("-",$file);
        array_push($array,$nombre[0]);
        array_push($array_nombre,$file);
      }
      $con=0;
      
        for($r=0;$r<=count($array)-1;$r++){
          if($array[$r]==$id_odc){
            $con++;
            $clases=$clases."#".$num_evento."/".$array_nombre[$r];
          }
        }
        if($con>0){
          $label_comprobante="<label id='".$clases."'><i class='fa fa-download' aria-hidden='true'></i></label>";
        }
      }
      
      if($valida=="CXP" && ($_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="ANGEL RIVERA") ){  // SI TIENE PERMISO DE CXP
        $resultado=$resultado."<tr style='background-color:#ffe'><td>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td>".$importe."<td>".$devolucion."</td><td>".moneda($total)."</td><td>".$Factura."</td><td><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><i class='fa fa-download' aria-hidden='true'></i></a></td>";
        if($identificador!="Pagado"){
          $resultado=$resultado."<td><label>".$no_cheque."</label></td>";
        }
        else{
           $resultado=$resultado."<td>NA</td>";
        }
      }
      else{
        $resultado=$resultado."<tr style='background-color:#ffe'><td>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td>".$importe."<td>".$devolucion."</td><td>".moneda($total)."</td><td>".$Factura."</td><td><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><i class='fa fa-download' aria-hidden='true'></i></a></td>";
        if($identificador!="Pagado"){
          $resultado=$resultado."<td>".$no_cheque."</td>";
        }
        else{
           $resultado=$resultado."<td>NA</td>";
        }
      }
        if($valida=="CXP" && ($_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="ANGEL RIVERA") ){  // SI TIENE PERMISO DE CXP
          if($pagado=="no"){
            //<center><input type='checkbox' class='check_pagado fa fa-2x' value='".$id_odc."'></center>
            $resultado=$resultado."<td><i class='far fa-square fa-2x' aria-hidden='true'></i></td>";
          }
          else if($pagado=="si"){
            $resultado=$resultado."<td><i class='far fa-check-square fa-2x' aria-hidden='true'></i></td>";
          }
        }
        else{  // si no tiene permiso solo se mostrara el icono
          if($pagado=="no"){
            $resultado=$resultado."<td><i class='far fa-square fa-2x' aria-hidden='true'></i></td>";
          }
          else if($pagado=="si"){
            $resultado=$resultado."<td><i class='far fa-check-square fa-2x' aria-hidden='true'></i></td>";
          }
        }
         
        if($valida=="CXP" && ($_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="ANGEL RIVERA")){
          if($comprobado=="no"){
          $resultado=$resultado."<td><i class='far fa-square fa-2x' aria-hidden='true'></i></td>";
          }
          else if($comprobado=="si"){
            $resultado=$resultado."<td><i class='far fa-check-square fa-2x' aria-hidden='true'></i></td>";
          }
        }
        else{
          if($comprobado=="no"){
            $resultado=$resultado."<td><i class='far fa-square fa-2x' aria-hidden='true'></i></td>";
          }
          else if($comprobado=="si"){
            $resultado=$resultado."<td><i class='far fa-check-square fa-2x' aria-hidden='true'></i></td>";
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

$resultado=$resultado."<div class='row'></div><div class='clearfix row'></div><p><br>";

echo $resultado;


$mysqli->close();
?>