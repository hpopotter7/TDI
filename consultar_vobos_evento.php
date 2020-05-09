<?php 
 $numero_evento=$_POST['numero_evento'];
 $usuario=$_COOKIE['user'];

function moneda($value) {
  return '$' . number_format($value, 2);
}

include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$resultado="";

$sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra, o.finanzas, o.autorizo, o.project, o.coordinador, o.compras FROM odc o where o.evento='".$numero_evento."' and o.Cancelada='no' order by o.id_odc desc";
$result = $mysqli->query("SET NAMES 'utf8'"); 

if ($result = $mysqli->query($sql)) {
     $resultado='';
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
      $compras=$row['compras'];
      $finanzas=$row['finanzas'];
      $autorizo=$row['autorizo'];
      $coordinador=$row['coordinador'];
      $project=$row['project'];
      $importe=moneda($cheque_por);
      $fuente='"Neuton';
      $Factura="";

      $check1="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check2="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check3="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check4="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check5="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
     
     
        $resultado=$resultado."<tr><td>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td><td>".$importe."</td>";

        if($finanzas==$usuario){
          if($vobo_finanzas==1){
            $check1="<center><input type='checkbox' class='check_finanzas fa fa-2x' value='".$id_odc."' checked></center>";
          }
          else{
            $check1="<center><input type='checkbox' class='check_finanzas fa fa-2x' value='".$id_odc."' ></center>";
          }
        }
        else{ // si no solo se mostrara el icono
          if($vobo_finanzas==1){
            $check1="<center><i class='fa fa-check-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$finanzas."'></center>";
          }
          else{
            $check1="<center><i class='fa fa-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$finanzas."'></center>";
          }
        }

        //direccion
        if($autorizo==$usuario){
          if($vobo_direccion==1){
            $check2="<center><input type='checkbox' class='check_direccion fa fa-2x' value='".$id_odc."' checked></center>";
          }
          else{
            $check2="<center><input type='checkbox' class='check_direccion fa fa-2x' value='".$id_odc."' ></center>";
          }
        }
        else{ // si no solo se mostrara el icono
          if($vobo_direccion==1){
            $check2="<center><i class='fa fa-check-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$autorizo."'></center>";
          }
          else{
            $check2="<center><i class='fa fa-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$autorizo."'></center>";
          }
        }

         //compras
         if($compras==$usuario){
          if($vobo_compras==1){
            $check3="<center><input type='checkbox' class='check_compras fa fa-2x' value='".$id_odc."' checked></center>";
          }
          else{
            $check3="<center><input type='checkbox' class='check_compras fa fa-2x' value='".$id_odc."' ></center>";
          }
        }
        else{ // si no solo se mostrara el icono
          if($vobo_compras==1){
            $check3="<center><i class='fa fa-check-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$compras."'></center>";
          }
          else{
            $check3="<center><i class='fa fa-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$compras."'></center>";
          }
        }

        //pm
        if($project==$usuario){
          
          if($vobo_project==1){
            $check4="<center><input type='checkbox' class='check_pm fa fa-2x' value='".$id_odc."' checked></center>";
          }
          else{
            $check4="<center><input type='checkbox' class='check_pm fa fa-2x' value='".$id_odc."' ></center>";
          }
        }
        else{ // si no solo se mostrara el icono
          if($vobo_project==1){
            $check4="<center><i class='fa fa-check-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$project."'></center>";
          }
          else{
            $check4="<center><i class='fa fa-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$project."'></center>";
          }
        }

        //coordinador
        if($coordinador==$usuario){
          if($vobo_coordinador==1){
            $check5="<center><input type='checkbox' class='check_coordinador fa fa-2x' value='".$id_odc."' checked></center>";
          }
          else{
            $check5="<center><input type='checkbox' class='check_coordinador fa fa-2x' value='".$id_odc."' ></center>";
          }
        }
        else{ // si no solo se mostrara el icono
          if($vobo_coordinador==1){
            $check5="<center><i class='fa fa-check-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$coordinador."'></center>";
          }
          else{
            $check5="<center><i class='fa fa-square-o fa-2x' class='disabled' disabled='disabled' style='cursor: not-allowed' title='".$coordinador."'></center>";
          }
        }
        
        $resultado=$resultado."<td>".$check1."</td><td>".$check2."</td><td>".$check3."</td><td>".$check4."</td><td>".$check5."</td><td class='td_boton'><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><button type='button' id='".$id_odc."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download' aria-hidden='true'></i></button></a></td> ";
        
      
  }
    $result->close();
    
}
else{
    $resultado= mysqli_error($mysqli)."--".$sql;
}


if($resultado==""){
  $resultado="<td colspan='11'>No hay solicitudes para el evento seleccionado</td>";
}

echo $resultado;


$mysqli->close();
?>