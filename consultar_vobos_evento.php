<?php 
 $numero_evento=$_POST['numero_evento'];
 $check_todos=$_POST['check_todos'];
 $usuario=$_COOKIE['user'];
 
 
 $EVENTO="";
  function moneda($value) {
    return '$' . number_format($value, 2);
  }

include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$ODC="";
$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select odc from cache_por_atender where user='".$usuario."'";
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
    $ODC=$row[0];
  }
}
else{
  $resultado= mysqli_error($mysqli)."--".$sql;
}
/*
echo $numero_evento;
exit();
*/


$sql2="";
$cheks="and (o.vobo_finanzas='1' and o.vobo_compras='1' and o.vobo_direccion='1' and o.vobo_project='1' and o.vobo_coordinador='1'";

if($ODC!=""){
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra as user, o.finanzas, o.autorizo, o.compras, o.coordinador, o.project, o.usuario_registra, o.vobo_solicito, o.evento, e.Nombre_evento, e.Cliente, DATE_FORMAT(o.Fecha_hora_registro, '%d/%m/%y %H:%m') as fecha FROM odc o left join eventos e on o.evento=e.Numero_evento where o.id_odc='".$ODC."'";
  $sql2="delete from cache_por_atender where odc='".$ODC."'";
}
else if($numero_evento!="0"){
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra as user, o.finanzas, o.autorizo, o.compras, o.coordinador, o.project, o.usuario_registra, o.vobo_solicito, o.evento, e.Nombre_evento, DATE_FORMAT(o.Fecha_hora_registro, '%d/%m/%y %H:%m') as fecha, e.Cliente FROM odc o, eventos e where o.evento=e.Numero_evento and o.Cancelada='no' and (o.evento like '2019-%' or o.evento like '2020-%') and (o.usuario_registra='".$usuario."' or o.solicito='".$usuario."' or o.finanzas='".$usuario."' or o.autorizo='".$usuario."' or o.compras='".$usuario."' or o.project='".$usuario."' or o.coordinador='".$usuario."') and o.evento='".$numero_evento."' and o.Fecha_hora_registro>='2020-03-14' order by o.evento asc, o.id_odc desc";
}
else{
    $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra as user, o.finanzas, o.autorizo, o.compras, o.coordinador, o.project, o.usuario_registra, o.vobo_solicito, o.evento, e.Nombre_evento, DATE_FORMAT(o.Fecha_hora_registro, '%d/%m/%y %H:%m') as fecha, e.Cliente FROM odc o, eventos e where o.evento=e.Numero_evento and o.Cancelada='no' and (o.evento like '2019-%' or o.evento like '2020-%') and (o.usuario_registra='".$usuario."' or o.solicito='".$usuario."' or o.finanzas='".$usuario."' or o.autorizo='".$usuario."' or o.compras='".$usuario."' or o.project='".$usuario."' or o.coordinador='".$usuario."') and o.Fecha_hora_registro>='2020-03-14' and (vobo_finanzas=0 or vobo_compras=0 or vobo_direccion=0 or vobo_project=0 or vobo_coordinador=0) order by e.id_evento desc ,o.id_odc desc ";
  
}

