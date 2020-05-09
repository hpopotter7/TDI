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


$sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, o.solicito, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador, o.usuario_registra FROM odc o where o.evento='".$numero_evento."' and o.Cancelada='no' order by o.id_odc desc";
$result = $mysqli->query("SET NAMES 'utf8'"); 

if ($result = $mysqli->query($sql)) {
     $resultado='<table class="table table-inverse" style="width:99%"><thead><tr><th>#</th><th>Elaborado</th>
     <th>Solicita</th><th>Proveedor</th><th>Concepto</th><th>Importe</th><th>Finanzas</th><th>Dirección</th><th>Compras</th><th>P.M.</th><th>Coordinador</th><th>Ver</th></tr></thead>';
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
      $importe="<td>".moneda($cheque_por)."</td>";
      $fuente='"Neuton';
      $Factura="";

      $check1="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check2="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check3="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check4="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
      $check5="<center><input type='checkbox' class='check_comp fa fa-2x' value='".$id_odc."' ></center>";
     
     
        $resultado=$resultado."<tr><td>".$contador."</td><td>".$usuario_registra."</td><td>".$solicito."</td><td>".$a_nombre."</td><td>".$concepto."</td>".$importe."<td>".$check1."</td><td>".$check2."</td><td>".$check3."</td><td>".$check4."</td><td>".$check5."</td><td class='td_boton'><a href='solicitud_pago.php?id=".$id_odc."' target='_blank'><button type='button' id='".$id_odc."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download' aria-hidden='true'></i></button></a></td> ";
        
      
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