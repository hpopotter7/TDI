<?php 
 $evento=$_POST['evento'];
 $usuario=$_POST['usuario'];
 $tbody="";
 $total_facturas=0;

function moneda($value) {

  return '$' . number_format($value, 2);
  
}
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
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
/*
if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA" || $usuario=="ANDRES EMANUELLI" || $usuario=="FERNANDA CARRERA"){
      $valida='CXP';
  }
  */
$sql="";
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
/*
$sql2="select sum(Total) from solicitud_factura where Estatus='Activa' and id_evento=".$evento;
if ($result = $mysqli->query($sql2)) {
  while ($row = $result->fetch_row()) {
      
      $suma_facturado=$row[0];    
  }
}
*/
$suma_facturado="no hay nada";
$COUNT=0;
/*
$sql2="SELECT p.id_sol_factura, ROUND(sum(p.total),2) from partidas p, solicitud_factura s where s.id_evento=".$evento." and s.Estaus='Activa' and p.id_sol_factura=s.id_solicitud group by p.id_sol_factura";
*/
$sql2="SELECT p.id_sol_factura, ROUND(sum(p.total),2), s.Estatus from partidas p, solicitud_factura s where s.id_evento=".$evento." and p.id_sol_factura=s.id_solicitud and s.Estatus='Activa' group by p.id_sol_factura";
if ($result = $mysqli->query($sql2)) {
  while ($row = $result->fetch_row()) {
    $COUNT++;
      $tbody=$tbody."<tr>
                <td class='text-center'>".$COUNT."</td>
                <td class='text-center td_btn_numero_factura'>";

                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<label id=".$row[0]." class='btn btn_verde btn_success btn_numero_factura'>0</label>";
                }
                else{
                  $tbody=$tbody."<label class='btn btn_verde btn_success disabled'>0</label>";
                }
                
      $tbody=$tbody."
                </td>
                <td class='text-center'>";
                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<select class='form-control'>";
                }
                else{
                  $tbody=$tbody."<select class='form-control disabled' disabled>";
                }
        $tbody=$tbody."
                <option value='vacio'> </option>
                <option value='PAGADO'>PAGADO</option>
                <option value='COBRADO'>COBRADO</option>
                <option value='NOTA CREDITO'>NOTA CREDITO</option>
                <option value='POR COBRAR'>POR COBRAR</option>
                </select></td>
                <td class='text-center'><h4><span class='label label-primary'>".moneda($row[1])."</span></h4></td>
              ";
              if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><label class='btn btn-info btn_descargar_facturas'><i class='fa fa-download fa-2x' aria-hidden='true'></i></label></a> <a href='#' id='".$row[0]."' class='btn btn-danger btn_eliminar_factura' > <i class='fa fa-trash fa-2x' aria-hidden='true'></i></a></td>";
                }
                else{
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><label class='btn btn-info btn_descargar_facturas'><i class='fa fa-download fa-2x' aria-hidden='true'></i></label></a></td>";
                }
                 $tbody=$tbody."</tr>";
              $total_facturas=$total_facturas+$row[1];
  }
}
$num_evento="";
$sql3="select Numero_evento from eventos where id_evento=".$evento;
if ($result = $mysqli->query($sql3)) {
  while ($row = $result->fetch_row()) {
      $num_evento=$row[0];    
  }
}


$sql="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, e.Nombre_evento, o.Factura, o.pagado, o.comprobado, o.solicito, o.identificador, e.Facturacion, o.no_cheque, o.usuario_registra, o.Monto_devolucion, DATE_FORMAT(o.Fecha_devolucion, '%d-%m-%Y'), o.Motivo_devolucion, o.Banco_devolucion FROM odc o, eventos e where o.evento= e.Numero_evento and o.evento='".$num_evento."' and o.Cancelada='no' order by o.Concepto asc";
/*
$a="SELECT o.a_nombre, o.concepto, o.cheque_por, o.id_odc, e.Nombre_evento, o.Factura, o.pagado, o.comprobado, o.solicito, o.identificador, e.Facturacion, o.no_cheque, o.usuario_registra FROM odc o, eventos e where o.evento= e.Numero_evento and o.evento='".$num_evento."' and o.Cancelada='no' order by o.Concepto asc";
*/