//elaboro, solicito, ejecutivo, coordinador, compras, director, finanzas
$resultado='<table class="table table-inverse" style="width:99%">';
if ($result = $mysqli->query($sql)) {
     
  	$contador=1;
    $disabled="";
    $tit="";
    $TITULO="";
    $suma_solicitudes=0;
    $monto_factura=0;
    while ($row = $result->fetch_assoc()) {
      //$contador++;
      
      $id_odc=$row['id_odc'];
      $a_nombre=$row['a_nombre'];
      $concepto=$row['concepto'];
      $cheque_por=$row['cheque_por'];
      $solicito=$row['solicito'];
      $usuario_registra=$row['usuario_registra'];
      $vobo_finanzas=$row['vobo_finanzas'];
      $vobo_direccion=$row['vobo_direccion'];
      $vobo_compras=$row['vobo_compras'];
      $vobo_project=$row['vobo_project'];
      $vobo_coordinador=$row['vobo_coordinador']; 
      $vobo_solicito=$row['vobo_solicito']; 
      $finanzas=$row['finanzas'];      
      $director=$row['autorizo'];      
      $compras=$row['compras'];   
      $project=$row['project'];   
      $coordinador=$row['coordinador'];
      $registro=$row['user'];
      $evento=$row['evento'];
      $nombre_evento=$row['Nombre_evento'];
      $fecha=$row['fecha'];
      $cliente=$row['Cliente'];
      $importe="<td>".moneda($cheque_por)."</td>";
      $Factura="";      
/*
      $arr=explode("&",$CLIENTE);
      for($r=1;$r<=count($arr)-1;$r++){
        $cliente=$cliente.$arr[$r]."&";
      }
      $cliente=substr($cliente, 0, (strlen($cliente)-1));
*/
      $NOMBRE_EVENTO_COMPLETO=$evento."  [<i>".$cliente."</i> - ".$nombre_evento."]";
        
    
      if($vobo_solicito=="1" && $vobo_project=="1" && $vobo_coordinador=="1" && $vobo_compras=="1" && $vobo_direccion=="1" && $vobo_finanzas=="1"){
        $EVENTO="";
      }
      else{
        $SOLICITO=str_replace(" ", '<p>', $solicito);
      if($vobo_solicito=="1"){
        if($solicito==$usuario){
          $check_solicita="<center><div class='alert alert-info' role='alert'><b>".$SOLICITO."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed' title='SOLICITA: ".$solicito."'></center>";
        }
        else{
          $check_solicita="<center><div class='alert alert-info' role='alert'><b>".$SOLICITO."</b></div></center><center><i class='fa fa-check-square-o' title='SOLICITA:".$solicito."'></center>";
        } 
      }
      else{
        if($solicito==$usuario || $solicito=="PA ".$usuario ){
          $check_solicita="<center><div class='alert alert-info' role='alert'><b>".$SOLICITO."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."' title='SOLICITA: ".$solicito."'></center>";
        }
        else{
          $check_solicita="<center><div class='alert alert-info' role='alert'><b>".$SOLICITO."</b></div></center><center><i class='fa fa-square-o' title='SOLICITA: ".$solicito."'></center>";
        }
      }

      //solicito

      if($vobo_project=="1"){
        if($project==$usuario){
          $check_ejecutivo="<center><div class='alert alert-info' role='alert'><b>".$project."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_project#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed' title='EJECUTIVO: ".$project."'></center>";
        }
        else{
          $check_ejecutivo="<center><div class='alert alert-info' role='alert'><b>".$project."</b></div></center><center><i class='fa fa-check-square-o' title='EJECUTIVO: ".$project."'></center>";
        } 
      }
      else{
        if($project==$usuario ||$project=="PA ".$usuario){
          if($vobo_solicito=="1"){
            $check_ejecutivo="<center><div class='alert alert-info' role='alert'><b>".$project."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_project#".$id_odc."' title='EJECUTIVO: ".$project."'></center>";
          }
          else{
            $check_ejecutivo="<center><div class='alert alert-info' role='alert'><b>".$project."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes disabled' value='vobo_project#".$id_odc."' disabled='disabled' style='cursor:not-allowed' title='EJECUTIVO: ".$project."'></center>";
          }
        }
        else{
          $check_ejecutivo="<center><div class='alert alert-info' role='alert'><b>".$project."</b></div></center><center><i class='fa fa-square-o' title='EJECUTIVO: ".$project."'></center>";
        }
      }

      //ejecutivo


      if($vobo_coordinador=="1"){
        if($coordinador==$usuario){
          $check_coordinador="<center><div class='alert alert-info' role='alert'><b>".$coordinador."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_coordinador#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed' title='DIR DE ÁREA: ".$coordinador."'></center>";
        }
        else{
          $check_coordinador="<center><div class='alert alert-info' role='alert'><b>".$coordinador."</b></div></center><center><i class='fa fa-check-square-o' title='DIR DE ÁREA: ".$coordinador."'></center>";
        } 
      }
      else{
        if($coordinador==$usuario || $coordinador=="PA ".$usuario){
          if($vobo_solicito=="1" &&  $vobo_project=="1"){
           $check_coordinador="<center><div class='alert alert-info' role='alert'><b>".$coordinador."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_coordinador#".$id_odc."' title='DIR DE ÁREA: ".$coordinador."'></center>";
          }
          else{
            $check_coordinador="<center><div class='alert alert-info' role='alert'><b>".$coordinador."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes disabled' value='vobo_coordinador#".$id_odc."' disabled='disabled' style='cursor:not-allowed' title='DIR DE ÁREA: ".$coordinador."'></center>";
          }
        }
        else{
          $check_coordinador="<center><div class='alert alert-info' role='alert'><b>".$coordinador."</b></div></center><center><i class='fa fa-square-o' title='DIR DE ÁREA: ".$coordinador."'></center>";
        }
      }

      //COORDINADOR

      if($vobo_compras=="1"){
        if($compras==$usuario){
          $check_compras="<center><div class='alert alert-info' role='alert'><b>".$compras."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_compras#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed' title='COMPRAS: ".$compras."'></center>";
        }
        else{
          $check_compras="<center><div class='alert alert-info' role='alert'><b>".$compras."</b></div></center><center><i class='fa fa-check-square-o' title='COMPRAS: ".$compras."'></center>";
        } 
      }
      else{
        if($compras==$usuario || $compras=="PA ".$usuario){
          if($vobo_solicito=="1" &&  $vobo_project=="1" && $vobo_coordinador=="1"){
            $check_compras="<center><div class='alert alert-info' role='alert'><b>".$compras."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_compras#".$id_odc."' title='COMPRAS: ".$compras."'></center>";
           }
           else{
           
            $check_compras="<center><div class='alert alert-info' role='alert'><b>".$compras."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes disabled' value='vobo_compras#".$id_odc."' disabled='disabled' style='cursor:not-allowed' title='COMPRAS: ".$compras."'></center>";
           }
        }
        else{
          $check_compras="<center><div class='alert alert-info' role='alert'><b>".$compras."</b></div></center><center><i class='fa fa-square-o' title='COMPRAS: ".$compras."'></center>";
        }
      }

      //DIRECCION


      if($vobo_direccion=="1"){
        $comodin=0;
        if($director==$usuario){
          $check_director="<center><div class='alert alert-info' role='alert'><b>".$director."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed' title='DIR GENERAL: ".$director."'></center>";
        }
        else{
          $check_director="<center><div class='alert alert-info' role='alert'><b>".$director."</b></div></center><center><i class='fa fa-check-square-o' title='DIR GENERAL: ".$director."'></center>";
        } 
      }
      else{
        if($director==$usuario || $director=="PA ".$usuario){
          if($vobo_solicito=="1" && $vobo_project=="1" && $vobo_coordinador=="1" && $vobo_compras=="1"){
            $check_director="<center><div class='alert alert-info' role='alert'><b>".$director."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_direccion#".$id_odc."' title='DIR GENERAL: ".$director."'></center>";
          }else{
            $check_director="<center><div class='alert alert-info' role='alert'><b>".$director."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes disabled' value='vobo_direccion#".$id_odc."' disabled='disabled' style='cursor:not-allowed' title='DIR GENERAL: ".$director."'></center>";
          }
          
        }
        else{
          $check_director="<center><div class='alert alert-info' role='alert'><b>".$director."</b></div></center><center><i class='fa fa-square-o' title='DIR GENERAL: ".$director."'></center>";
        }
      }   
      
      //direccion
      if($vobo_finanzas=="1"){
        if($finanzas==$usuario){
          $comodin=0;
          $check_finanzas="<center><div class='alert alert-info' role='alert'><b>".$finanzas."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_finanzas#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed' title='FINANZAS: ".$finanzas."'></center>";
        }
        else{
          $check_finanzas="<center><div class='alert alert-info' role='alert'><b>".$finanzas."</b></div></center><center><i class='fa fa-check-square-o' title='FINANZAS: ".$finanzas."'></center>";
        } 
      }
      else{
        if($finanzas==$usuario || $finanzas=="PA ".$usuario){
          if($vobo_solicito=="1" && $vobo_project=="1" && $vobo_coordinador=="1" && $vobo_compras=="1" && $vobo_direccion=="1"){
            $check_finanzas="<center><div class='alert alert-info' role='alert'><b>".$finanzas."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_finanzas#".$id_odc."' title='FINANZAS: ".$finanzas."'></center>";
          }
          else{
            $check_finanzas="<center><div class='alert alert-info' role='alert'><b>".$finanzas."</b></div></center><center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes disabled' value='vobo_finanzas#".$id_odc."' disabled='disabled' style='cursor:not-allowed' title='FINANZAS: ".$finanzas."'></center>";
          }
          
        }
        else{
          $check_finanzas="<center><div class='alert alert-info' role='alert'><b>".$finanzas."</b></div></center><center><i class='fa fa-square-o' title='FINANZAS: ".$finanzas."'></center>";
        }
      }

      $label_comprobante="<button id='".$clases."' class='btn btn-danger disabled' disabled='disabled'><i class='fa fa-ban' aria-hidden='true'></i></button>";

      $ruta = "comprobantes/".$evento;
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
            $clases=$clases."#".$evento."/".$array_nombre[$r];
          }
        }
        if($con>0){
          $label_comprobante="<label id='".$clases."' class='btn btn-success btn_ver_comprobante '><i class='fa fa-eye' aria-hidden='true'></i></label>";
        }
      }

      $label_utilidad="<button id='".$evento."' class='btn btn-warning btn_utilidad'><i class='fa fa-pie-chart' aria-hidden='true'></i></button>";
     // $label_utilidad="";
      $bandera_check="false";
      $comodin="";
      if($check_todos=="propios"){
        if($vobo_solicito==0){
          $comodin="solicito";
        }
        else if($vobo_project==0){
          $comodin="project";
        }
        else if($vobo_coordinador==0){
          $comodin="coordinador";
        }
        else if($vobo_compras==0){
          $comodin="compras";
        }
        else if($vobo_direccion==0){
          $comodin="direccion";
        }
        else if($vobo_finanzas==0){
          $comodin="finanzas";
        }
        switch($comodin){
          case "solicito":
            if($usuario==$solicito){
              $bandera_check="true";
            }
          break;
          case "project":
            if($usuario==$project){
              $bandera_check="true";
            }
          break;
          case "coordinador":
            if($usuario==$coordinador){
              $bandera_check="true";
            }
          break;
          case "compras":
            if($usuario==$compras){
              $bandera_check="true";
            }
          break;
          case "direccion":
            if($usuario==$director){
              $bandera_check="true";
            }
          break;
          case "finanzas":
            if($usuario==$finanzas){
              $bandera_check="true";
            }
          break;
        }
        
      }
      else{
        $bandera_check="true";
      }
      
      if($bandera_check=="true"){
       
        if($EVENTO==$row['Nombre_evento']){
          $linea="";
        }
        else{
          $linea="<thead><tr style='background-color:rgba(72,165,241,0.63)'><th colspan='16'>".$NOMBRE_EVENTO_COMPLETO."</th></tr><tr><th>#</th><th>Elaborado</th><th>Solicita</th><th>Proveedor</th><th>Concepto</th><th>Fecha Solicitud</th><th>Importe</th><th>Solicita</th><th>Ejecutivo</th><th>Director de Área</th><th>Compras</th><th>Dirección General</th><th>Finanzas</th><th colspan='3'>Ver</th></tr></thead>";
          $EVENTO=$row['Nombre_evento'];
        }

        
        $resultado=$resultado.$linea; //<td>".$evento."</td>
        
        $resultado=$resultado."<tr><td id='sol_".$id_odc."'>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td><td>".$fecha."</td>".$importe."</td><td>".$check_solicita."</td><td>".$check_ejecutivo."</td><td>".$check_coordinador."</td><td>".$check_compras."</td><td>".$check_director."</td><td>".$check_finanzas."</td><td class='td_boton'><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><button type='button' id='".$id_odc."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download' aria-hidden='true'></i></button></a></td><td>".$label_comprobante."</td><td>".$label_utilidad."</td> "; 
        $contador++;
      }
    }

  }
    $result->close();
    $resultado=$resultado."</table>";
}
else{
    $resultado= mysqli_error($mysqli)."--".$sql;
}

if($ODC!=""){
  if ($mysqli->query($sql2)) {
    $respuesta= "borrado";
  }
  else{
      $respuesta= $sql."<br>".mysqli_error($mysqli);
  }
}

$resultado=$resultado;

echo $resultado;


$mysqli->close();
?>