<?php 
 $numero_evento=$_POST['numero_evento'];
 $usuario=$_COOKIE['user'];
 $comodin_evento="";
function moneda($value) {
  return '$' . number_format($value, 2);
}

include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$sql="";
if($numero_evento!="0"){
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra, o.finanzas, o.autorizo, o.compras, o.coordinador, o.project, o.usuario_registra, o.vobo_solicito, o.evento FROM odc o where  o.Cancelada='no' and o.evento='".$numero_evento."' order by o.evento asc, o.id_odc desc";
}
else{
  $sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra, o.finanzas, o.autorizo, o.compras, o.coordinador, o.project, o.usuario_registra, o.vobo_solicito, o.evento FROM odc o where  o.Cancelada='no' and (usuario_registra='".$usuario."' or solicito='".$usuario."' or finanzas='".$usuario."' or autorizo='".$usuario."' or compras='".$usuario."' or project='".$usuario."' or coordinador='".$usuario."') order by o.evento asc, o.id_odc desc";
}

$result = $mysqli->query("SET NAMES 'utf8'"); 

if ($result = $mysqli->query($sql)) {
     $resultado='<table class="table table-inverse" style="width:99%"><thead><tr><th>#</th><th>Evento</th><th>Elaborado</th>
     <th>Solicita</th><th>Proveedor</th><th>Concepto</th><th>Importe</th><th>Solicita</th><th>Ejecutivo</th><th>Dirección</th><th>Compras</th><th>P.M.</th><th>Finanzas</th><th>Ver</th></tr></thead>';
  	$contador=0;
    $disabled="";
    $tit="";
    $TITULO="";
    $suma_solicitudes=0;
    $monto_factura=0;
    while ($row = $result->fetch_assoc()) {
      $contador++;
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
      $registro=$row['usuario_registra'];
      $evento=$row['evento'];
      $importe="<td>".moneda($cheque_por)."</td>";
      $Factura="";
      if($comodin_evento!=$evento){
        $linea="<thead><tr><th colspan='14'>".$evento."</th></tr></thead>";
        $comodin_evento=$evento;
      }
      else{
        $linea="";
      }
      if($vobo_solicito=="1"){
        if($solicito==$usuario){
          $check_solicita="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed'></center>";
        }
        else{
          $check_solicita="<center><i class='fa fa-check-square-o'></center>";
        } 
      }
      else{
        if($solicito==$usuario){
          $check_solicita="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."'></center>";
        }
        else{
          $check_solicita="<center><i class='fa fa-square-o'></center>";
        }
      }

      if($vobo_finanzas=="1"){
        if($finanzas==$usuario){
          $check1="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed'></center>";
        }
        else{
          $check1="<center><i class='fa fa-check-square-o'></center>";
        } 
      }
      else{
        if($finanzas==$usuario){
          $check1="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."'></center>";
        }
        else{
          $check1="<center><i class='fa fa-square-o'></center>";
        }
      }

      if($vobo_direccion=="1"){
        if($director==$usuario){
          $check2="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_solicito#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed'></center>";
        }
        else{
          $check2="<center><i class='fa fa-check-square-o'></center>";
        } 
      }
      else{
        if($director==$usuario){
          $check2="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_direccion#".$id_odc."'></center>";
        }
        else{
          $check2="<center><i class='fa fa-square-o'></center>";
        }
      }

      if($vobo_compras=="1"){
        if($compras==$usuario){
          $check3="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_compras#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed'></center>";
        }
        else{
          $check3="<center><i class='fa fa-check-square-o'></center>";
        } 
      }
      else{
        if($compras==$usuario){
          $check3="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_compras#".$id_odc."'></center>";
        }
        else{
          $check3="<center><i class='fa fa-square-o'></center>";
        }
      }

      if($vobo_project=="1"){
        if($project==$usuario){
          $check4="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_project#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed'></center>";
        }
        else{
          $check4="<center><i class='fa fa-check-square-o'></center>";
        } 
      }
      else{
        if($project==$usuario){
          $check4="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_project#".$id_odc."'></center>";
        }
        else{
          $check4="<center><i class='fa fa-square-o'></center>";
        }
      }
      
      if($vobo_coordinador=="1"){
        if($coordinador==$usuario){
          $check5="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_coordinador#".$id_odc."' checked disabled='disabled' class='disabled' style='cursor:not-allowed'></center>";
        }
        else{
          $check5="<center><i class='fa fa-check-square-o'></center>";
        } 
      }
      else{
        if($coordinador==$usuario){
          $check5="<center><input type='checkbox' class='fa fa-2x check_vobo_solicitudes' value='vobo_coordinador#".$id_odc."'></center>";
        }
        else{
          $check5="<center><i class='fa fa-square-o'></center>";
        }
      }
        $resultado=$resultado.$linea;
        $resultado=$resultado."<tr><td>".$contador."</td><td>".$evento."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td>".$importe."</td><td>".$check_solicita."</td><td>".$check5."</td><td>".$check2."</td><td>".$check3."</td><td>".$check4."</td><td>".$check5."</td><td class='td_boton'><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><button type='button' id='".$id_odc."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download' aria-hidden='true'></i></button></a></td> "; 

  }
    $result->close();
    $resultado=$resultado."</table>";
}
else{
    $resultado= mysqli_error($mysqli)."--".$sql;
}


$resultado=$resultado.$resultado2;

echo $resultado;


$mysqli->close();
?>