if ($result = $mysqli->query($sql)) {
        
     $resultado='<table class="table table-inverse" style="width:99%"><thead><tr><th>#</th><th>Elaborado</th>
     <th>Solicita</th><th>Proveedor</th><th>Concepto</th><th>Total</th><th>Factura</th><th>Descargar</th><th>Cheque</th><th>Pagado</th><th>Comp</th><th>Tipo</th><th>Devolucion</th></tr></thead>';
  	$suma=0;
    $disabled="";
    $tit="";
    $TITULO="";
    $monto_factura=0;
    while ($row = $result->fetch_row()) {
      $contador++;
      $A_nombre=str_replace("#", "", $row[0]);
      $usuario_registra=$row[12];
      $devolucion=$row[13];
      $fecha_dev=$row[14];
      $motivo=$row[15];
      $banco=$row[16];
      $monto_factura=$row[10]; //10 facturacion
      $suma=$suma+$row[2];

      $columna_total="";
      //class="label label-danger"

      $identificador="SD".substr($row[9], 0, 1);
      if($identificador=="SDO"){
        $identificador="SDP";
      }

      switch ($identificador) {
        case 'SDP':
          $tit="Solicitud de pago";
          $TITULO="PAGO";
          $devolucion="NA";
          $columna_total="<td><h4><span class='label label-primary'>".moneda($row[2])."</span></h4></td>";
          break;
        case 'SDV':
          $tit="Solicitud de viáticos";
          $TITULO="VIÁTICOS";
          /*
          $devolucion="NA";
          $columna_total="<td><h4><span class='label label-primary'>".moneda($row[2])."</span></h4></td>";
          */
          if($devolucion==""){
            $devolucion="<button type='button' id='".$row[3]."' name='id' class='btn btn-info btn_devolucion'><i class='fa fa-retweet'></i></button>";
            $columna_total="<td><h4><span class='label label-primary'>".moneda($row[2])."</span></h4></td>";
          }
          else{
            $devolucion="<span class='bubble' id='uno' title='Ya tiene una devolucion'><button type='button' id='".$row[3]."' name='id' class='btn btn-info disabled' disabled><i class='fa fa-retweet'></i></button></span>";
             $columna_total=$row[2]-$row[13];
             $dev=$row[13];
         $columna_total="<td><h4><span class='bubble3' title='<div>Se hizo una devolución por ".moneda($dev)."</div>El dia ".$fecha_dev."<p>En: ".$banco."</div><div>Por motivo: ".$motivo."</div>'><span class='label label-danger'>".moneda($columna_total)."</span></span></td>";
          }
          break;
        case 'SDR':
          $tit="Solicitud de reembolso";
          $TITULO="REEMBOLSO";
          if($devolucion==""){
            $devolucion="<button type='button' id='".$row[3]."' name='id' class='btn btn-info btn_devolucion'><i class='fa fa-retweet'></i></button>";
            $columna_total="<td><h4><span class='label label-primary'>".moneda($row[2])."</span></h4></td>";
          }
          else{
            $devolucion="<span class='bubble' id='uno' title='Ya tiene una devolucion'><button type='button' id='".$row[3]."' name='id' class='btn btn-info disabled' disabled><i class='fa fa-retweet'></i></button></span>";
             $columna_total=$row[2]-$row[13];
             $dev=$row[13];
         $columna_total="<td><h4><span class='bubble3' title='<div>Se hizo una devolución por ".moneda($dev)."</div>El dia ".$fecha_dev."<p>En: ".$banco."</div><div>Por motivo: ".$motivo."</div>'><span class='label label-danger'>".moneda($columna_total)."</span></span></td>";
          }
          break;
      }
      
      
      if($valida=="CXP"){
        $resultado=$resultado."<tbody><tr><td>".$contador."</td><td>".$usuario_registra."</td><td>".$row[8]."</td><td>".$A_nombre."</td><td>".$row[1]."</td>".$columna_total."<td class='td_boton'><label id='".$row[3]."' class='btn btn_verde btn_success btn_factura'>".$row[5]."</label></td><td class='td_boton'><a href='solicitud_pago.php?id=".$row[3]."' target='_blank'><button type='button' id='".$row[3]."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download fa-2x' aria-hidden='true'></i></button></a></td>";
        if($identificador=="SDV" || $identificador=="SDR"){
          $resultado=$resultado."<td class='td_boton'><label id='".$row[3]."' class='btn btn_verde btn_success btn_cheque'>".$row[11]."</label></td>";
        }
        else{
           $resultado=$resultado."<td></td>";
        }
          if($row[6]=="no"){
            $resultado=$resultado."<td><center><input type='checkbox' class='check_pagado fa fa-2x' value='".$row[3]."'></center></td>";
          }
          else{
            $resultado=$resultado."<td><center><input type='checkbox' class='check_pagado fa fa-2x' value='".$row[3]."' checked></center></td>";
          }

          if($row[7]=="no"){
          $resultado=$resultado."<td><center><input type='checkbox' class='check_comp fa fa-2x' value='".$row[3]."' ></center></td>";
          }
          else{
            $resultado=$resultado."<td><center><input type='checkbox' class='check_comp fa fa-2x' value='".$row[3]."' checked></center></td>";
          }
          $resultado=$resultado."<td title='".$tit."'>".$identificador."</td>";
          $resultado=$resultado."<td><center>".$devolucion."</center></td>";
           $resultado=$resultado."</tr></tbody>";
      }
      else{
        if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
          $resultado=$resultado."<tbody><tr><td><input type='checkbox' value='".$row[3]."' class='check_transfer'></td><td>".$usuario_registra."</td><td>".$row[8]."</td><td>".$A_nombre."</td><td>".$row[1]."</td>".$columna_total."<td class='td_boton'><label id='".$row[3]."' class='btn btn_verde btn_success btn_factura'>".$row[5]."</label></td><td class='td_boton'><a href='solicitud_pago.php?id=".$row[3]."' target='_blank' ><button type='button' id='".$row[3]."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download fa-2x' aria-hidden='true'></i></button></a></td>";
        }
        else{
          $resultado=$resultado."<tbody><tr><td>".$contador."</td><td>".$usuario_registra."</td><td>".$row[8]."</td><td>".$A_nombre."</td><td>".$row[1]."</td><td>".moneda($row[2])."</td><td class='td_boton'><label id='".$row[3]."' class='btn btn_verde btn_success btn_factura'>".$row[5]."</label></td><td class='td_boton'><a href='solicitud_pago.php?id=".$row[3]."' target='_blank' ><button type='button' id='".$row[3]."' name='id' class='btn btn-info boton_descarga'><i class='fa fa-download fa-2x' aria-hidden='true'></i></button></a></td>";
        }
        if($identificador=="SDV" || $identificador=="SDR"){
          $resultado=$resultado."<td class='td_boton'><label id='".$row[3]."' class='btn btn_verde btn_success btn_cheque'>".$row[11]."</label></td>";
        }
        else{
           $resultado=$resultado."<td></td>";
        }
          if($row[6]=="no"){
            $resultado=$resultado."<td><center><input type='checkbox' class='check_pagado fa fa-2x' value='".$row[3]."' disabled style='cursor: not-allowed'></center></td>";
          }
          else{
            $resultado=$resultado."<td><center><input type='checkbox' class='check_pagado fa fa-2x' value='".$row[3]."' checked disabled style='cursor: not-allowed'></center></td>";
          }


          if($row[7]=="no"){
          $resultado=$resultado."<td><center><input type='checkbox' class='check_comp fa fa-2x' value='".$row[3]."' disabled style='cursor: not-allowed'></center></td>";
          }
          else{
            $resultado=$resultado."<td><center><input type='checkbox' class='check_comp fa fa-2x' value='".$row[3]."' checked disabled style='cursor: not-allowed'></center></td>";
          }
          $resultado=$resultado."<td>".$identificador."</td>";
          $resultado=$resultado."<td><center>".$devolucion."</center></td>";
           $resultado=$resultado."</tr></tbody>";
          
      }
      				
		
        /*$resultado=$resultado."<div class='col-md-4 col-sm-4'><label id='".$row[3]."' class='btn btn_verde btn_success'>".$row[4]."</label></div>"."<div class='col-md-5 col-sm-5'>".$row[1]."</div>"."<div class='center col-md-3 col-sm-3'>".moneda($row[2])."</div>"."<div class='center col-md-3 col-sm-3'>".$row[5]."</div>";*/
        //$resultado=$resultado."</div><hr>";
        
    }
    /* free result set */
    $result->close();
}
else{
    $resultado= $resultado.mysqli_error($mysqli)."--".$sql;
}
/*
$resultado=$resultado."</table><div class='row col-md-5'><strong><b>Suma total: ".moneda($suma)."</b></strong></div><div class='row col-md-5'><strong><b>Presupuesto: ".moneda($monto_factura)."</b></strong></div><div class='row col-md-2'><strong><b><a href='#'><a id='badge".$evento."' class='btn_badge' href='#'><span class='badge badge-info'>".$cantidad_facturas."</span></a> Facturado: ".moneda($suma_facturado)."</b></strong></div>";
*/
$resultado2="";
$resultado2=$resultado2."<div></table>
<div class='row col-md-3'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: #455F87; color: white'>
                    <tr>
                      <th class='text-center'>Suma solicitudes</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class='text-center'><h3><span class='label label-primary'>".moneda($suma)."</span></h3></td>
                      </tr>
                    </tbody>
                    </table>
</div>
<div class='row col-md-3'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: #455F87; color: white'>
                    <tr>
                      <th class='text-center'>Presupuesto</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class='text-center'><h3><span class='label label-primary'>".moneda($facturacion)."</span></h3></td>
                      </tr>
                    </tbody>
                    </table>
</div>
<div class='row col-md-6'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: #455F87; color: white'>
                    <tr >
                      <th colspan='5' class='text-center'>Facturación</th>
                    </tr>
                    </thead>
                    <thead style='background-color: #455F87; color: white'>
                      <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Factura</th>
                        <th class='text-center'>Estatus</th>
                        <th class='text-center'>Monto</th>
                        <th class='text-center'>descargar</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      ".$tbody."
                    </tbody>
                    <tfoot>
                        <tr>
                        <th colspan='3' class='text-right'><label class='abajo'>Total:</label></th>
                        <th colspan='2' class='text-center'><h3><span class='label label-primary'>".moneda($total_facturas)."</span></h3></th>
                      </tr>
                      </tfoot>
                  </table></div>";

if($suma==0){
$resultado=$resultado."<div class='row col-md-12'><i>No hay solicitudes para este evento.</i></div><div class='row'></div><div class='clearfix row'></div>";
}
echo $resultado.$resultado2;


$mysqli->close();
?>